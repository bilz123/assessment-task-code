 <!-- main header @s -->
 <div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ml-n1">
                <a href="javascript:void(0);" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>

            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}" srcset="{{ asset('images/logo2x.png') }} 2x" alt="logo">
                    <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.png') }}" srcset="{{ asset('images/logo-dark2x.png') }} 2x" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->

            <div class="nk-header-news d-none d-xl-block"></div><!-- .nk-header-news -->

            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown notification-dropdown mr-n1">
                        <a href="javascript:void(0);" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                            <div class="icon-status icon-status-danger" id="new-notifications">
                                <em class="icon ni ni-bell"></em>
                            </div>
                            <em class="icon ni ni-bell" id="notifications"></em>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                <a href="javascript:void(0);">Mark All as Read</a>
                            </div>
                            <div class="dropdown-body">
                                <div class="nk-notification">
                                    <a href="" class="nk-notification-item dropdown-inner">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle bg-dim ni ni-notice"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text"></div>
                                            <div class="nk-notification-time"></div>
                                        </div>
                                    </a>
                                    <div class="nk-notification-item dropdown-inner justify-content-center" id="no-notifications">
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">No notifications at the moment.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-foot center">
                                <a href="">View All</a>
                            </div>
                        </div>
                    </li><!-- .dropdown -->

                    <li class="dropdown user-dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="user-toggle ">
                                <div class="user-avatar sm {{ getRandomColorClass() }} auth-avatar">
                                    <span {!! empty(auth()->user()->avatar) ? '' : 'style="display: none;"' !!}>{{ getUserInitials(auth()->user()->name) }}</span>
                                    <img src="{{ !empty(auth()->user()->avatar) ? pathToUrl(auth()->user()->avatar) : '/' }}" alt="Avatar" {!! !empty(auth()->user()->avatar) ? '' : 'style="display: none;"' !!}>
                                </div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-name dropdown-indicator auth-name">{{ auth()->user()->name }}</div>
                                    <div class="user-status pb-0">{{ prettifyRole(auth()->user()->roles()->pluck('name')->toArray()[0]) }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar auth-avatar">
                                        <span {!! empty(auth()->user()->avatar) ? '' : 'style="display: none;"' !!}>{{ getUserInitials(auth()->user()->name) }}</span>
                                    <img src="{{ !empty(auth()->user()->avatar) ? pathToUrl(auth()->user()->avatar) : '/' }}" alt="Avatar" {!! !empty(auth()->user()->avatar) ? '' : 'style="display: none;"' !!}>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ auth()->user()->name }}</span>
                                        <span class="sub-text">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="">
                                            <em class="icon ni ni-user-alt"></em>
                                            <span>View Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dark-switch" href="javascript:void(0);">
                                            <em class="icon ni ni-moon"></em>
                                            <span>Dark Mode</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <em class="icon ni ni-signout"></em>
                                            <span>Sign out</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                    </li>
                                </ul>
                             
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
<!-- main header @e -->