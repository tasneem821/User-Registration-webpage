<?php
// MySQL connection info
$host = "localhost";
$db_name = "registration_db";
$username = "root";
$password = "";

// ✅ Delete all previous backup_*.sql files before creating a new one
foreach (glob("backup_*.sql") as $oldFile) {
    unlink($oldFile);
}

// Generate a timestamped backup file name
$backup_file = "backup_" . date("Y-m-d_H-i-s") . ".sql";

// Full path to mysqldump.exe
$mysqldump_path = "D:\\FCAI\\third year\\second semester\\WEB_2\\xampp\\mysql\\bin\\mysqldump.exe";

// Construct the command (make sure paths are quoted!)
$command = "\"$mysqldump_path\" --user=$username --password=$password --host=$host $db_name > \"$backup_file\"";

// Run the backup
$output = null;
$return_var = null;
exec($command, $output, $return_var);

// Check if the backup was successful
if ($return_var !== 0 || !file_exists($backup_file)) {
    // Optionally log the error instead of echoing, since this runs in the background
    error_log("❌ Backup failed. Command: $command\nOutput: " . implode("\n", $output) . "\nReturn Code: $return_var");
}
?>

