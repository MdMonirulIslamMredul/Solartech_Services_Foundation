@extends('frontend.layouts.app')

@section('title', __('Contact Us'))

@section('content')
@php
    $bannerImg = optional($about ?? null)->banner_img ?? '';
@endphp

<div class="main-content">
    <!-- ── Hero Banner ── -->
    <div class="cnt-hero-banner">
        <div class="cnt-hero-bg" @if($bannerImg) style="background-image: url('{{ asset('/setting/about/' . $bannerImg) }}');" @endif></div>
        <div class="cnt-hero-overlay"></div>
        <div class="container position-relative" style="z-index: 5;">
            <div class="cnt-hero-content">
                <span class="cnt-hero-eyebrow">
                    <i class="ri-customer-service-2-line"></i> 24/7 Support Line
                </span>
                <h1>Get In Touch With Us</h1>
                <p>Have questions about our cleaning services or pricing? Send us a message and our team will get back to you immediately.</p>
                <div class="cnt-hero-crumbs">
                    <a href="/"><i class="ri-home-4-line"></i> Home</a>
                    <span>/</span>
                    <span class="active">Contact Us</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Contact Section ── -->
    <div class="cnt-main-section">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                
                <!-- ── Left Column: Contact Form ── -->
                <div class="col-lg-7 col-md-12">
                    <div class="cnt-form-card">
                        <div class="cnt-form-header">
                            <span class="cnt-badge">Send Message</span>
                            <h2>Send Us A Direct Message</h2>
                            <p>Fill out the details below and we will answer your message promptly.</p>
                        </div>

                        <!-- Success Alert Messages -->
                        @if(session('flash_success') || session('success') || session('status'))
                            <div class="cnt-success-alert">
                                <i class="ri-checkbox-circle-fill"></i>
                                <div>
                                    <strong>Message Sent Successfully!</strong>
                                    <p>{{ session('flash_success') ?? session('success') ?? session('status') }}</p>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('frontend.contact.submit') }}" method="POST" class="cnt-form">
                            @csrf
                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6 col-12">
                                    <div class="cnt-input-group">
                                        <label for="name">Your Name <span class="req">*</span></label>
                                        <div class="cnt-input-wrap">
                                            <i class="ri-user-3-line"></i>
                                            <input type="text" id="name" name="name" placeholder="Enter full name" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 col-12">
                                    <div class="cnt-input-group">
                                        <label for="phone">Phone / Mobile <span class="req">*</span></label>
                                        <div class="cnt-input-wrap">
                                            <i class="ri-phone-line"></i>
                                            <input type="tel" id="phone" name="phone" placeholder="e.g. 017XXXXXXXX" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-12">
                                    <div class="cnt-input-group">
                                        <label for="email">Email Address <span class="req">*</span></label>
                                        <div class="cnt-input-wrap">
                                            <i class="ri-mail-line"></i>
                                            <input type="email" id="email" name="email" placeholder="e.g. info@example.com" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <div class="cnt-input-group">
                                        <label for="message">Your Message / Inquiry <span class="req">*</span></label>
                                        <div class="cnt-input-wrap textarea-wrap">
                                            <i class="ri-chat-3-line"></i>
                                            <textarea id="message" name="message" rows="4" placeholder="Write your message or cleaning service query here..." required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button type="submit" class="cnt-submit-btn">
                                        <i class="ri-send-plane-fill"></i> Send Message Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ── Right Column: Contact Details Cards ── -->
                <div class="col-lg-5 col-md-12">
                    <div class="cnt-info-card">
                        <div class="cnt-info-header">
                            <span class="cnt-badge">Contact Details</span>
                            <h2>Reach Our Support Team</h2>
                            <p>We are available 24/7 across Bangladesh to handle all cleaning requests and queries.</p>
                        </div>

                        <div class="cnt-info-list">
                            <!-- Phone Card -->
                            <div class="cnt-info-item">
                                <div class="cnt-info-icon">
                                    <i class="ri-phone-fill"></i>
                                </div>
                                <div class="cnt-info-text">
                                    <h4>Phone / Call Center</h4>
                                    <p><a href="tel:{{ get_setting('office_phone', '01768044211') }}">{{ get_setting('office_phone', '01768044211') }}</a></p>
                                    <p><a href="tel:01624314807">01624314807</a></p>
                                </div>
                            </div>

                            <!-- Email Card -->
                            <div class="cnt-info-item">
                                <div class="cnt-info-icon">
                                    <i class="ri-mail-open-fill"></i>
                                </div>
                                <div class="cnt-info-text">
                                    <h4>Email Address</h4>
                                    <p><a href="mailto:{{ get_setting('office_email', 'info@smartbanglacleaning.com') }}">{{ get_setting('office_email', 'info@smartbanglacleaning.com') }}</a></p>
                                </div>
                            </div>

                            <!-- Location Card -->
                            <div class="cnt-info-item">
                                <div class="cnt-info-icon">
                                    <i class="ri-map-pin-2-fill"></i>
                                </div>
                                <div class="cnt-info-text">
                                    <h4>Head Office Address</h4>
                                    <p>{{ get_setting('office_address', 'Dhaka, Bangladesh') }}</p>
                                </div>
                            </div>

                            <!-- Working Hours Card -->
                            <div class="cnt-info-item">
                                <div class="cnt-info-icon">
                                    <i class="ri-time-fill"></i>
                                </div>
                                <div class="cnt-info-text">
                                    <h4>Service Hours</h4>
                                    <p>24/7 Available (7 Days a Week)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Links -->
                        <div class="cnt-social-box">
                            <h3>Connect With Us</h3>
                            <div class="cnt-social-links">
                                <a href="{{ get_setting('facebook', '#') }}" target="_blank" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', get_setting('office_phone', '01768044211')) }}" target="_blank" aria-label="WhatsApp"><i class="ri-whatsapp-line"></i></a>
                                <a href="{{ get_setting('instagram', '#') }}" target="_blank" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                                <a href="{{ get_setting('linkedin', '#') }}" target="_blank" aria-label="LinkedIn"><i class="ri-linkedin-fill"></i></a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ── Custom Styles ── -->
