@php
    $services = DB::table('services')->where('is_active', 1)->orderBy('id', 'asc')->get();
@endphp

<style>
    /* ═══════════════════════════════════════════════════════
       MODERN PROFESSIONAL HEADER — Solartech Services
       Color Theme: Navy #1B3A6B | Cyan #29A9E0
       ═══════════════════════════════════════════════════════ */

    /* ── Google Font ── */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    /* ── Top Info Bar ── */
    .hdr-topbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 10000;
        background: linear-gradient(90deg, rgb(14, 30, 74) 0%, rgb(20, 44, 82) 60%, rgb(14, 75, 117) 100%);
        padding: 7px 0;
        font-family: 'Inter', sans-serif;
        border-bottom: 1px solid rgba(41, 169, 224, 0.2);
        transition: transform 0.35s ease, opacity 0.35s ease;
        will-change: transform;
    }

    .hdr-topbar.hdr-topbar-hidden {
        transform: translateY(-100%);
        opacity: 0;
        pointer-events: none;
    }

    .hdr-topbar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .hdr-topbar-left {
        display: flex;
        align-items: center;
        gap: 1.4rem;
        flex-wrap: wrap;
    }

    .hdr-topbar-item {
        display: flex;
        align-items: center;
        gap: 7px;
        color: rgba(255, 255, 255, 0.82);
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s;
    }

    .hdr-topbar-item i {
        color: #29A9E0;
        font-size: 14px;
    }

    .hdr-topbar-item:hover {
        color: #29A9E0;
        text-decoration: none;
    }

    .hdr-topbar-right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .hdr-social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: #fff !important;
        font-size: 13px;
        text-decoration: none !important;
        transition: all 0.25s ease;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .hdr-social-link:hover {
        background: #29A9E0;
        border-color: #29A9E0;
        transform: translateY(-2px);
        color: #fff !important;
    }

    /* ── Main Navbar ── */
    .hdr-navbar {
        position: fixed;
        top: 37px;
        /* sits below the topbar; JS will recalculate */
        left: 0;
        width: 100%;
        z-index: 9999;
        background: #fff;
        box-shadow: 0 2px 20px rgba(27, 58, 107, 0.10);
        font-family: 'Inter', sans-serif;
        transition: box-shadow 0.3s ease, top 0.35s ease;
    }

    .hdr-navbar.hdr-scrolled {
        box-shadow: 0 6px 32px rgba(27, 58, 107, 0.20);
    }

    .hdr-navbar-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        height: 88px;
    }

    /* ── Logo ── */
    .hdr-logo a {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .hdr-logo img {
        height: 64px;
        max-height: 64px;
        width: auto;
        object-fit: contain;
        background: #fff;
        padding: 4px 6px;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .hdr-logo img:hover {
        transform: scale(1.03);
    }

    /* ── Desktop Nav Links ── */
    .hdr-nav {
        display: flex;
        align-items: center;
        gap: 2px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .hdr-nav-item {
        position: relative;
    }

    .hdr-nav-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 15px;
        color: #1B3A6B !important;
        font-size: 14.5px;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none !important;
        transition: all 0.22s ease;
        white-space: nowrap;
        position: relative;
    }

    .hdr-nav-link::after {
        content: '';
        position: absolute;
        bottom: 4px;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        width: calc(100% - 24px);
        height: 2.5px;
        background: #29A9E0;
        border-radius: 2px;
        transition: transform 0.25s ease;
    }

    .hdr-nav-link:hover,
    .hdr-nav-link:focus {
        color: #29A9E0 !important;
        background: rgba(41, 169, 224, 0.07);
    }

    .hdr-nav-link:hover::after {
        transform: translateX(-50%) scaleX(1);
    }

    /* Active state */
    .hdr-nav-link.hdr-active {
        color: #29A9E0 !important;
        background: rgba(41, 169, 224, 0.09);
    }

    .hdr-nav-link.hdr-active::after {
        transform: translateX(-50%) scaleX(1);
    }

    /* ── Dropdown chevron ── */
    .hdr-chevron {
        display: inline-block;
        width: 14px;
        height: 14px;
        transition: transform 0.25s ease;
        opacity: 0.7;
        flex-shrink: 0;
    }

    .hdr-nav-item:hover .hdr-chevron,
    .hdr-nav-item.hdr-open .hdr-chevron {
        transform: rotate(180deg);
        opacity: 1;
    }

    /* ── Dropdown Panel ── */
    .hdr-dropdown {
        position: absolute;
        top: calc(100% + 10px);
        left: 50%;
        transform: translateX(-50%) translateY(-6px);
        min-width: 260px;
        max-width: 320px;
        background: #fff;
        border: 1px solid rgba(27, 58, 107, 0.08);
        border-top: 3px solid #29A9E0;
        border-radius: 14px;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.15);
        padding: 8px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s;
        z-index: 100;
        max-height: 440px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .hdr-dropdown::-webkit-scrollbar {
        width: 4px;
    }

    .hdr-dropdown::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 4px;
    }

    .hdr-nav-item:hover .hdr-dropdown,
    .hdr-nav-item.hdr-open .hdr-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }

    .hdr-dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 12px;
        border-radius: 9px;
        color: #1e293b !important;
        font-size: 13.5px;
        font-weight: 600;
        text-decoration: none !important;
        transition: all 0.2s ease;
        margin-bottom: 2px;
    }

    .hdr-dropdown-item-icon {
        width: 30px;
        height: 30px;
        border-radius: 7px;
        background: rgba(27, 58, 107, 0.07);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: #1B3A6B;
        flex-shrink: 0;
        transition: all 0.2s;
    }

    .hdr-dropdown-item:hover {
        background: rgba(41, 169, 224, 0.08);
        color: #29A9E0 !important;
        padding-left: 16px;
    }

    .hdr-dropdown-item:hover .hdr-dropdown-item-icon {
        background: rgba(41, 169, 224, 0.12);
        color: #29A9E0;
    }

    /* ── Phone CTA Pill Button ── */
    .hdr-call-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #1B3A6B;
        color: #fff !important;
        padding: 7px 8px 7px 18px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 14px;
        white-space: nowrap;
        text-decoration: none !important;
        transition: all 0.28s ease;
        box-shadow: 0 4px 16px rgba(27, 58, 107, 0.3);
        border: 2px solid transparent;
        flex-shrink: 0;
    }

    .hdr-call-btn:hover {
        background: #29A9E0;
        box-shadow: 0 6px 22px rgba(41, 169, 224, 0.45);
        transform: translateY(-2px);
        color: #fff !important;
    }

    .hdr-call-icon {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(41, 169, 224, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        transition: background 0.25s;
        flex-shrink: 0;
    }

    .hdr-call-btn:hover .hdr-call-icon {
        background: rgba(255, 255, 255, 0.25);
    }

    /* ══════════════════════════════════
       MOBILE MENU
       ══════════════════════════════════ */
    .hdr-hamburger {
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 10px;
        background: rgba(27, 58, 107, 0.08);
        cursor: pointer;
        padding: 0;
        transition: background 0.2s;
        flex-shrink: 0;
    }

    .hdr-hamburger:hover {
        background: rgba(27, 58, 107, 0.14);
    }

    .hdr-hamburger:focus {
        outline: none;
    }

    .hdr-ham-bar {
        display: block;
        width: 22px;
        height: 2px;
        border-radius: 2px;
        background: #1B3A6B;
        transition: transform 0.3s ease, opacity 0.3s ease, width 0.3s ease;
    }

    .hdr-hamburger.is-open .hdr-ham-bar:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
    }

    .hdr-hamburger.is-open .hdr-ham-bar:nth-child(2) {
        opacity: 0;
        width: 0;
    }

    .hdr-hamburger.is-open .hdr-ham-bar:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
    }

    /* Mobile Drawer */
    .hdr-mobile-drawer {
        position: fixed;
        top: 0;
        right: -100%;
        width: min(320px, 88vw);
        height: 100%;
        background: #fff;
        z-index: 99998;
        box-shadow: -4px 0 40px rgba(27, 58, 107, 0.18);
        transition: right 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }

    .hdr-mobile-drawer.is-open {
        right: 0;
    }

    .hdr-drawer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid #e8edf5;
        background: linear-gradient(135deg, rgb(20, 44, 82), rgb(14, 75, 117));
    }

    .hdr-drawer-logo img {
        height: 42px;
        background: rgba(255, 255, 255, 0.95);
        padding: 3px 5px;
        border-radius: 7px;
    }

    .hdr-drawer-close {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
        line-height: 1;
    }

    .hdr-drawer-close:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .hdr-drawer-body {
        padding: 16px 14px;
        flex: 1;
    }

    .hdr-mobile-nav {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .hdr-mobile-nav-item {
        margin-bottom: 6px;
    }

    .hdr-mobile-nav-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        border-radius: 10px;
        color: #1B3A6B !important;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none !important;
        background: #f5f7fb;
        border: 1px solid #e2e8f0;
        transition: all 0.22s ease;
        cursor: pointer;
        width: 100%;
        border: 1px solid #e8edf5;
    }

    .hdr-mobile-nav-link:hover,
    .hdr-mobile-nav-link.hdr-mob-active {
        background: #1B3A6B;
        color: #fff !important;
        border-color: #1B3A6B;
    }

    .hdr-mobile-sub-arrow {
        font-size: 13px;
        transition: transform 0.25s;
        flex-shrink: 0;
    }

    .hdr-mobile-sub-arrow.rotated {
        transform: rotate(180deg);
    }

    .hdr-mobile-submenu {
        display: none;
        list-style: none;
        margin: 6px 0 0;
        padding: 6px;
        background: #f8fafc;
        border: 1px solid #e8edf5;
        border-radius: 10px;
    }

    .hdr-mobile-submenu.is-open {
        display: block;
    }

    .hdr-mobile-submenu li {
        margin-bottom: 4px;
    }

    .hdr-mobile-submenu a {
        display: block;
        padding: 9px 14px;
        border-radius: 7px;
        color: #334155 !important;
        font-size: 13.5px;
        font-weight: 500;
        text-decoration: none !important;
        background: #fff;
        border: 1px solid #e8edf5;
        transition: all 0.2s;
    }

    .hdr-mobile-submenu a:hover {
        background: rgba(41, 169, 224, 0.1);
        color: #29A9E0 !important;
        border-color: #29A9E0;
    }

    .hdr-drawer-call {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 16px;
        margin-top: 10px;
        background: linear-gradient(135deg, #1B3A6B, #29A9E0);
        border-radius: 12px;
        color: #fff !important;
        font-weight: 700;
        font-size: 15px;
        text-decoration: none !important;
        transition: opacity 0.2s;
    }

    .hdr-drawer-call:hover {
        opacity: 0.92;
        color: #fff !important;
    }

    .hdr-drawer-call i {
        font-size: 18px;
    }

    /* Mobile overlay */
    .hdr-overlay {
        position: fixed;
        inset: 0;
        background: rgba(10, 20, 50, 0.55);
        z-index: 99997;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.35s, visibility 0.35s;
        backdrop-filter: blur(2px);
    }

    .hdr-overlay.is-open {
        opacity: 1;
        visibility: visible;
    }

    /* ── Responsive breakpoints ── */
    @media (max-width: 991px) {
        .hdr-topbar-left .hdr-topbar-item:not(:first-child) {
            display: none;
        }

        .hdr-desktop-nav,
        .hdr-call-btn {
            display: none !important;
        }

        .hdr-hamburger {
            display: inline-flex;
        }

        .hdr-navbar-inner {
            height: 76px;
        }
    }

    @media (max-width: 575px) {
        .hdr-topbar {
            display: none;
        }
    }

    @media (min-width: 992px) {
        .hdr-hamburger {
            display: none;
        }

        .hdr-mobile-drawer,
        .hdr-overlay {
            display: none !important;
        }
    }
</style>

{{-- ═══ TOP INFO BAR ═══ --}}
<div class="hdr-topbar">
    <div class="container">
        <div class="hdr-topbar-inner">
            <div class="hdr-topbar-left">
                <a href="mailto:{{ get_setting('office_email') }}" class="hdr-topbar-item">
                    <i class="ri-mail-line"></i>
                    <span>{{ get_setting('office_email') }}</span>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('office_phone')) }}" class="hdr-topbar-item">
                    <i class="ri-phone-line"></i>
                    <span>{{ get_setting('office_phone') }}</span>
                </a>
                <span class="hdr-topbar-item d-none d-lg-flex">
                    <i class="ri-map-pin-line"></i>
                    <span>{{ get_setting('office_address') }}</span>
                </span>
            </div>
            <div class="hdr-topbar-right">
                <a href="{{ get_setting('facebook') }}" target="_blank" class="hdr-social-link" aria-label="Facebook"><i
                        class="ri-facebook-fill"></i></a>
                <a href="{{ get_setting('twitter') }}" target="_blank" class="hdr-social-link" aria-label="Twitter"><i
                        class="ri-twitter-fill"></i></a>
                <a href="{{ get_setting('instagram') }}" target="_blank" class="hdr-social-link"
                    aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                <a href="{{ get_setting('linkedin') }}" target="_blank" class="hdr-social-link" aria-label="LinkedIn"><i
                        class="ri-linkedin-fill"></i></a>
            </div>
        </div>
    </div>
