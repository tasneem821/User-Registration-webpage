<header>
    <div class="nav">
        <div class="logo">
            <img src="<?php echo e(asset('logo.png')); ?>" alt="Logo" class="logo-img">
        </div>

        <div class="language-switcher">
            <a href="<?php echo e(route('en')); ?>"><?php echo e(__('messages.english')); ?></a> |
            <a href="<?php echo e(route('ar')); ?>"><?php echo e(__('messages.arabic')); ?></a>
        </div>

        <ul class="links-container">
            <li>
                <a href="#" class="link">
                    <i class="fa fa-home"></i>
                    <p><?php echo e(__('messages.home')); ?></p>
                </a>
            </li>
            <li>
                <a href="#" class="link">
                    <i class="fa fa-users"></i>
                    <p><?php echo e(__('messages.about_us')); ?></p>
                </a>
            </li>
            <li>
                <a href="#" class="link">
                    <i class="fa fa-envelope"></i>
                    <p><?php echo e(__('messages.contact_us')); ?></p>
                </a>
            </li>
        </ul>
    </div>
</header>
<?php /**PATH C:\Users\tasnim\Desktop\third-lvl\second-term\User-Registration-webpage\RegisterationFormLaravel\resources\views/partials/header.blade.php ENDPATH**/ ?>