<style>
    .cnt-hero-banner {
        position: relative;
        padding: 120px 0 80px;
        background: #111D5E;
        color: #fff;
        overflow: hidden;
    }

    .cnt-hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .cnt-hero-overlay {
        position: absolute;
        inset: 0;
        z-index: 1;
        background: linear-gradient(90deg, rgba(17, 29, 94, 0.92) 0%, rgba(17, 29, 94, 0.75) 50%, rgba(17, 29, 94, 0.4) 100%);
    }

    .cnt-hero-content {
        max-width: 720px;
    }

    .cnt-hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(41, 169, 224, 0.15);
        border: 1px solid rgba(41, 169, 224, 0.4);
        color: #7dd8f8;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        padding: 6px 16px;
        border-radius: 50px;
        margin-bottom: 14px;
    }

    .cnt-hero-content h1 {
        font-size: clamp(30px, 4vw, 48px);
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 10px;
        line-height: 1.2;
    }

    .cnt-hero-content p {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 18px;
    }

    .cnt-hero-crumbs {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.7);
    }

    .cnt-hero-crumbs a {
        color: #29A9E0;
        text-decoration: none;
        transition: color 0.2s;
    }

    .cnt-hero-crumbs a:hover {
        color: #fff;
    }

    .cnt-hero-crumbs .active {
        color: #fff;
        font-weight: 600;
    }

    /* Main Section */
    .cnt-main-section {
        padding: 70px 0 90px;
        background: #f8fafc;
    }

    /* Form Card */
    .cnt-form-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px 36px;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
    }

    .cnt-form-header {
        margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e2e8f0;
    }

    .cnt-badge {
        display: inline-block;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #29A9E0;
        background: rgba(41, 169, 224, 0.1);
        padding: 4px 12px;
        border-radius: 50px;
        margin-bottom: 8px;
    }

    .cnt-form-header h2 {
        font-size: 26px;
        font-weight: 800;
        color: #111D5E;
        margin-bottom: 6px;
    }

    .cnt-form-header p {
        font-size: 14px;
        color: #64748b;
        margin: 0;
    }

    .cnt-success-alert {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 24px;
    }

    .cnt-success-alert i {
        font-size: 22px;
        color: #10b981;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .cnt-success-alert strong {
        display: block;
        font-size: 14.5px;
        margin-bottom: 2px;
    }

    .cnt-success-alert p {
        font-size: 13.5px;
        margin: 0;
    }

    .cnt-input-group label {
        display: block;
        font-size: 13.5px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 6px;
    }

    .cnt-input-group label .req {
        color: #ef4444;
    }

    .cnt-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .cnt-input-wrap i {
        position: absolute;
        left: 14px;
        color: #94a3b8;
        font-size: 17px;
        pointer-events: none;
        transition: color 0.2s;
    }

    .cnt-input-wrap input,
    .cnt-input-wrap textarea {
        width: 100%;
        padding: 12px 14px 12px 42px;
        background: #f8fafc;
        border: 1.5px solid #cbd5e1;
        border-radius: 10px;
        font-size: 14px;
        color: #1e293b;
        transition: all 0.25s ease;
        outline: none;
    }

    .cnt-input-wrap.textarea-wrap i {
        top: 14px;
    }

    .cnt-input-wrap.textarea-wrap textarea {
        padding-top: 12px;
        resize: vertical;
    }

    .cnt-input-wrap input:focus,
    .cnt-input-wrap textarea:focus {
        background: #ffffff;
        border-color: #29A9E0;
        box-shadow: 0 0 0 4px rgba(41, 169, 224, 0.15);
    }

    .cnt-input-wrap input:focus + i,
    .cnt-input-wrap textarea:focus + i {
        color: #29A9E0;
    }

    .cnt-submit-btn {
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: linear-gradient(135deg, #29A9E0 0%, #111D5E 100%);
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        padding: 15px 28px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(41, 169, 224, 0.35);
    }

    .cnt-submit-btn:hover {
        background: linear-gradient(135deg, #1b8fc0 0%, #0d1647 100%);
        box-shadow: 0 12px 30px rgba(41, 169, 224, 0.5);
        transform: translateY(-2px);
    }

    /* Right Column Info Card */
    .cnt-info-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 36px 30px;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.06);
        border: 1px solid #e2e8f0;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .cnt-info-header {
        margin-bottom: 24px;
    }

    .cnt-info-header h2 {
        font-size: 24px;
        font-weight: 800;
        color: #111D5E;
        margin-bottom: 8px;
    }

    .cnt-info-header p {
        font-size: 14px;
        color: #64748b;
        margin: 0;
    }

    .cnt-info-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 28px;
    }

    .cnt-info-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .cnt-info-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(41, 169, 224, 0.15), rgba(17, 29, 94, 0.08));
        color: #29A9E0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .cnt-info-text h4 {
        font-size: 15px;
        font-weight: 700;
        color: #111D5E;
        margin: 0 0 4px;
    }

    .cnt-info-text p {
        font-size: 13.5px;
        color: #64748b;
        margin: 0;
        line-height: 1.45;
    }

    .cnt-info-text a {
        color: #29A9E0;
        text-decoration: none;
        transition: color 0.2s;
    }

    .cnt-info-text a:hover {
        color: #111D5E;
        text-decoration: underline;
    }

    .cnt-social-box h3 {
        font-size: 15px;
        font-weight: 700;
        color: #111D5E;
        margin-bottom: 12px;
    }

    .cnt-social-links {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .cnt-social-links a {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #f1f5f9;
        color: #111D5E;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .cnt-social-links a:hover {
        background: #29A9E0;
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(41, 169, 224, 0.35);
    }

    @media (max-width: 991px) {
        .cnt-hero-banner {
            padding: 90px 0 60px;
        }

        .cnt-form-card,
        .cnt-info-card {
            padding: 28px 22px;
        }
    }

    @media (max-width: 575px) {
        .cnt-main-section {
            padding: 40px 0 60px;
        }

        .cnt-form-header h2,
        .cnt-info-header h2 {
            font-size: 22px;
        }
    }
</style>
@endsection
