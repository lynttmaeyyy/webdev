<div class="wrapper">
    <div class="main-panel">
        @include('layouts.navbars.auth')
        {{-- @include('layouts.navbars.navs.auth') --}}
        @yield('content')
        @include('layouts.footer')
    </div>
</div>