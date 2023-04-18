@include('backend.includes.head')

<body class="sb-nav-fixed">
    <!--Topnav-->
    @include('backend.includes.top_nav')
    
    <div id="layoutSidenav">
        
        <!--Sidenav-->
        @include('backend.includes.side_nav')

        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    @yield('content')
                </div>
            </main>

            <!--Footer-->
            @include('backend.includes.footer')
            
        </div>
    </div>

    <!--Script-->
    @include('backend.includes.script')
    @stack('script')
</body>

</html>