</div>

{{-- ═══ MAIN NAVBAR ═══ --}}
<header class="hdr-navbar" id="hdrNavbar">
    <div class="container">
        <div class="hdr-navbar-inner">

            {{-- Logo --}}
            <div class="hdr-logo">
                <a href="/">
                    <img src="{{ asset(get_setting('frontend_logo_menu')) }}" alt="{{ app_name() }} Logo">
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <nav class="hdr-desktop-nav" aria-label="Main Navigation">
                <ul class="hdr-nav">
                    <li class="hdr-nav-item">
                        <a href="/" class="hdr-nav-link {{ request()->is('/') ? 'hdr-active' : '' }}">
                            Home
                        </a>
                    </li>

                    <li class="hdr-nav-item" id="servicesNavItem">
                        <a href="/service" class="hdr-nav-link {{ request()->is('service*') ? 'hdr-active' : '' }}">
                            Our Services
                            <svg class="hdr-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </a>
                        <div class="hdr-dropdown" id="servicesDropdown">
                            @php
                                $svcIcons = ['ri-brush-line', 'ri-building-line', 'ri-drop-line', 'ri-bug-line', 'ri-car-wash-line', 'ri-home-heart-line', 'ri-hotel-line', 'ri-tools-line', 'ri-landscape-line', 'ri-cup-line'];
                            @endphp
                            @foreach ($services as $idx => $svc)
                                <a href="/service/{{ $svc->id }}" class="hdr-dropdown-item">
                                    <span class="hdr-dropdown-item-icon"><i
                                            class="{{ $svcIcons[$idx % count($svcIcons)] }}"></i></span>
                                    <span>{{ $svc->title }}</span>
                                </a>
                            @endforeach
                        </div>
                    </li>

                    <li class="hdr-nav-item">
                        <a href="{{ route('appointment.index') }}"
                            class="hdr-nav-link {{ request()->is('appointment*') ? 'hdr-active' : '' }}">
                            Book Appointment
                        </a>
                    </li>

                    <li class="hdr-nav-item">
                        <a href="/teams" class="hdr-nav-link {{ request()->is('team*') ? 'hdr-active' : '' }}">
                            Our Team
                        </a>
                    </li>
                    {{-- add blog page link --}}

                    <li class="hdr-nav-item">
                        <a href="/blogs" class="hdr-nav-link {{ request()->is('blogs') ? 'hdr-active' : '' }}">
                            Blog
                        </a>
                    </li>

                    <li class="hdr-nav-item">
                        <a href="{{ route('gallery.index') }}"
                            class="hdr-nav-link {{ request()->is('gallery*') ? 'hdr-active' : '' }}">
                            Gallery
                        </a>
                    </li>
                    <li class="hdr-nav-item">
                        <a href="{{ route('about.index') }}"
                            class="hdr-nav-link {{ request()->is('about*') ? 'hdr-active' : '' }}">
                            About Us
                        </a>
                    </li>

                    <li class="hdr-nav-item">
                        <a href="/contact" class="hdr-nav-link {{ request()->is('contact*') ? 'hdr-active' : '' }}">
                            Contact Us
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- Phone CTA + Hamburger --}}
            <div style="display:flex;align-items:center;gap:12px;flex-shrink:0;">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('office_phone', '01768044211')) }}"
                    class="hdr-call-btn" aria-label="Call us">
                    <span>{{ get_setting('office_phone', '01768044211') }}</span>
                    <span class="hdr-call-icon"><i class="ri-phone-fill"></i></span>
                </a>

                <button class="hdr-hamburger" id="hdrHamburger" aria-label="Open menu" aria-expanded="false"
                    aria-controls="hdrMobileDrawer">
                    <span class="hdr-ham-bar"></span>
                    <span class="hdr-ham-bar"></span>
                    <span class="hdr-ham-bar"></span>
                </button>
            </div>

        </div>
    </div>
