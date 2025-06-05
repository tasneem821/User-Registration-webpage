@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title">
        <h1 class="form-title">{{ __('messages.register_title') }}</h1>
    </div>
    {{-- <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" onsubmit="return Validate_Form();"> --}}
    <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data" onsubmit="return Validate_Form();">

        @csrf

        <span class="required">*</span>
        <input type="text" id="fullname" name="fullname" placeholder="{{ __('messages.name') }}" required onblur="Validate_FullName()">
        <span class="error-message" id="fullname_error"></span><br>

        <span class="required">*</span>
        <input type="text" id="username" name="username" placeholder="{{ __('messages.username') }}" required onblur="Validate_UserName_ServerSide(this.value)">
        <span class="error-message" id="username_error"></span><br>

        <span class="required">*</span>
        <input type="text" id="phone" name="phone" placeholder="{{ __('messages.phone') }}" required onblur="Validate_Phone()">
        <span class="error-message" id="phone_error"></span><br>

        <span class="required">*</span>
        <div class="whatsapp-group">
            <input type="text" id="whats" name="whats" placeholder="{{ __('messages.whats') }}" required>
            <button type="button" class="check-button" onclick="Validate_WhatsApp()">{{ __('messages.check_number') ?? 'Check Number' }}</button>
            <span class="error-message" id="whats_error"></span>
        </div><br>

        <span class="required">*</span>
        <input type="text" id="address" name="address" placeholder="{{ __('messages.address') }}" required><br>

        <span class="required">*</span>
        <input type="password" id="password" name="password" placeholder="{{ __('messages.password') }}" required onblur="Validate_Password()">
        <span class="error-message" id="password_error"></span><br>

        <span class="required">*</span>
        <input type="password" id="confirmPassword" placeholder="{{ __('messages.confirm_password') ?? 'Confirm Password' }}" required onblur="Validate_Confirm_Password()">
        <span class="error-message" id="confirmPassword_error"></span><br>

        <span class="required">*</span>
        <input type="email" id="email" name="email" placeholder="{{ __('messages.email') }}" required onblur="Validate_Email()">
        <span class="error-message" id="email_error"></span><br>

        <label for="imageUpload">{{ __('messages.user_image') ?? 'User Image' }} <span class="required">*</span></label>
        <div class="file-upload">
            <input type="file" id="imageUpload" name="imageUpload" accept="image/*" required>
            <label for="imageUpload" class="file-upload-label">{{ __('messages.choose_image') ?? 'Choose Image' }}</label>
            <span class="file-name"></span>
        </div><br>

        <input type="submit" value="{{ __('messages.create_account') }}">
    </form>
</div>
<script>
    window.checkUsernameUrl = "{{ route('check.username') }}";
</script>
<script src="{{ asset('js/validation.js') }}"></script>
@endsection
