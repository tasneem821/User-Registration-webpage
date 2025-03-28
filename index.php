<?php include 'header.php'; ?>

    <div class="container">
        <div class="title">
        <h1 class="form-title">
            Registration form
        </h1>
        </div>
        <form method="POST">
        
               
                <input type="text " id="fullname" placeholder="Full Name"  required onblur="Validate_FullName()">
                <span class="error-message" id="fullname_error"></span>
                <br>
              
                <input type="text " id="username" placeholder="Username"    required onblur="Validate_UserName()">
                <span class="error-message" id="username_error"></span>
                <br>
               
                <input type="text " id="phone" placeholder="Phone"   required onblur="Validate_Phone()">
                <span class="error-message" id="phone_error"></span>
                <br>
               
                <input type="text "id="whats" placeholder="WhatsApp number"   required onblur="Validate_WhatsApp()">
                <span class="error-message" id="whats_error"></span>
                <br>
              
                <input type="text " id="address" placeholder="Address">
                <br>
               
                <input type="password" id="password" placeholder="Password" required onblur="Validate_Password()">
                <span class="error-message" id="password_error"></span>
                <br>
                
                <input type="password" id="confirmPassword" placeholder="Confirm Password"  required onblur="Validate_Confirm_Password()">
                <span class="error-message" id="confirmPassword_error"></span>
                <br>
                
                <input type="email" id="email" placeholder="Email"   required onblur="Validate_Email()">
                <span class="error-message" id="email_error"></span>
                <br>
                <label for="img">  User Image</label>
                <input type="file" id="imageUpload" accept="image/*">
                <img id="preview" style="max-width: 200px; display: none;">
                <br>
                <input type="submit" value="Submit"  onclick="return Validate_Form()">
                
     
        </form>
    </div>
    <?php include 'footer.php'; ?>
