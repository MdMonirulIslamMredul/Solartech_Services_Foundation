<style>
    .navbar-area {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999;
        background: rgba(43, 48, 58, 0.28) !important;
        padding: 0.65rem 0;
        transition: all 0.3s ease;
    }

    .navbar-area.scrolled {
        position: fixed;
        background: rgba(43, 48, 58, 0.97) !important;
        backdrop-filter: blur(12px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.18);
        padding: 0.65rem 0;
    }

    .navbar-area .navbar-nav {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .navbar-area .navbar-nav .nav-item {
        position: relative;
    }

    .navbar-area .navbar-nav .nav-link {
        color: #ffffff !important;
        font-size: 0.96rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        padding: 0.75rem 0.9rem;
        border-radius: 999px;
        transition: all 0.2s ease;
        text-transform: none;
    }

    .navbar-area .navbar-brand img,
    .mobile-responsive-menu .logo img {
        background: #ffffff;
        padding: 0.35rem 0.45rem;
        border-radius: 10px;
        max-height: 50px;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.12);
    }

    .navbar-area .navbar-nav .nav-link:hover,
    .navbar-area .navbar-nav .nav-link:focus,
    .navbar-area .navbar-nav .nav-item.active .nav-link {
        background: rgba(255, 209, 102, 0.16);
        color: var(--nt-accent, #FFD166) !important;
        transform: translateY(-1px);
    }

    /* Note: the base theme's style.css defines a very high-specificity
       ".desktop-nav .navbar .navbar-nav .nav-item .dropdown-menu li a" rule
       (fixed width, line-height:1, dashed border-bottom) that would otherwise
       clip/compress project titles. Every property below is flagged
       !important so this component's design always wins regardless of
       selector specificity or load order. */
    .navbar-area .navbar-nav .dropdown-menu,
    .desktop-nav .navbar .navbar-nav .nav-item .dropdown-menu {
        background: var(--nt-surface, #ffffff) !important;
        border: none !important;
        border-top: 3px solid var(--nt-accent, #FFD166) !important;
        border-radius: 10px !important;
        box-shadow: 0 20px 45px rgba(26, 28, 32, 0.22) !important;
        margin-top: 0.85rem !important;
        top: 100% !important;
        min-width: 280px !important;
        max-width: 360px !important;
        width: max-content !important;
        display: block !important;
        padding: 0.5rem !important;
        max-height: 420px !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        transform: translateY(8px);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s ease;
    }

    .navbar-area .navbar-nav .dropdown-menu::-webkit-scrollbar {
        width: 6px;
    }

    .navbar-area .navbar-nav .dropdown-menu::-webkit-scrollbar-thumb {
        background: var(--nt-border, #DDE1E6);
        border-radius: 6px;
    }

    .navbar-area .navbar-nav .dropdown-menu::before {
        display: none !important;
        content: none !important;
    }

    .navbar-area .nav-item.dropdown.show .dropdown-menu,
    .navbar-area .nav-item.dropdown:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .navbar-area .dropdown-submenu {
        position: relative;
    }

    .navbar-area .dropdown-submenu>.dropdown-menu {
        position: absolute !important;
        top: 0 !important;
        left: 100% !important;
        margin: 0 !important;
        min-width: 220px !important;
        max-width: 280px !important;
        padding: 0.5rem !important;
        box-shadow: 0 18px 35px rgba(26, 28, 32, 0.18) !important;
        border-radius: 10px !important;
        opacity: 0;
        visibility: hidden;
        transform: translateX(15px);
        transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
    }

    .navbar-area .dropdown-submenu:hover>.dropdown-menu,
    .navbar-area .dropdown-submenu.show>.dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateX(0);
    }

    .navbar-area .dropdown-item,
    .navbar-area .dropdown-menu li a,
    .desktop-nav .navbar .navbar-nav .nav-item .dropdown-menu li a {
        display: block !important;
        color: var(--nt-dark, #1A1C20) !important;
        padding: 0.7rem 0.9rem !important;
        margin: 0.15rem 0 !important;
        border-radius: 8px !important;
        border: none !important;
        border-bottom: none !important;
        border-left: 3px solid transparent !important;
        font-size: 0.92rem !important;
        font-weight: 600 !important;
        line-height: 1.4 !important;
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: anywhere !important;
        text-overflow: clip !important;
        overflow: visible !important;
        transition: all 0.2s ease;
        background: transparent !important;
        width: 100% !important;
    }

    .navbar-area .dropdown-menu li {
        padding: 0 !important;
    }

    .navbar-area .dropdown-item+.dropdown-item,
    .navbar-area .dropdown-menu li+li {
        border-top: 1px solid var(--nt-border, #DDE1E6) !important;
        margin-top: 0.15rem !important;
        padding-top: 0.7rem;
    }

    .navbar-area .dropdown-item:hover,
    .navbar-area .dropdown-item:focus,
    .navbar-area .dropdown-item:active,
    .navbar-area .dropdown-item.active,
    .navbar-area .dropdown-menu li a:hover,
    .navbar-area .dropdown-menu li a:focus,
    .navbar-area .projects-status-item:hover,
    .navbar-area .projects-status-item:focus {
        background: var(--nt-accent-10, rgba(255, 209, 102, 0.14)) !important;
        color: var(--nt-dark, #1A1C20) !important;
        border-left-color: var(--nt-accent, #FFD166) !important;
        transform: translateX(3px);
    }

    .navbar-area .dropdown-toggle.custom-arrow {
        position: relative;
        padding-right: 2rem;
    }

    .projects-dropdown {
        min-width: auto !important;
        width: auto !important;
        max-width: none !important;
        padding: 0 !important;
        overflow: visible !important;
    }

    .navbar-area .navbar-nav .dropdown-menu.projects-dropdown,
    .desktop-nav .navbar .navbar-nav .nav-item .dropdown-menu.projects-dropdown,
    .dropdown-menu.projects-dropdown {
        position: absolute !important;
        left: 0 !important;
        right: auto !important;
        display: block !important;
        max-width: none !important;
        min-width: 640px !important;
        width: auto !important;
        overflow: visible !important;
        padding: 0 !important;
        white-space: normal !important;
        max-height: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        background: transparent !important;
    }

    .projects-dropdown-panel {
        display: grid !important;
        grid-template-columns: 220px 0fr !important;
        gap: 1rem !important;
        padding: 1rem !important;
        background: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        box-shadow: none !important;
        min-width: 700px !important;
        max-width: 980px !important;
        width: 100% !important;
    }

    .projects-dropdown-panel.active-status {
        grid-template-columns: 220px minmax(380px, 1fr) !important;
    }

    .projects-status-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        min-width: 220px;
        background: #ffffff;
        border: 1px solid #e5e8ec;
        border-radius: 18px;
        padding: 0.8rem;
        box-shadow: 0 16px 30px rgba(15, 23, 42, 0.08);
        min-height: 220px;
    }

    .projects-status-tab {
        appearance: none;
        background: #f8f9fb;
        border: 1px solid #e5e8ec;
        border-radius: 12px;
        color: #252a31;
        font-weight: 700;
        padding: 0.85rem 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 54px;
    }

    .projects-status-tab.active {
        background: #ffffff;
        border-color: #ffd166;
        box-shadow: inset 0 0 0 1px #ffd166;
        color: #1a1c20;
    }

    .projects-status-content {
        display: flex;
        flex: 1 1 auto;
        min-width: 320px;
        align-items: flex-start;
        background: #ffffff;
        border: 1px solid #e5e8ec;
        border-radius: 18px;
        padding: 0.8rem;
        box-shadow: 0 16px 30px rgba(15, 23, 42, 0.08);
        opacity: 0;
        visibility: hidden;
        width: 0;
        padding: 0;
        overflow: hidden;
        transition: all 0.2s ease;
    }

    .projects-dropdown-panel.active-status .projects-status-content {
        opacity: 1;
        visibility: visible;
        width: auto;
        padding: 0.8rem;
    }

    .projects-status-panel {
        display: none;
        width: 100%;
        gap: 0.75rem;
    }

    .projects-status-panel.active {
        display: block;
    }

    .projects-status-panel-header {
        font-size: 0.96rem;
        font-weight: 700;
        color: #1a1c20;
        margin-bottom: 0.75rem;
    }

    .projects-status-content {
        min-height: 240px;
    }

    .projects-status-items {
        display: grid;
        gap: 0.55rem;
    }

    .projects-status-item {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: #f8f9fb !important;
        color: #252a31 !important;
        padding: 0.85rem 0.95rem !important;
        border-radius: 12px !important;
        border: 1px solid #e5e8ec !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        transition: all 0.2s ease !important;
        white-space: nowrap !important;
        width: auto !important;
        max-width: 100% !important;
        min-height: 52px;
    }

    .projects-status-item:hover,
    .projects-status-item:focus {
        background: #fff9e6 !important;
        border-color: #ffd166 !important;
        color: #1a1c20 !important;
        transform: translateX(2px) !important;
    }

    .projects-status-empty {
        display: block;
        padding: 1rem;
        background: #fbfbfb;
        border: 1px dashed #dbe2e8;
        border-radius: 12px;
        color: #6b7280;
    }

    .navbar-area .dropdown-toggle.custom-arrow::after {
        content: "▾";
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.86rem;
        color: inherit;
        transition: transform 0.2s ease;
    }

    .navbar-area .nav-item.dropdown.show .dropdown-toggle.custom-arrow::after,
    .navbar-area .nav-item.dropdown:hover .dropdown-toggle.custom-arrow::after {
        transform: translateY(-50%) rotate(180deg);
    }

    /* ==========================================================
       Mobile navigation (self-contained: no meanmenu dependency)
       ========================================================== */
    @media only screen and (max-width: 991px) {
        .navbar-area {
            position: relative;
            background: rgba(241, 243, 245, 0.98) !important;
            padding: 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
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
            background: var(--nt-accent, #FFD166);
            border-color: var(--nt-accent, #FFD166);
            color: var(--nt-dark, #1A1C20) !important;
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
            background: var(--nt-accent-25, rgba(255, 209, 102, 0.25));
            border-color: var(--nt-accent, #FFD166);
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
            border-radius: 9px;
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
            background: var(--nt-accent-25, rgba(255, 209, 102, 0.25));
            border-color: var(--nt-accent, #FFD166);
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
            border-left: 3px solid var(--nt-accent, #FFD166);
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
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="/" style="margin-left: 0px;">
                    <img src="{{ asset(get_setting('frontend_logo_menu')) }}" alt="logo"
                        style="max-height: 50px; width: auto;">
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about.index') }}">
                                About Us
                            </a>
                        </li>

                        <li class="nav-item dropdown dropdown-hover">
                            <a class="nav-link dropdown-toggle custom-arrow" href="#"
                                id="studyDestinationDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Projects
                            </a>
                            <div class="dropdown-menu projects-dropdown" aria-labelledby="studyDestinationDropdown">
                                <div class="projects-dropdown-panel">
                                    <div class="projects-status-list">
                                        <button type="button" class="projects-status-tab" data-status="pending">
                                            Pending
                                        </button>
                                        <button type="button" class="projects-status-tab" data-status="running">
                                            Running
                                        </button>
                                        <button type="button" class="projects-status-tab" data-status="complete">
                                            Complete
                                        </button>
                                    </div>
                                    <div class="projects-status-content">
                                        <div class="projects-status-panel" data-status="pending">
                                            <div class="projects-status-panel-header">Pending projects</div>
                                            <div class="projects-status-items">
                                                @forelse ($pendingProjects as $project)
                                                    <a class="projects-status-item"
                                                        href="/study_destination/{{ $project->id }}">
                                                        {{ $project->title }}
                                                    </a>
                                                @empty
                                                    <span class="projects-status-empty">No pending projects</span>
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="projects-status-panel" data-status="running">
                                            <div class="projects-status-panel-header">Running projects</div>
                                            <div class="projects-status-items">
                                                @forelse ($runningProjects as $project)
                                                    <a class="projects-status-item"
                                                        href="/study_destination/{{ $project->id }}">
                                                        {{ $project->title }}
                                                    </a>
                                                @empty
                                                    <span class="projects-status-empty">No running projects</span>
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="projects-status-panel" data-status="complete">
                                            <div class="projects-status-panel-header">Complete projects</div>
                                            <div class="projects-status-items">
                                                @forelse ($completeProjects as $project)
                                                    <a class="projects-status-item"
                                                        href="/study_destination/{{ $project->id }}">
                                                        {{ $project->title }}
                                                    </a>
                                                @empty
                                                    <span class="projects-status-empty">No complete projects</span>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/service">
                                Services
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/teams">
                                Our Team
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/blogs">
                                Blog
                            </a>
                        </li>

                        {{-- Gallery option --}}

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gallery.index') }}">
                                Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

<script>
    // Add scroll event listener for header background
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('.navbar-area');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
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
