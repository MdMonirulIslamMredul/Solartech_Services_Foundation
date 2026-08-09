@extends('frontend.layouts.app')
@section('content')
@section('title', $project->title ?? __('Study Destination'))

<title>{{ app_name() }} | @yield('title')</title>

<style>
    /* Hero Banner with Ken Burns Zoom */
    .sd-banner-area {
        position: relative;
        height: 480px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .sd-banner-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        animation: sdKenBurns 10s ease-in-out infinite alternate;
    }
    .sd-banner-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0.65) 0%, rgba(15, 23, 42, 0.75) 100%);
    }
    .sd-banner-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: #ffffff;
        padding: 0 20px;
    }
    .sd-banner-content h1 {
        font-size: 52px;
        font-weight: 900;
        letter-spacing: 1px;
        margin-bottom: 14px;
        color: #ffffff;
        text-shadow: 0 3px 12px rgba(0, 0, 0, 0.8), 0 1px 3px rgba(0, 0, 0, 0.9);
    }
    .sd-banner-content p {
        font-size: 20px !important;
        font-weight: 700 !important;
        color: #ffffff !important;
        opacity: 1 !important;
        max-width: 750px;
        margin: 0 auto;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.9), 0 1px 4px #000000 !important;
        letter-spacing: 0.3px;
    }

    @keyframes sdKenBurns {
        0% { transform: scale(1); }
        100% { transform: scale(1.12); }
    }

    /* Content Cards and Layout */
    .sd-section {
        padding: 90px 0;
        background: #f8fafc;
    }
    .sd-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
        padding: 40px;
        margin-bottom: 40px;
        border: 1px solid #eef2f6;
        transition: all 0.35s ease;
    }
    .sd-card:hover {
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        border-color: #ff8c00;
    }
    .sd-card-title {
        font-size: 32px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 12px;
    }
    .sd-card-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #ff8c00, #25934f);
        border-radius: 4px;
    }
    .sd-img-wrapper {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        height: 100%;
        min-height: 320px;
    }
    .sd-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .sd-img-wrapper:hover img {
        transform: scale(1.04);
    }
    .sd-text-body {
        font-size: 16px;
        line-height: 1.8;
        color: #475569;
    }

    /* Partners Carousel Styling */
    /* Infinite Partner Marquee Carousel */
    .partner-marquee-wrapper {
        overflow: hidden;
        position: relative;
        width: 100%;
        padding: 10px 0;
    }
    .partner-marquee-track {
        display: flex;
        gap: 24px;
        width: max-content;
        animation: partnerMarquee 25s linear infinite;
    }
    .partner-marquee-wrapper:hover .partner-marquee-track {
        animation-play-state: paused;
    }
    .partner-marquee-item {
        flex: 0 0 240px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px 15px;
        border-radius: 14px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.35s ease;
    }
    .partner-marquee-item:hover {
        border-color: #ff8c00;
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(255, 140, 0, 0.15);
    }
    @keyframes partnerMarquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
</style>

<div class="main-content">
    <!-- Hero Banner -->
    <div class="sd-banner-area">
        @if (!empty($project->banner))
            <div class="sd-banner-bg" style="background-image: url('{{ asset('/setting/banner/' . $project->banner) }}');"></div>
        @else
            <div class="sd-banner-bg" style="background-image: url('{{ asset('/setting/banner/' . $project->image) }}');"></div>
        @endif
        <div class="sd-banner-overlay"></div>
        <div class="sd-banner-content">
            <h1 style="color: #ffffff !important; text-shadow: 0 3px 12px rgba(0,0,0,0.9), 0 1px 4px #000000 !important;">{{ $project->title }}</h1>
            <p style="color: #ffffff !important; font-weight: 700 !important; font-size: 20px !important; opacity: 1 !important; text-shadow: 0 2px 10px rgba(0,0,0,0.9), 0 1px 4px #000000 !important;">Explore top universities, programs, and opportunities in {{ $project->title }}</p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="sd-section">
        <div class="container">
            <!-- First Row: Title + Details & Main Image -->
            <div class="sd-card">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        @if(!empty($project->details_title))
                            <h2 class="sd-card-title">{{ $project->details_title }}</h2>
                        @endif
                        <div class="sd-text-body">
                            {!! $project->details !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @if (!empty($project->image))
                            <div class="sd-img-wrapper">
                                <img src="{{ asset('/setting/banner/' . $project->image) }}" alt="{{ $project->title }}">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Second Row: Additional Details & Secondary Image -->
            @if (!empty($project->details_description) || !empty($project->image3))
                <div class="sd-card">
                    <div class="row align-items-center">
                        @if (!empty($project->image3))
                            <div class="col-lg-6 mb-4 mb-lg-0 order-lg-1 order-2">
                                <div class="sd-img-wrapper">
                                    <img src="{{ asset('/setting/banner/' . $project->image3) }}" alt="{{ $project->title }}">
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-{{ !empty($project->image3) ? '6' : '12' }} order-lg-2 order-1">
                            <div class="sd-text-body">
                                {!! $project->details_description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Partners Section -->
    <div class="sd-partners-section" style="padding: 80px 0;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 style="font-size: 38px; font-weight: 800; color: var(--nt-secondary, #1e293b); position: relative; display: inline-block;">
                    Our Partners
                    <span style="display: block; width: 80px; height: 5px; background: var(--nt-accent, #ff8c00); margin: 10px auto 0; border-radius: 3px;"></span>
                </h2>
            </div>

            @php
                $brandItems = isset($brands) ? $brands : \App\Models\Brand::where('is_active', 1)->orderBy('id', 'DESC')->get();
            @endphp
            <div class="partner-marquee-wrapper">
                <div class="partner-marquee-track">
                    {{-- Loop twice to ensure seamless infinite looping --}}
                    @for ($i = 0; $i < 2; $i++)
                        @foreach ($brandItems as $brand)
                            <div class="partner-marquee-item">
                                @if ($brand->logo)
                                    <img src="{{ asset('/setting/brand/' . $brand->logo) }}"
                                         alt="{{ $brand->name ?? $brand->title }}"
                                         style="max-height: 70px; max-width: 100%; object-fit: contain; margin-bottom: 10px;">
                                @else
                                    <p style="font-size: 12px; color: #94a3b8; margin-bottom: 10px;"><em>No logo</em></p>
                                @endif
                                <h6 style="font-size: 14px; font-weight: 600; color: #1e293b; margin: 0; text-align: center;">
                                    {{ $brand->title ?? $brand->name }}
                                </h6>
                            </div>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

@endsection