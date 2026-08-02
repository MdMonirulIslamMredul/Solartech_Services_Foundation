<style>
    /* ─── NAVBAR BASE: Transparent at top of page ─── */
    .navbar-area {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 9999;
        background: transparent !important;
        padding: 0.85rem 0;
        box-shadow: none;
        transition: background 0.4s ease, padding 0.4s ease, box-shadow 0.4s ease;
    }

    /* ─── NAVBAR SCROLLED: Solid Navy matching footer ─── */
    .navbar-area.scrolled {
        background: linear-gradient(135deg, #0e1e4a 0%, #111d5e 60%, #0e4b75 100%) !important;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        padding: 0.5rem 0;
    }

    .navbar-area .navbar-nav {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        flex-wrap: wrap;
    }

    .navbar-area .navbar-nav .nav-item {
        position: relative;
    }

    /* ─── Nav Links: White on transparent, white on scrolled (navy bg) ─── */
    .navbar-area .navbar-nav .nav-link {
        color: #ffffff !important;
        font-size: 0.95rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.25s ease;
        text-transform: none;
        white-space: nowrap !important;
        text-shadow: 0 1px 4px rgba(0,0,0,0.4);
    }

    /* Logo: transparent bg at top, white bg after scroll */
    .navbar-area .navbar-brand img {
        background: rgba(255,255,255,0.12);
        padding: 0.3rem 0.4rem;
        border-radius: 10px;
        max-height: 52px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        transition: background 0.4s ease, box-shadow 0.4s ease;
    }
    .navbar-area.scrolled .navbar-brand img {
        background: rgba(255,255,255,0.15);
        box-shadow: 0 4px 15px rgba(0,0,0,0.25);
    }
    .mobile-responsive-menu .logo img {
        background: #ffffff;
        padding: 0.25rem 0.35rem;
        border-radius: 10px;
        max-height: 48px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    /* Hover state */
    .navbar-area .navbar-nav .nav-link:hover,
    .navbar-area .navbar-nav .nav-link:focus {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.15);
        text-shadow: none;
    }

    /* Active pill */
    .navbar-area .navbar-nav .nav-link.active-pill,
    .navbar-area .navbar-nav .nav-item.active > .nav-link {
        background: #e32845 !important;
        color: #ffffff !important;
        border-radius: 8px;
        font-weight: 700;
        text-shadow: none;
        box-shadow: 0 4px 14px rgba(227, 40, 69, 0.4);
    }

    /* ─── Call Pill Button ─── */
    .header-call-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: linear-gradient(135deg, #e32845 0%, #c01e37 100%);
        color: #ffffff !important;
        padding: 6px 7px 6px 18px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 14px;
        white-space: nowrap !important;
        text-decoration: none !important;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(227, 40, 69, 0.4);
        border: 1.5px solid rgba(255,255,255,0.2);
    }

    .header-call-pill:hover {
        background: #ffffff;
        color: #e32845 !important;
        box-shadow: 0 6px 22px rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
        border-color: transparent;
    }

    .header-call-pill .call-icon-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        transition: background 0.3s;
    }
    .header-call-pill:hover .call-icon-circle {
        background: rgba(227, 40, 69, 0.12);
    }

    /* ─── Dropdown Chevron (SVG rotating) ─── */
    .nav-dropdown-chevron {
        display: inline-block;
        width: 16px;
        height: 16px;
        margin-left: 4px;
        vertical-align: middle;
        transition: transform 0.25s ease;
        opacity: 0.85;
    }
    .nav-item.dropdown:hover .nav-dropdown-chevron,
    .nav-item.dropdown.show .nav-dropdown-chevron {
        transform: rotate(180deg);
    }

    /* ─── Dropdown Panel ─── */
    .navbar-area .navbar-nav .dropdown-menu,
    .desktop-nav .navbar .navbar-nav .nav-item .dropdown-menu {
        background: #ffffff !important;
        border: 1px solid rgba(0, 0, 0, 0.07) !important;
        border-top: 3px solid #e32845 !important;
        border-radius: 14px !important;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.18) !important;
        margin-top: 0.75rem !important;
        top: 100% !important;
        min-width: 260px !important;
        max-width: 390px !important;
        width: max-content !important;
        display: none !important;
        padding: 0.6rem !important;
        max-height: 460px !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-6px);
        transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s ease;
    }

    .navbar-area .navbar-nav .dropdown-menu::-webkit-scrollbar {
        width: 5px;
    }
    .navbar-area .navbar-nav .dropdown-menu::-webkit-scrollbar-thumb {
        background: #e0e5ea;
        border-radius: 6px;
    }
    .navbar-area .navbar-nav .dropdown-menu::before {
        display: none !important;
        content: none !important;
    }

    .navbar-area .nav-item.dropdown.show .dropdown-menu,
    .navbar-area .nav-item.dropdown:hover .dropdown-menu {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) !important;
    }

    /* ─── Dropdown Items ─── */
    .navbar-area .dropdown-item,
    .navbar-area .dropdown-menu li a,
    .desktop-nav .navbar .navbar-nav .nav-item .dropdown-menu li a {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        color: #1e293b !important;
        padding: 0.6rem 0.9rem !important;
        margin: 0.08rem 0 !important;
        border-radius: 9px !important;
        border: none !important;
        border-bottom: none !important;
        font-size: 0.91rem !important;
        font-weight: 600 !important;
        line-height: 1.4 !important;
        white-space: normal !important;
        word-break: break-word !important;
        transition: all 0.2s ease;
        background: transparent !important;
        width: 100% !important;
        text-decoration: none !important;
    }
    .navbar-area .dropdown-item .dropdown-item-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(17,29,94,0.07);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 14px;
        color: #111d5e;
        transition: background 0.2s ease, color 0.2s ease;
    }
    .navbar-area .dropdown-menu li {
        padding: 0 !important;
    }
    .navbar-area .dropdown-item:hover,
    .navbar-area .dropdown-item:focus,
    .navbar-area .dropdown-menu li a:hover,
    .navbar-area .dropdown-menu li a:focus {
        background: linear-gradient(90deg, rgba(227,40,69,0.06), rgba(17,29,94,0.04)) !important;
        color: #e32845 !important;
        padding-left: 1.1rem !important;
    }
    .navbar-area .dropdown-item:hover .dropdown-item-icon,
    .navbar-area .dropdown-menu li a:hover .dropdown-item-icon {
        background: rgba(227,40,69,0.1);
        color: #e32845;
    }

    /* ==========================================================
       Mobile navigation (self-contained: no meanmenu dependency)
       ========================================================== */
    @media only screen and (max-width: 991px) {
        .navbar-area {
            position: fixed;
            background: linear-gradient(135deg, #0e1e4a 0%, #111d5e 60%, #0e4b75 100%) !important;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        }

        .mobile-responsive-nav {
            z-index: 1100;
        }

        .mobile-responsive-menu {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.55rem 0;
        }

        .mobile-responsive-menu .logo {
            display: flex;
            align-items: center;
            min-width: 0;
        }

        .mobile-responsive-menu .logo img {
            max-height: 42px;
        }

        /* Hamburger toggler */
        .mobile-nav-toggler {
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            border: none;
            border-radius: 12px;
            background: rgba(43, 48, 58, 0.08);
            cursor: pointer;
            padding: 0;
            transition: background 0.2s ease;
        }

        .mobile-nav-toggler:hover,
        .mobile-nav-toggler:focus {
            background: rgba(43, 48, 58, 0.14);
            outline: none;
        }

        .mobile-nav-toggler .line {
            display: block;
            width: 22px;
            height: 2px;
            border-radius: 2px;
            background: var(--nt-secondary, #2B303A);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .mobile-nav-toggler:not(.collapsed) .line1 {
            transform: translateY(7px) rotate(45deg);
        }

        .mobile-nav-toggler:not(.collapsed) .line2 {
            opacity: 0;
        }

        .mobile-nav-toggler:not(.collapsed) .line3 {
            transform: translateY(-7px) rotate(-45deg);
        }

        /* Mobile menu panel */
        .mobile-nav-menu {
            border-top: 1px solid rgba(15, 23, 42, 0.08);
        }

        .mobile-nav-list {
            list-style: none;
            margin: 0;
            padding: 0.75rem 0 1rem;
            max-height: calc(100vh - 90px);
            overflow-y: auto;
        }

        .mobile-nav-list::-webkit-scrollbar {
            width: 6px;
        }

        .mobile-nav-list::-webkit-scrollbar-thumb {
            background: rgba(15, 23, 42, 0.15);
            border-radius: 6px;
        }

        .mobile-nav-list>li {
            padding: 0 0.75rem;
            margin-bottom: 0.45rem;
        }

        .mobile-nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 12px;
            background: var(--nt-primary-50, #FAFBFC);
            border: 1px solid var(--nt-border, #DDE1E6);
            color: var(--nt-dark, #1A1C20) !important;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link:focus {
            background: var(--sb-accent-cyan, #29A9E0);
            border-color: var(--sb-accent-cyan, #29A9E0);
            color: #ffffff !important;
        }

        /* Submenu (Projects) accordion */
        .mobile-nav-item-has-children .mobile-nav-link .submenu-arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            transition: transform 0.25s ease;
            font-size: 1rem;
        }

        .mobile-nav-item-has-children .mobile-nav-link:not(.collapsed) {
            background: rgba(41, 169, 224, 0.2);
            border-color: var(--sb-accent-cyan, #29A9E0);
        }

        .mobile-nav-item-has-children .mobile-nav-link:not(.collapsed) .submenu-arrow {
            transform: rotate(180deg);
        }

        .mobile-submenu-list {
            list-style: none;
            margin: 0.5rem 0 0;
            padding: 0.6rem;
            background: var(--nt-primary-50, #FAFBFC);
            border: 1px solid var(--nt-border, #DDE1E6);
            border-radius: 12px;
            max-height: 260px;
            overflow-y: auto;
        }

        .mobile-submenu-list::-webkit-scrollbar {
            width: 5px;
        }

        .mobile-submenu-list::-webkit-scrollbar-thumb {
            background: rgba(15, 23, 42, 0.15);
            border-radius: 5px;
        }

        .mobile-submenu-list li+li {
            margin-top: 0.4rem;
        }

        .mobile-submenu-list a {
            display: block;
            padding: 0.7rem 0.9rem;
            border-radius: 99px;
            background: var(--nt-surface, #ffffff);
            border: 1px solid var(--nt-border, #DDE1E6);
            color: var(--nt-dark, #1A1C20);
            font-size: 0.88rem;
            font-weight: 500;
            text-decoration: none;
            word-break: break-word;
        }

        .mobile-submenu-list a:hover,
        .mobile-submenu-list a:focus {
            background: rgba(41, 169, 224, 0.18);
            border-color: var(--sb-accent-cyan, #29A9E0);
        }

        .mobile-submenu-status {
            margin-bottom: 0.5rem;
        }

        .mobile-submenu-status>.mobile-nav-link {
            background: var(--nt-surface, #ffffff);
            border: 1px solid var(--nt-border, #DDE1E6);
            border-radius: 9px;
            padding: 0.7rem 0.9rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--nt-dark, #1A1C20);
        }

        .mobile-submenu-status .mobile-submenu-list {
            margin-top: 0.5rem;
            padding-left: 0.5rem;
            border-left: 3px solid var(--sb-accent-cyan, #29A9E0);
        }

        .mobile-submenu-empty {
            display: block;
            padding: 0.65rem 0.9rem;
            color: var(--nt-text-muted, #6B7280);
            font-size: 0.85rem;
        }
    }

    /* The full desktop nav is hidden on mobile by the theme's responsive.css,
       so no additional overrides are required for .desktop-nav below 992px. */
</style>




<div class="navbar-area nav-bg-1 pb-10">
    @php
        $pendingProjects = DB::table('projects')->where('is_active', 1)->where('status', 1)->latest()->get();
        $runningProjects = DB::table('projects')->where('is_active', 1)->where('status', 2)->latest()->get();
        $completeProjects = DB::table('projects')->where('is_active', 1)->where('status', 3)->latest()->get();
        $services = DB::table('services')->where('is_active', 1)->latest()->get();
    @endphp

    <div class="mobile-responsive-nav">
        <div class="container">
            <div class="mobile-responsive-menu">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset(get_setting('frontend_logo_menu')) }}" class="main-logo" alt="logo">
                        <img src="{{ asset(get_setting('frontend_logo_menu')) }}" class="white-logo" alt="logo">
                    </a>
                </div>

                <button class="mobile-nav-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mobileNavMenu" aria-controls="mobileNavMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </button>
            </div>

            <div class="collapse mobile-nav-menu" id="mobileNavMenu">
                <ul class="mobile-nav-list">
                    <li>
                        <a class="mobile-nav-link" href="/">Home</a>
                    </li>
                    <li>
                        <a class="mobile-nav-link" href="{{ route('about.index') }}">About Us</a>
                    </li>

                    <li class="mobile-nav-item-has-children">
                        <a class="mobile-nav-link collapsed" href="#mobileProjectsSubmenu" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="mobileProjectsSubmenu">
                            Projects
                            <span class="submenu-arrow">▾</span>
                        </a>
                        <div class="collapse" id="mobileProjectsSubmenu">
                            <div class="mobile-submenu-list">
                                <div class="mobile-submenu-status">
                                    <a class="mobile-nav-link collapsed" href="#mobilePendingProjects"
                                        data-bs-toggle="collapse" role="button" aria-expanded="false"
                                        aria-controls="mobilePendingProjects">
                                        Pending
                                        <span class="submenu-arrow">▾</span>
                                    </a>
                                    <div class="collapse" id="mobilePendingProjects">
                                        <ul class="mobile-submenu-list">
                                            @foreach ($pendingProjects as $project)
                                                <li>
                                                    <a href="/study_destination/{{ $project->id }}">
                                                        {{ $project->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="mobile-submenu-status">
                                    <a class="mobile-nav-link collapsed" href="#mobileRunningProjects"
                                        data-bs-toggle="collapse" role="button" aria-expanded="false"
                                        aria-controls="mobileRunningProjects">
                                        Running
                                        <span class="submenu-arrow">▾</span>
                                    </a>
                                    <div class="collapse" id="mobileRunningProjects">
                                        <ul class="mobile-submenu-list">
                                            @foreach ($runningProjects as $project)
                                                <li>
                                                    <a href="/study_destination/{{ $project->id }}">
                                                        {{ $project->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="mobile-submenu-status">
                                    <a class="mobile-nav-link collapsed" href="#mobileCompleteProjects"
                                        data-bs-toggle="collapse" role="button" aria-expanded="false"
                                        aria-controls="mobileCompleteProjects">
                                        Complete
                                        <span class="submenu-arrow">▾</span>
                                    </a>
                                    <div class="collapse" id="mobileCompleteProjects">
                                        <ul class="mobile-submenu-list">
                                            @foreach ($completeProjects as $project)
                                                <li>
                                                    <a href="/study_destination/{{ $project->id }}">
                                                        {{ $project->title }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <a class="mobile-nav-link" href="/service">Services</a>
                    </li>
                    <li>
                        <a class="mobile-nav-link" href="/teams">Our Team</a>
                    </li>
                    <li>
                        <a class="mobile-nav-link" href="/blogs">Blog</a>
                    </li>
                    <li>
                        <a class="mobile-nav-link" href="{{ route('gallery.index') }}">Gallery</a>
                    </li>
                    <li>
                        <a class="mobile-nav-link" href="/contact">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="desktop-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="/" style="margin-left: 0px;">
                    <img src="{{ asset(get_setting('frontend_logo_menu')) }}" alt="logo"
                        style="max-height: 50px; width: auto;">
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active-pill' : '' }}" href="/">
                                Home
                            </a>
                        </li>

                        <li class="nav-item dropdown dropdown-hover">
                            <a class="nav-link {{ request()->is('service*') ? 'active-pill' : '' }}" href="/service" id="servicesDropdown">
                                Our Services
                                <svg class="nav-dropdown-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                @php $serviceIcons = ['ri-brush-line','ri-building-line','ri-drop-line','ri-bug-line','ri-car-wash-line','ri-home-heart-line','ri-hotel-line','ri-tools-line','ri-landscape-line','ri-cup-line']; @endphp
                                @foreach ($services as $svcIdx => $service)
                                    <li>
                                        <a class="dropdown-item" href="/service">
                                            <span class="dropdown-item-icon">
                                                <i class="{{ $serviceIcons[$svcIdx % count($serviceIcons)] }}"></i>
                                            </span>
                                            <span>{{ $service->title }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('appointment*') ? 'active-pill' : '' }}" href="{{ route('appointment.index') }}">
                                Book a Appointment
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('about*') ? 'active-pill' : '' }}" href="{{ route('about.index') }}">
                                About Us
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact*') ? 'active-pill' : '' }}" href="/contact">
                                Contact Us
                            </a>
                        </li>
                    </ul>

                    <div class="header-call-btn-wrapper ms-4 d-none d-lg-block">
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('office_phone', '01768044211')) }}" class="header-call-pill">
                            <span>{{ get_setting('office_phone', '01768044211') }}</span>
                            <span class="call-icon-circle"><i class="ri-phone-fill"></i></span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

<script>
    // Transparent header at top → navy on scroll
    (function() {
        var navbar = document.querySelector('.navbar-area');
        if (!navbar) return;
        function updateNavbar() {
            if (window.scrollY > 60) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        window.addEventListener('scroll', updateNavbar, { passive: true });
        updateNavbar(); // run on load in case page is already scrolled
    })();
</script>

<script>
    // Desktop dropdown: allow click-to-toggle in addition to hover (useful for touch/tablet)
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.dropdown-toggle.custom-arrow').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                if (window.innerWidth <= 991) return; // mobile uses its own menu
                e.preventDefault();
                var parent = btn.closest('.nav-item.dropdown');
                if (!parent) return;
                document.querySelectorAll('.nav-item.dropdown.show').forEach(function(open) {
                    if (open !== parent) open.classList.remove('show');
                });
                parent.classList.toggle('show');
            });
        });

        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 991) return;
            if (!e.target.closest('.navbar-area')) {
                document.querySelectorAll('.nav-item.dropdown.show').forEach(function(open) {
                    open.classList.remove('show');
                });
            }
        });

        document.querySelectorAll('.projects-status-tab').forEach(function(tab) {
            function activateTab() {
                var status = tab.getAttribute('data-status');
                document.querySelectorAll('.projects-status-tab').forEach(function(item) {
                    item.classList.toggle('active', item === tab);
                });
                document.querySelectorAll('.projects-status-panel').forEach(function(panel) {
                    panel.classList.toggle('active', panel.getAttribute('data-status') ===
                        status);
                });
                var dropdownPanel = tab.closest('.projects-dropdown-panel');
                if (dropdownPanel) {
                    dropdownPanel.classList.add('active-status');
                }
            }

            tab.addEventListener('click', function() {
                activateTab();
            });
            tab.addEventListener('mouseenter', function() {
                activateTab();
            });
        });

        // Collapse the mobile menu automatically when resizing up to desktop width
        window.addEventListener('resize', function() {
            if (window.innerWidth > 991 && window.bootstrap) {
                document.querySelectorAll('#mobileNavMenu.show, #mobileNavMenu .collapse.show').forEach(
                    function(el) {
                        var instance = bootstrap.Collapse.getInstance(el);
                        if (instance) {
                            instance.hide();
                        } else {
                            el.classList.remove('show');
                        }
                    });
            }
        });
    });
</script>
