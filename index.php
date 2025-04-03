<?php 
include 'header.php'; 
require_once 'DB_Ops.php'; 
require_once 'Upload.php';

$db = new DB_Ops();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['fullname'];
    $user_name = $_POST['username'];
    $phone = $_POST['phone'];
    $whatsapp = $_POST['whats'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $user_image = "";

    if (isset($_FILES['imageUpload'])) {
        $uploadResult = validateAndUploadImage($_FILES['imageUpload']);
        
        if ($uploadResult['success']) {
            $user_image = $uploadResult['filename'];
        } else {
            echo "<script>alert('".$uploadResult['message']."');</script>";
        }
    }

    // Insert user into database
    if ($db->insertUser($full_name, $user_name, $phone, $whatsapp, $address, $password, $email, $user_image)) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "<script>alert('Error registering user.');</script>";
    }
}
?>
<div class="container">
    <div class="title">
        <h1 class="form-title">Registration Form</h1>
    </div>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" id="fullname" name="fullname" placeholder="Full Name" required onblur="Validate_FullName()">
        <span class="error-message" id="fullname_error"></span><br>

        <input type="text" id="username" name="username" placeholder="Username" required onblur="Validate_UserName()">
        <span class="error-message" id="username_error"></span><br>

        <input type="text" id="phone" name="phone" placeholder="Phone" required onblur="Validate_Phone()">
        <span class="error-message" id="phone_error"></span><br>

        <input type="text" id="whats" name="whats" placeholder="WhatsApp number" required onblur="Validate_WhatsApp()">
        <span class="error-message" id="whats_error"></span><br>

        <input type="text" id="address" name="address" placeholder="Address" required><br>

        <input type="password" id="password" name="password" placeholder="Password" required onblur="Validate_Password()">
        <span class="error-message" id="password_error"></span><br>

        <input type="password" id="confirmPassword" placeholder="Confirm Password" required onblur="Validate_Confirm_Password()">
        <span class="error-message" id="confirmPassword_error"></span><br>

        <input type="email" id="email" name="email" placeholder="Email" required onblur="Validate_Email()">
        <span class="error-message" id="email_error"></span><br>

        <label for="imageUpload">User Image</label>
        <input type="file" id="imageUpload" name="imageUpload" accept="image/*" required><br>

        <input type="submit" value="Submit" onclick="return Validate_Form()">
    </form>
</div>


<script>

function Validate_FullName() {
    var fullName = document.getElementById("fullname");
    var error = document.getElementById("fullname_error");
    var trimmedValue = fullName.value.trim();
    var fullNamepattern=/^[a-zA-Z\s]*$/;
    if (!fullNamepattern.test(trimmedValue) || trimmedValue.length === 0) {
        error.textContent = "Please enter a valid full name using only letters and spaces.";
        fullName.value = "";
        return false;
    } else {
        error.textContent = "";
    }
    return true;
    }

    function Validate_UserName() {
    var userName = document.getElementById("username");
    var error = document.getElementById("username_error");
    var userNamePattern = /^[a-zA-Z0-9_.]{3,15}$/;
    if (!userNamePattern.test(userName.value)) {
        error.textContent = "Username must be 3-15 characters and can include letters, numbers, _ or .";
        userName.value = "";
        return false;
    } else {
        error.textContent = "";
    }
    return true;
}


    function Validate_Phone() {
        var phone = document.getElementById("phone");
        var error = document.getElementById("phone_error");
        var phonepattern = /^01[0-2,5]{1}[0-9]{8}$/;
        if (!phonepattern.test(phone.value)) {
            error.textContent = "Please enter a valid phone number with 11 digits, starting with 010, 012, 011, or 015.";
            phone.value = "";
            return false;
        } else {
            error.textContent = "";
        }
        return true;
    }


    function Validate_WhatsApp() {
    var whatsApp = document.getElementById("whats");
    var error = document.getElementById("whats_error");
    var phonePattern = /^01[0-2,5]{1}[0-9]{8}$/; 
    
    if (!phonePattern.test(whatsApp.value)) {
        error.textContent =  "Please enter a valid whatsapp number with 11 digits, starting with 010, 012, 011, or 015.";
        whatsApp.value = ""; 
        return false;
    } else {
        error.textContent = "";
    }
    return true;
}


    function Validate_Password() {
        var password = document.getElementById("password");
        var error = document.getElementById("password_error");
        var passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
        if (!passwordPattern.test(password.value)) {
            error.textContent = "Password must be at least 8 characters with at least 1 number and 1 special character.";
            password.value = "";
            return false;
        } else {
            error.textContent = "";
        }
        return true;
    }

    function Validate_Confirm_Password() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword");
        var error = document.getElementById("confirmPassword_error");
        if (password !== confirmPassword.value) {
            error.textContent = "Your passwords don’t match. Please try again.";
            confirmPassword.value = "";
            return false;
        } else {
            error.textContent = "";
        }
        return true;
    }



    function Validate_Email() {
        var userEmail = document.getElementById("email");
        var error = document.getElementById("email_error");
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(userEmail.value)) {
            error.textContent = "Invalid email address.";
            userEmail.value = "";
            return false;
        } else {
            error.textContent = "";
        }
        return true;
    }


    function Validate_Form() {
    var isValid = true;

    if (!Validate_FullName()) isValid = false;
    if (!Validate_UserName()) isValid = false;
    if (!Validate_Phone()) isValid = false;
    if (!Validate_WhatsApp()) isValid = false;
    if (!Validate_Password()) isValid = false;
    if (!Validate_Confirm_Password()) isValid = false;
    if (!Validate_Email()) isValid = false;

    var address = document.getElementById("address");
    if (address.value.trim() === "") {
        alert("Address is required.");
        isValid = false;
    }

    var imageUpload = document.getElementById("imageUpload");
    if (imageUpload.files.length === 0) {
        alert("Please upload a user image.");
        isValid = false;
    }

    return isValid;
}


</script>

    <?php include 'footer.php'; ?>
