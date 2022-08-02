<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    @include('layouts.parts.header')
    @section('style')
    @show
</head>
<body>

    @section('modals')
    @show
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li>
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

                </li>
                <li class="nav-item theme-text">
                    <a href="/" class="nav-link"> {{config('app.name')}} </a>
                </li>
            </ul>




            <ul class="navbar-item flex-row ml-md-auto">

                <li class="nav-item dropdown language-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(app()->getLocale() == "ar")
                        <img src="/assets/img/flag-ar.png" class="flag-width" alt="flag"> العربية
                        @else
                        <img src="/assets/img/flag-us.svg" class="flag-width" alt="flag"> English
                        @endif
                    </a>
                    <div class="dropdown-menu position-absolute" >
                    @if(app()->getLocale() == "ar")
                        <a class="dropdown-item d-flex" href="/language/switch"><img src="/assets/img/flag-us.svg" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;English</span></a>
                    @else
                        <a class="dropdown-item d-flex" href="/language/switch"><img src="/assets/img/flag-ar.png" class="flag-width" alt="flag"> <span class="align-self-center">&nbsp;العربية</span></a>

                    @endif
                    </div>
                </li>

                <li class="nav-item dropdown language-dropdown ">
                    <div class="dropdown custom-dropdown-icon">
                        <a style="padding:9px 20px 9px 20px" class="dropdown-toggle btn" href="#" role="button" id="customDropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(!\Cookie::get('darkmode'))
                         <span>{{__('lang.default_mode')}}</span>
                        @else
                         <span>{{__('lang.dark_mode')}}</span>
                        @endif
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                       </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown2">

                            <a class="dropdown-item" data-img-value="flag-ca" data-value="English" href="/mode/switch">
                                @if(!\Cookie::get('darkmode'))
                                {{__('lang.dark_mode')}}
                                @else
                                 <span>{{__('lang.default_mode')}}</span>
                                @endif
                            </a>
                        </div>
                    </div>
                </li>


                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a class="" href="/myaccount"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> {{__('lang.my_account')}}</a>
                            </div>
        
                            <div class="dropdown-item">
                                <a class="" href="/logout"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> {{__('lang.logout')}}</a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </header>
        
    </div>
    <!--  END NAVBAR  -->



    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

 

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            
                @include('layouts.parts.sidebar')

        </div>
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            @section('content')
            @show

        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    @include('layouts.parts.footer')