</header>

{{-- ═══ MOBILE OVERLAY ═══ --}}
<div class="hdr-overlay" id="hdrOverlay" aria-hidden="true"></div>

{{-- ═══ MOBILE DRAWER ═══ --}}
<div class="hdr-mobile-drawer" id="hdrMobileDrawer" role="dialog" aria-modal="true" aria-label="Navigation Menu">
    <div class="hdr-drawer-header">
        <div class="hdr-drawer-logo">
            <a href="/"><img src="{{ asset(get_setting('frontend_logo_menu')) }}" alt="{{ app_name() }} Logo"></a>
        </div>
        <button class="hdr-drawer-close" id="hdrDrawerClose" aria-label="Close menu">✕</button>
    </div>

    <div class="hdr-drawer-body">
        <ul class="hdr-mobile-nav">
            <li class="hdr-mobile-nav-item">
                <a href="/" class="hdr-mobile-nav-link {{ request()->is('/') ? 'hdr-mob-active' : '' }}">Home</a>
            </li>

            <li class="hdr-mobile-nav-item">
                <button class="hdr-mobile-nav-link w-100 text-start" id="mobileServicesToggle" aria-expanded="false"
                    aria-controls="mobileServicesSubmenu">
                    <span>Our Services</span>
                    <span class="hdr-mobile-sub-arrow" id="mobileServicesArrow">▾</span>
                </button>
                <ul class="hdr-mobile-submenu" id="mobileServicesSubmenu">
                    @foreach ($services as $svc)
                        <li><a href="/service/{{ $svc->id }}">{{ $svc->title }}</a></li>
                    @endforeach
                </ul>
            </li>

            <li class="hdr-mobile-nav-item">
                <a href="{{ route('appointment.index') }}"
                    class="hdr-mobile-nav-link {{ request()->is('appointment*') ? 'hdr-mob-active' : '' }}">Book
                    Appointment</a>
            </li>

            <li class="hdr-mobile-nav-item">
                <a href="/teams" class="hdr-mobile-nav-link {{ request()->is('team*') ? 'hdr-mob-active' : '' }}">Our
                    Team</a>
            </li>

            <li class="hdr-mobile-nav-item">
                <a href="{{ route('about.index') }}"
                    class="hdr-mobile-nav-link {{ request()->is('about*') ? 'hdr-mob-active' : '' }}">About Us</a>
            </li>

            <li class="hdr-mobile-nav-item">
                <a href="/contact"
                    class="hdr-mobile-nav-link {{ request()->is('contact*') ? 'hdr-mob-active' : '' }}">Contact Us</a>
            </li>
        </ul>

        <a href="tel:{{ preg_replace('/[^0-9+]/', '', get_setting('office_phone', '01768044211')) }}"
            class="hdr-drawer-call">
            <i class="ri-phone-fill"></i>
            <span>{{ get_setting('office_phone', '01768044211') }}</span>
        </a>
    </div>
