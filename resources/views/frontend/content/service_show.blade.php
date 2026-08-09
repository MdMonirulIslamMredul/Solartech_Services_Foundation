@extends('frontend.layouts.app')
@section('content')

@section('title', $service->title ?? __('Service'))

    <title>{{ app_name() }} | @yield('title')</title>

    @php
        abort_if(optional($service)->is_active != 1, 404);
        $images = [
            $service->image1 ?? null,
            $service->image2 ?? null,
            $service->image3 ?? null,
        ];
        $allServices = \Illuminate\Support\Facades\DB::table('services')->where('is_active', 1)->orderBy('id', 'asc')->get();

        if (!function_exists('parseYoutubeEmbedUrl')) {
            function parseYoutubeEmbedUrl($url) {
                if (!$url) return null;
                preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
                return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : null;
            }
        }
        $video1Embed = parseYoutubeEmbedUrl($service->video_1 ?? null);
        $video2Embed = parseYoutubeEmbedUrl($service->video_2 ?? null);
    @endphp

    <style>
        /* ═══════════════════════════════════════════════════════
           PREMIUM MODERN SERVICE DETAILS PAGE
           Theme Colors: Navy #1B3A6B | Azure #29A9E0 | Accent Amber #FF8C00
           ═══════════════════════════════════════════════════════ */

        /* ── Hero Banner ── */
        .svc-hero-banner {
            position: relative;
            padding: 140px 0 90px;
            background: linear-gradient(135deg, #0B192C 0%, #1B3A6B 60%, #144B75 100%);
            color: #ffffff;
            overflow: hidden;
        }

        .svc-hero-banner.has-bg {
            background-size: cover;
            background-position: center;
        }

        .svc-hero-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 30%, rgba(41, 169, 224, 0.25) 0%, transparent 60%),
                        radial-gradient(circle at 80% 70%, rgba(255, 140, 0, 0.15) 0%, transparent 50%),
                        linear-gradient(180deg, rgba(11, 25, 44, 0.85) 0%, rgba(11, 25, 44, 0.95) 100%);
            z-index: 1;
        }

        .svc-hero-banner .svc-hero-container {
            position: relative;
            z-index: 2;
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 25px;
        }

        .svc-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 18px;
            background: rgba(41, 169, 224, 0.15);
            border: 1px solid rgba(41, 169, 224, 0.4);
            color: #29A9E0;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
        }

        .svc-hero-title {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.15;
            margin: 0 0 20px;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .svc-hero-lead {
            font-size: 19px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.88);
            max-width: 820px;
            margin-bottom: 28px;
        }

        .svc-breadcrumbs {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 500;
            flex-wrap: wrap;
        }

        .svc-breadcrumbs a {
            color: #29A9E0;
            text-decoration: none;
            transition: color 0.25s ease;
        }

        .svc-breadcrumbs a:hover {
            color: #FF8C00;
        }

        .svc-breadcrumbs .sep {
            color: rgba(255, 255, 255, 0.4);
            font-size: 12px;
        }

        .svc-breadcrumbs .active {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 600;
        }

        /* ── Main Layout Container ── */
        .svc-details-wrapper {
            background-color: #F8FAFC;
            padding: 70px 0 90px;
        }

        .svc-details-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 25px;
        }

        .svc-details-layout {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 40px;
            align-items: start;
        }

        /* ── Main Content Column ── */
        .svc-main-content {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .svc-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 36px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 10px 30px -10px rgba(27, 58, 107, 0.06);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .svc-card:hover {
            box-shadow: 0 18px 40px -12px rgba(27, 58, 107, 0.12);
        }

        .svc-section-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid #F1F5F9;
            position: relative;
        }

        .svc-section-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 70px;
            height: 3px;
            background: linear-gradient(90deg, #1B3A6B, #29A9E0);
            border-radius: 3px;
        }

        .svc-section-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(27, 58, 107, 0.1), rgba(41, 169, 224, 0.15));
            color: #1B3A6B;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .svc-section-title {
            font-size: 28px;
            font-weight: 700;
            color: #0F172A;
            margin: 0;
            letter-spacing: -0.3px;
        }

        .svc-media-frame {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 24px;
            box-shadow: 0 12px 30px -10px rgba(0, 0, 0, 0.2);
        }

        .svc-media-frame img {
            width: 100%;
            max-height: 440px;
            object-fit: cover;
            display: block;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .svc-card:hover .svc-media-frame img {
            transform: scale(1.03);
        }

        .svc-text-content {
            font-size: 17px;
            line-height: 1.8;
            color: #334155;
        }

        .svc-text-content p {
            margin-bottom: 18px;
        }

        .svc-text-content p:last-child {
            margin-bottom: 0;
        }

        .svc-text-content ul, .svc-text-content ol {
            padding-left: 24px;
            margin-bottom: 20px;
        }

        .svc-text-content li {
            margin-bottom: 10px;
        }

        /* ── Videos Showcase Section ── */
        .svc-videos-card {
            background: linear-gradient(135deg, #0B192C 0%, #162C4E 100%);
            border-radius: 24px;
            padding: 36px;
            color: #ffffff;
            box-shadow: 0 18px 45px -12px rgba(11, 25, 44, 0.4);
            border: 1px solid rgba(41, 169, 224, 0.2);
        }

        .svc-videos-card .svc-section-title {
            color: #ffffff;
        }

        .svc-videos-card .svc-section-header::after {
            background: linear-gradient(90deg, #29A9E0, #FF8C00);
        }

        .svc-videos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 24px;
        }

        .svc-video-item {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 18px;
            background: #000000;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .svc-video-item iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* ── Sidebar Column ── */
        .svc-sidebar {
            position: sticky;
            top: 110px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .svc-widget {
            background: #ffffff;
            border-radius: 22px;
            padding: 28px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 10px 30px -10px rgba(27, 58, 107, 0.05);
        }

        .svc-widget-title {
            font-size: 20px;
            font-weight: 700;
            color: #0F172A;
            margin: 0 0 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #F1F5F9;
            position: relative;
        }

        .svc-widget-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 45px;
            height: 3px;
            background: #29A9E0;
            border-radius: 3px;
        }

        /* Services List Menu */
        .svc-menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .svc-menu-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 18px;
            background: #F8FAFC;
            color: #334155;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.25s ease;
            border: 1px solid transparent;
        }

        .svc-menu-link:hover {
            background: #E0F2FE;
            color: #0284C7;
            transform: translateX(4px);
        }

        .svc-menu-link.active {
            background: linear-gradient(135deg, #1B3A6B 0%, #29A9E0 100%);
            color: #ffffff;
            box-shadow: 0 8px 20px -6px rgba(27, 58, 107, 0.4);
        }

        .svc-menu-link .arrow {
            font-size: 16px;
            transition: transform 0.25s ease;
        }

        .svc-menu-link:hover .arrow {
            transform: translateX(4px);
        }

        /* Quick Contact Card */
        .svc-contact-widget {
            background: linear-gradient(135deg, #0B192C 0%, #1B3A6B 100%);
            color: #ffffff;
            border-radius: 22px;
            padding: 32px 26px;
            box-shadow: 0 16px 36px -10px rgba(11, 25, 44, 0.4);
            position: relative;
            overflow: hidden;
        }

        .svc-contact-widget::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(41, 169, 224, 0.15);
            pointer-events: none;
        }

        .svc-contact-widget .svc-widget-title {
            color: #ffffff;
            border-bottom-color: rgba(255, 255, 255, 0.15);
        }

        .svc-contact-widget .svc-widget-title::after {
            background: #FF8C00;
        }

        .svc-contact-desc {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.5;
            margin-bottom: 22px;
        }

        .svc-contact-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #FF8C00 0%, #FF6B00 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(255, 140, 0, 0.4);
            transition: all 0.3s ease;
        }

        .svc-contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(255, 140, 0, 0.5);
            color: #ffffff;
        }

        .svc-secondary-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 13px;
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            border-radius: 12px;
            margin-top: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .svc-secondary-btn:hover {
            background: rgba(255, 255, 255, 0.22);
            color: #ffffff;
        }

        /* ── Bottom CTA Panel ── */
        .svc-cta-section {
            background: linear-gradient(135deg, #0B192C 0%, #1B3A6B 50%, #144B75 100%);
            padding: 70px 0;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .svc-cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 80% 20%, rgba(41, 169, 224, 0.2) 0%, transparent 60%);
            pointer-events: none;
        }

        .svc-cta-container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            position: relative;
            z-index: 2;
        }

        .svc-cta-content h2 {
            font-size: 38px;
            font-weight: 800;
            margin: 0 0 14px;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .svc-cta-content p {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.85);
            margin: 0;
            max-width: 720px;
            line-height: 1.6;
        }

        .svc-cta-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-shrink: 0;
        }

        .svc-btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 36px;
            background: linear-gradient(135deg, #FF8C00 0%, #FF6B00 100%);
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(255, 140, 0, 0.4);
            transition: all 0.3s ease;
        }

        .svc-btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(255, 140, 0, 0.5);
            color: #ffffff;
        }

        .svc-btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 15px 32px;
            background: transparent;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            border: 2px solid rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
        }

        .svc-btn-outline:hover {
            border-color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            transform: translateY(-4px);
        }

        /* ── Responsive Design ── */
        @media (max-width: 991px) {
            .svc-hero-banner {
                padding: 110px 0 70px;
            }

            .svc-hero-title {
                font-size: 38px;
            }

            .svc-hero-lead {
                font-size: 17px;
            }

            .svc-details-layout {
                grid-template-columns: 1fr;
                gap: 50px;
            }

            .svc-sidebar {
                position: static;
            }

            .svc-cta-container {
                flex-direction: column;
                text-align: center;
            }

            .svc-cta-actions {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        @media (max-width: 575px) {
            .svc-hero-banner {
                padding: 90px 0 50px;
            }

            .svc-hero-title {
                font-size: 30px;
            }

            .svc-card {
                padding: 24px;
                border-radius: 18px;
            }

            .svc-section-title {
                font-size: 22px;
            }

            .svc-cta-content h2 {
                font-size: 28px;
            }

            .svc-btn-primary, .svc-btn-outline {
                width: 100%;
            }
        }
    </style>

    <!-- ── Hero Banner Section ── -->
    <div class="svc-hero-banner {{ $service->image1 ? 'has-bg' : '' }}" @if($service->image1) style="background-image:url('{{ asset('/setting/service/' . $service->image1) }}')" @endif>
        <div class="svc-hero-container" data-aos="fade-up" data-aos-duration="800">
            <div class="svc-hero-badge">
                <i class="ri-shield-check-line"></i> Premium Service Solutions
            </div>
            <h1 class="svc-hero-title">{{ $service->title }}</h1>
            @if($service->details1)
                <div class="svc-hero-lead">{!! Str::limit(strip_tags($service->details1), 220) !!}</div>
            @endif
            <div class="svc-breadcrumbs">
                <a href="/">Home</a>
                <span class="sep"><i class="ri-arrow-right-s-line"></i></span>
                <a href="/service">Our Services</a>
                <span class="sep"><i class="ri-arrow-right-s-line"></i></span>
                <span class="active">{{ $service->title }}</span>
            </div>
        </div>
    </div>

    <!-- ── Main Content Area ── -->
    <div class="svc-details-wrapper">
        <div class="svc-details-container">
            <div class="svc-details-layout">

                <!-- Main Content Column -->
                <div class="svc-main-content">

                    <!-- Section 1: Overview -->
                    @if($service->details1 || $images[0])
                        <div class="svc-card" data-aos="fade-up" data-aos-duration="800">
                            <div class="svc-section-header">
                                <div class="svc-section-icon"><i class="ri-information-line"></i></div>
                                <h2 class="svc-section-title">Overview</h2>
                            </div>
                            @if($images[0])
                                <div class="svc-media-frame">
                                    <img src="{{ asset('/setting/service/' . $images[0]) }}" alt="{{ $service->title }} primary image">
                                </div>
                            @endif
                            @if($service->details1)
                                <div class="svc-text-content">{!! $service->details1 !!}</div>
                            @endif
                        </div>
                    @endif

                    <!-- Section 2: Detailed Specifications -->
                    @if($service->details2 || $images[1])
                        <div class="svc-card" data-aos="fade-up" data-aos-duration="800">
                            <div class="svc-section-header">
                                <div class="svc-section-icon"><i class="ri-list-check-2"></i></div>
                                <h2 class="svc-section-title">Specifications & Features</h2>
                            </div>
                            @if($images[1])
                                <div class="svc-media-frame">
                                    <img src="{{ asset('/setting/service/' . $images[1]) }}" alt="{{ $service->title }} secondary image">
                                </div>
                            @endif
                            @if($service->details2)
                                <div class="svc-text-content">{!! $service->details2 !!}</div>
                            @endif
                        </div>
                    @endif

                    <!-- Section 3: Additional Information -->
                    @if($service->details3 || $images[2])
                        <div class="svc-card" data-aos="fade-up" data-aos-duration="800">
                            <div class="svc-section-header">
                                <div class="svc-section-icon"><i class="ri-article-line"></i></div>
                                <h2 class="svc-section-title">Additional Information</h2>
                            </div>
                            @if($images[2])
                                <div class="svc-media-frame">
                                    <img src="{{ asset('/setting/service/' . $images[2]) }}" alt="{{ $service->title }} tertiary image">
                                </div>
                            @endif
                            @if($service->details3)
                                <div class="svc-text-content">{!! $service->details3 !!}</div>
                            @endif
                        </div>
                    @endif

                    <!-- Featured Videos Showcase -->
                    @if($video1Embed || $video2Embed)
                        <div class="svc-videos-card" data-aos="fade-up" data-aos-duration="800">
                            <div class="svc-section-header">
                                <div class="svc-section-icon" style="background: rgba(255, 140, 0, 0.2); color: #FF8C00;">
                                    <i class="ri-video-line"></i>
                                </div>
                                <h2 class="svc-section-title">Featured Service Videos</h2>
                            </div>
                            <div class="svc-videos-grid">
                                @if($video1Embed)
                                    <div class="svc-video-item">
                                        <iframe src="{{ $video1Embed }}" title="YouTube video player 1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                @endif
                                @if($video2Embed)
                                    <div class="svc-video-item">
                                        <iframe src="{{ $video2Embed }}" title="YouTube video player 2" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Sticky Sidebar Column -->
                <div class="svc-sidebar">

                    <!-- Services List Widget -->
                    <div class="svc-widget" data-aos="fade-left" data-aos-duration="800">
                        <h3 class="svc-widget-title">Our Services</h3>
                        <ul class="svc-menu-list">
                            @foreach($allServices as $svcItem)
                                <li>
                                    <a href="/service/{{ $svcItem->id }}" class="svc-menu-link {{ $svcItem->id == $service->id ? 'active' : '' }}">
                                        <span>{{ $svcItem->title }}</span>
                                        <span class="arrow"><i class="ri-arrow-right-line"></i></span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Quick Appointment & Contact Widget -->
                    <div class="svc-contact-widget" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">
                        <h3 class="svc-widget-title">Need Help or Advice?</h3>
                        <p class="svc-contact-desc">Get in touch with our certified engineers to discuss your tailored solution today.</p>
                        <a href="{{ route('appointment.index') }}" class="svc-contact-btn">
                            <i class="ri-calendar-check-line"></i> Book Appointment
                        </a>
                        <a href="/contact" class="svc-secondary-btn">
                            <i class="ri-customer-service-2-line"></i> Contact Support
                        </a>
                    </div>

                    <!-- Quality Guarantee Widget -->
                    <div class="svc-widget" data-aos="fade-left" data-aos-duration="800" data-aos-delay="150" style="text-align: center;">
                        <div style="width: 54px; height: 54px; background: rgba(41, 169, 224, 0.12); color: #29A9E0; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 12px;">
                            <i class="ri-award-line"></i>
                        </div>
                        <h4 style="font-size: 18px; font-weight: 700; color: #0F172A; margin: 0 0 6px;">Guaranteed Quality</h4>
                        <p style="font-size: 14px; color: #64748B; margin: 0; line-height: 1.5;">Top-tier expertise, sustainable solutions, & 24/7 dedicated support.</p>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- ── Bottom CTA Panel Section ── -->
    <div class="svc-cta-section" data-aos="fade-up" data-aos-duration="900">
        <div class="svc-cta-container">
            <div class="svc-cta-content">
                <h2>Ready to elevate your project with {{ $service->title }}?</h2>
                <p>Contact our experts to discover customized options and schedule your consultation today.</p>
            </div>
            <div class="svc-cta-actions">
                <a href="{{ route('appointment.index') }}" class="svc-btn-primary">
                    <i class="ri-calendar-event-line"></i> Book Appointment
                </a>
                <a href="/contact" class="svc-btn-outline">
                    <i class="ri-mail-send-line"></i> Contact Us
                </a>
            </div>
        </div>
    </div>

@endsection