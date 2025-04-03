<?php

    function validateAndUploadImage($file) {

        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
    
        $original_name = pathinfo($file['name'], PATHINFO_FILENAME);
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $safe_name = preg_replace("/[^a-zA-Z0-9-_.]/", "", $original_name);
        
        $new_filename = $safe_name  . '.' . $extension;
        $target_file = $target_dir . $new_filename;
    
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            return ['success' => true, 'filename' => $new_filename];
        } else {
            return ['success' => false, 'message' => 'Error uploading image.'];
        }
    }

?>