</div>

{{-- Spacer so page content starts below the fixed header --}}
<div id="hdrSpacer"></div>

<script>
    (function () {
        'use strict';

        var topbar = document.querySelector('.hdr-topbar');
        var navbar = document.getElementById('hdrNavbar');
        var spacer = document.getElementById('hdrSpacer');
        var ham = document.getElementById('hdrHamburger');
        var drawer = document.getElementById('hdrMobileDrawer');
        var overlay = document.getElementById('hdrOverlay');
        var closeBtn = document.getElementById('hdrDrawerClose');

        /* ── Recalculate fixed positions and spacer height ── */
        function updateLayout() {
            var topbarH = topbar ? topbar.offsetHeight : 0;
            var navbarH = navbar ? navbar.offsetHeight : 0;

            // On mobile (<576px) topbar is hidden via CSS — treat as 0
            if (window.innerWidth < 576) {
                topbarH = 0;
            }

            if (navbar) {
                navbar.style.top = topbarH + 'px';
            }
            if (spacer) {
                spacer.style.height = (topbarH + navbarH) + 'px';
            }
            if (drawer) {
                // Keep mobile drawer below the full fixed header
                drawer.style.top = (topbarH + navbarH) + 'px';
                drawer.style.height = 'calc(100vh - ' + (topbarH + navbarH) + 'px)';
            }
        }

        /* ── Shadow + topbar hide on scroll ── */
        var SCROLL_THRESHOLD = 60;

        function onScroll() {
            var scrolled = window.scrollY > SCROLL_THRESHOLD;

            // Toggle scrolled shadow
            navbar.classList.toggle('hdr-scrolled', scrolled);

            // Hide/show topbar
            if (topbar) {
                topbar.classList.toggle('hdr-topbar-hidden', scrolled);
            }

            // Move navbar: 0 when topbar hidden, topbar height when visible
            var topbarH = (topbar && !scrolled && window.innerWidth >= 576)
                ? topbar.offsetHeight
                : 0;
            navbar.style.top = topbarH + 'px';
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', function () {
            updateLayout();
            onScroll();
            if (window.innerWidth >= 992) closeDrawer();
        });

        // Run on load
        updateLayout();
        onScroll();

        /* ── Mobile drawer open/close ── */
        function openDrawer() {
            ham.classList.add('is-open');
            drawer.classList.add('is-open');
            overlay.classList.add('is-open');
            ham.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer() {
            ham.classList.remove('is-open');
            drawer.classList.remove('is-open');
            overlay.classList.remove('is-open');
            ham.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        ham.addEventListener('click', function () {
            if (drawer.classList.contains('is-open')) { closeDrawer(); } else { openDrawer(); }
        });

        closeBtn.addEventListener('click', closeDrawer);
        overlay.addEventListener('click', closeDrawer);

        /* Escape key */
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeDrawer();
        });

        /* ── Mobile Services Submenu ── */
        var mobServBtn = document.getElementById('mobileServicesToggle');
        var mobServSub = document.getElementById('mobileServicesSubmenu');
        var mobServArrow = document.getElementById('mobileServicesArrow');

        if (mobServBtn) {
            mobServBtn.addEventListener('click', function () {
                var isOpen = mobServSub.classList.toggle('is-open');
                mobServArrow.classList.toggle('rotated', isOpen);
                mobServBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        }
    })();
</script>