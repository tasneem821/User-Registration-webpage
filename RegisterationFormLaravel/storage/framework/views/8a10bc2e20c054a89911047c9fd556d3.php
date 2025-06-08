

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="title">
        <h1 class="form-title"><?php echo e(__('messages.register_title')); ?></h1>
    </div>
    <form method="POST" action="<?php echo e(route('register.store')); ?>" enctype="multipart/form-data" onsubmit="return Validate_Form();">


        <?php echo csrf_field(); ?>

        <span class="required">*</span>
        <input type="text" id="fullname" name="fullname" placeholder="<?php echo e(__('messages.name')); ?>" required onblur="Validate_FullName()">
        <span class="error-message" id="fullname_error"></span><br>

        <span class="required">*</span>
        <input type="text" id="username" name="username" placeholder="<?php echo e(__('messages.username')); ?>" required onblur="Validate_UserName_ServerSide(this.value)">
        <span class="error-message" id="username_error"></span><br>

        <span class="required">*</span>
        <input type="text" id="phone" name="phone" placeholder="<?php echo e(__('messages.phone')); ?>" required onblur="Validate_Phone()">
        <span class="error-message" id="phone_error"></span><br>

        <span class="required">*</span>
        <div class="whatsapp-group">
            <input type="text" id="whats" name="whats" placeholder="<?php echo e(__('messages.whats')); ?>" required>
            <button type="button" class="check-button" onclick="Validate_WhatsApp()"><?php echo e(__('messages.check_number') ?? 'Check Number'); ?></button>
            <span class="error-message" id="whats_error"></span>
        </div><br>

        <span class="required">*</span>
        <input type="text" id="address" name="address" placeholder="<?php echo e(__('messages.address')); ?>" required><br>

        <span class="required">*</span>
        <input type="password" id="password" name="password" placeholder="<?php echo e(__('messages.password')); ?>" required onblur="Validate_Password()">
        <span class="error-message" id="password_error"></span><br>

        <span class="required">*</span>
        <input type="password" id="confirmPassword" placeholder="<?php echo e(__('messages.confirm_password') ?? 'Confirm Password'); ?>" required onblur="Validate_Confirm_Password()">
        <span class="error-message" id="confirmPassword_error"></span><br>

        <span class="required">*</span>
        <input type="email" id="email" name="email" placeholder="<?php echo e(__('messages.email')); ?>" required onblur="Validate_Email()">
        <span class="error-message" id="email_error"></span><br>

        <label for="imageUpload"><?php echo e(__('messages.user_image') ?? 'User Image'); ?> <span class="required">*</span></label>
        <div class="file-upload">
            <input type="file" id="imageUpload" name="imageUpload" accept="image/*" required>
            <label for="imageUpload" class="file-upload-label"><?php echo e(__('messages.choose_image') ?? 'Choose Image'); ?></label>
            <span class="file-name"></span>
        </div><br>

        <input type="submit" value="<?php echo e(__('messages.create_account')); ?>">
    </form>
</div>
<script>
    window.checkUsernameUrl = "<?php echo e(route('check.username')); ?>";
    var validationMessages = {
        username_error: "<?php echo e(__('messages.user_name_error')); ?>",
        whatsapp: "<?php echo e(__('messages.whatsapp')); ?>",
        whatsapp_valid: "<?php echo e(__('messages.whatsapp_valid')); ?>",
        whatsapp_invalid: "<?php echo e(__('messages.whatsapp_invalid')); ?>",
        whatsapp_unavailable: "<?php echo e(__('messages.whatsapp_unavailable')); ?>",
        whatsapp_verify: "<?php echo e(__('messages.whatsapp_verify')); ?>",
        address: "<?php echo e(__('messages.address_error')); ?>",
        image: "<?php echo e(__('messages.image_error')); ?>",
        full_name_error: "<?php echo e(__('messages.full_name_error')); ?>",
        phone_error: "<?php echo e(__('messages.phone_error')); ?>",
        email_error: "<?php echo e(__('messages.email_error')); ?>",
        password_error: "<?php echo e(__('messages.password_error')); ?>",
        confirm_password_error: "<?php echo e(__('messages.confirm_password_error')); ?>"
    };
</script>
<script src="<?php echo e(asset('js/validation.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\tasnim\Desktop\third-lvl\second-term\User-Registration-webpage\RegisterationFormLaravel\resources\views/register.blade.php ENDPATH**/ ?>