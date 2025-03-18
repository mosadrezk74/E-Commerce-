<html>

@include('Website.layouts.head')

<body class="home-page home-01 ">

    @include('Website.layouts.header')
	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>
    @yield('content')

    @include('Website.layouts.footer')

    @include('Website.layouts.scripts')

    @livewireScripts

</body>

</html>
