 <div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="logo_light" height="24">
                    </span>
                </a>
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo_sm" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="logo_dark" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="tp-link">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title">Pages</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Manage Heroes</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.heroes') }}" class="tp-link">All Heroes</a>
                            </li>
                            <li>
                                <a href="{{ route('add.hero') }}" class="tp-link">Add Hero</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#video" data-bs-toggle="collapse">
                        <i data-feather="video"></i>
                        <span>Manage Video</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="video">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.videos') }}" class="tp-link">All Videos</a>
                            </li>
                            <li>
                                <a href="{{ route('add.video') }}" class="tp-link">Add Video</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#testomonial" data-bs-toggle="collapse">
                        <i data-feather="message-circle"></i>
                        <span>Manage Testomonial</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="testomonial">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.testimonials') }}" class="tp-link">All Testimonials</a>
                            </li>
                            <li>
                                <a href="{{ route('add.testimonial') }}" class="tp-link">Add Testimonial</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">General</li>

                <li>
                    <a href="#sidebarBaseui" data-bs-toggle="collapse">
                        <i data-feather="package"></i>
                        <span> Components </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarBaseui">
                        <ul class="nav-second-level">
                            <li>
                                <a href="ui-accordions.html" class="tp-link">Accordions</a>
                            </li>
                            <li>
                                <a href="ui-alerts.html" class="tp-link">Alerts</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarMaps" data-bs-toggle="collapse">
                        <i data-feather="map"></i>
                        <span> Maps </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMaps">
                        <ul class="nav-second-level">
                            <li>
                                <a href="maps-google.html" class="tp-link">Google Maps</a>
                            </li>
                            <li>
                                <a href="maps-vector.html" class="tp-link">Vector Maps</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
