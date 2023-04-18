@php
    $curRoute = \Request::route()->getName();
@endphp
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link @if($curRoute == 'admin.dashboard') active @endif" href="{{route('admin.dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Pages</div>
                <a class="nav-link @if($curRoute == 'admin.home') active @endif" href="{{route('admin.home')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-house-user fa-fade"></i></div>
                    Home Section
                </a>
                <a class="nav-link @if($curRoute == 'admin.social') active @endif" href="{{route('admin.social')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-comment fa-shake"></i></div>
                    Social Info
                </a>
                <a class="nav-link @if($curRoute == 'admin.about') active @endif" href="{{route('admin.about')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card fa-beat"></i></div>
                    About
                </a>
                <a class="nav-link @if($curRoute == 'admin.skills') active @endif" href="{{route('admin.skills')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-fan fa-spin"></i></div>
                    Skills
                </a>
                <a class="nav-link @if($curRoute == 'admin.portfolio') active @endif" href="{{route('admin.portfolio')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-shield-cat fa-flip"></i></div>
                    Portfolios
                </a>
                <a class="nav-link @if($curRoute == 'admin.contact') active @endif" href="{{route('admin.contact')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-phone-volume fa-shake"></i></div>
                    Contact
                </a>

                <a class="nav-link collapsed @if($curRoute == 'admin.support.all' || $curRoute == 'admin.support.pending') active @endif" href="#" data-bs-toggle="collapse" data-bs-target="#supportSection"
                    aria-expanded="false" aria-controls="supportSection">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-headset"></i></div>
                    Support <p class="mb-0" id="pendingAlert"></p>
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="supportSection" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link @if($curRoute == 'admin.support.pending') active @endif" href="{{route('admin.support.pending')}}">
                            Pending <span class="ms-2 badge rounded-pill bg-danger" id="pendingAlertCount"></span>
                        </a>
                        <a class="nav-link @if($curRoute == 'admin.support.all') active @endif" href="{{route('admin.support.all')}}">
                            All Message
                        </a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Setting</div>
                <a class="nav-link @if($curRoute == 'admin.setting') active @endif" href="{{route('admin.setting')}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-gear fa-spin"></i></div>
                    General Settings
                </a>
                <!--Blank Space-->
                <div class="my-5 py-5"></div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Develop by</div>
            <i class="fa-brands fa-facebook fa-bounce text-warning"></i>
            <a style="text-decoration: none" class="text-warning" href="https://facebook.com/mr.orko.10">H E M E L</a>
        </div>
    </nav>
</div>


@push('script')
    <script>
        $(window).on('load', function(){
            $.ajax({
                type: "GET",
                url: "{{route('admin.support.all.ajax')}}",
                success: function (res) {
                    console.log(res);
                    //functionCall
                    pendingAlertCheck(res.count)
                }
            });
        });

        //pendingAlertCheck Function
        const pendingAlertCheck = (count) =>{
            if(count > 0){
                $('#pendingAlert').html(`<i class="ms-2 fa-solid fa-circle-exclamation fa-beat text-danger"></i>`);
                $('#pendingAlertCount').html(count);
            }else{
                $('#pendingAlert').html('');
                $('#pendingAlertCount').html('');
            }
        }
    </script>
@endpush