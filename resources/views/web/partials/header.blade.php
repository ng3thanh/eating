@php
    $url = (Route::current()->getName() != 'main') ? route('main') : '';
@endphp
<header class="nav-header">
    <!-- Main Navbar-->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Navbar Brand -->
            <div class="navbar-header d-flex align-items-center justify-content-between">
                <a href="{{ route('main') }}" class="navbar-brand">{{ $logo->name }}</a>
                <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
            <!-- Navbar Menu -->
            <div id="navbarcollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" title="team" href="{{ $url }}#about">{{ __('homepage.about') }}</a></li>
                    <li class="nav-item"><a class="nav-link" title="services" href="{{ $url }}#services">{{ __('homepage.services') }}</a></li>
                    <li class="nav-item"><a class="nav-link" title="works" href="{{ $url }}#works">{{ __('homepage.works') }}</a></li>
                    <li class="nav-item"><a class="nav-link" title="blog" href="{{ $url }}#blog">{{ __('homepage.blog') }}</a></li>
                    <li class="nav-item"><a class="nav-link" title="contact" href="{{ $url }}#contact">{{ __('homepage.contact') }}</a></li>
                </ul>
                <ul class="langs navbar-text">
                    <a href="{!! route('user.change-language', ['vi']) !!}" class="{{ checkLanguage('vi') }}">
                        <img src="{{ asset('web/img/VN_flag.png') }}" alt="Vietnam flag" />
                    </a>
                    &nbsp;&nbsp;
                    <a href="{!! route('user.change-language', ['en']) !!}" class="{{ checkLanguage('en') }}">
                        <img src="{{ asset('web/img/US_flag.png') }}" alt="American flag" />
                    </a>
                </ul>
            </div>
        </div>
    </nav>
</header>