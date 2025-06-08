<header>
    <div class="nav">
        <div class="logo">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="logo-img">
        </div>

        <div class="language-switcher">
            <a href="{{ route('en') }}">{{ __('messages.english') }}</a> |
            <a href="{{ route('ar')}}">{{ __('messages.arabic') }}</a>
        </div>

        <ul class="links-container">
            <li>
                <a href="#" class="link">
                    <i class="fa fa-home"></i>
                    <p>{{__('messages.home')}}</p>
                </a>
            </li>
            <li>
                <a href="#" class="link">
                    <i class="fa fa-users"></i>
                    <p>{{__('messages.about_us')}}</p>
                </a>
            </li>
            <li>
                <a href="#" class="link">
                    <i class="fa fa-envelope"></i>
                    <p>{{__('messages.contact_us')}}</p>
                </a>
            </li>
        </ul>
    </div>
</header>
