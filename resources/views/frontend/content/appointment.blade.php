@extends('frontend.layouts.app')

@section('title', __('Book Appointment'))

@section('content')
@php
    $services = $services ?? DB::table('services')->where('is_active', 1)->orderBy('id', 'asc')->get();
    $bannerImg = optional($about)->banner_img ?? '';
@endphp

<div class="main-content">
    <!-- ── Hero Banner Section ── -->
    <div class="apt-hero-banner">
        <div class="apt-hero-bg" @if($bannerImg) style="background-image: url('{{ asset('/setting/about/' . $bannerImg) }}');" @endif></div>
        <div class="apt-hero-overlay"></div>
        <div class="container position-relative" style="z-index: 5;">
            <div class="apt-hero-content">
                <span class="apt-hero-eyebrow">
                    <i class="ri-sparkles-line"></i> Quick & Easy Online Booking
                </span>
                <h1>Book Your Cleaning Service</h1>
                <p>Professional, reliable, and trusted cleaning solutions across Bangladesh.</p>
                <div class="apt-hero-crumbs">
                    <a href="/"><i class="ri-home-4-line"></i> Home</a>
                    <span>/</span>
                    <span class="active">Book Appointment</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Main Appointment Section ── -->
    <div class="apt-main-section">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                
                <!-- ── Left Column: Trust Features & Info ── -->
                <div class="col-lg-5 col-md-12">
                    <div class="apt-info-card">
                        <div class="apt-info-header">
                            <span class="apt-badge">Why Choose Us</span>
                            <h2>Trusted Cleaning Experts at Your Doorstep</h2>
                            <p>We deliver top-tier hygiene, sanitation, and deep cleaning for homes, offices, and water tanks.</p>
                        </div>

                        <div class="apt-feature-list">
                            <div class="apt-feature-item">
                                <div class="apt-feature-icon">
                                    <i class="ri-shield-check-fill"></i>
                                </div>
                                <div class="apt-feature-text">
                                    <h4>Certified Technicians</h4>
                                    <p>Verified, background-checked professionals equipped with safety gear.</p>
                                </div>
                            </div>

                            <div class="apt-feature-item">
                                <div class="apt-feature-icon">
                                    <i class="ri-calendar-event-fill"></i>
                                </div>
                                <div class="apt-feature-text">
                                    <h4>Flexible Scheduling</h4>
                                    <p>Choose any date and time slot that fits your busy routine.</p>
                                </div>
                            </div>

                            <div class="apt-feature-item">
                                <div class="apt-feature-icon">
                                    <i class="ri-drop-fill"></i>
                                </div>
                                <div class="apt-feature-text">
                                    <h4>Eco-Friendly Detergents</h4>
                                    <p>High-pressure jet pumps, non-toxic chemicals, and UV disinfection.</p>
                                </div>
                            </div>

                            <div class="apt-feature-item">
                                <div class="apt-feature-icon">
                                    <i class="ri-customer-service-2-fill"></i>
                                </div>
                                <div class="apt-feature-text">
                                    <h4>Instant Confirmation</h4>
                                    <p>Get fast confirmation from our team right after submitting your request.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Hotline Call-out Card -->
                        <div class="apt-hotline-card">
                            <div class="apt-hotline-icon">
                                <i class="ri-phone-fill"></i>
                            </div>
                            <div class="apt-hotline-details">
                                <span>Need Urgent Cleaning Today?</span>
                                <h3><a href="tel:01768044211">01768044211</a> / <a href="tel:01624314807">01624314807</a></h3>
                            </div>
                        </div>

                        <!-- Rating Badge -->
                        <div class="apt-rating-badge">
                            <div class="apt-stars">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <span>5.0 Rating based on 1,000+ happy clients in Bangladesh</span>
                        </div>
                    </div>
                </div>

                <!-- ── Right Column: Booking Form Card ── -->
                <div class="col-lg-7 col-md-12">
                    <div class="apt-form-card">
                        <div class="apt-form-header">
                            <h2>Schedule An Appointment</h2>
                            <p>Fill out the form below and our team will get in touch with you shortly.</p>
                        </div>

                        <!-- Success Alert Message -->
                        @if(session('success'))
                            <div class="apt-success-alert">
                                <i class="ri-checkbox-circle-fill"></i>
                                <div>
                                    <strong>Booking Submitted Successfully!</strong>
                                    <p>{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Appointment Form -->
                        <form action="{{ route('appointment.store') }}" method="POST" class="apt-form">
                            @csrf
                            
                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6 col-12">
                                    <div class="apt-input-group">
                                        <label for="name">Full Name <span class="req">*</span></label>
                                        <div class="apt-input-wrap">
                                            <i class="ri-user-3-line"></i>
                                            <input type="text" id="name" name="name" placeholder="e.g. Tanvir Ahmed" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 col-12">
                                    <div class="apt-input-group">
                                        <label for="phone">Phone Number <span class="req">*</span></label>
                                        <div class="apt-input-wrap">
                                            <i class="ri-phone-line"></i>
                                            <input type="tel" id="phone" name="phone" placeholder="e.g. 017XXXXXXXX" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Service Selection -->
                                <div class="col-12">
                                    <div class="apt-input-group">
                                        <label for="service_type">Select Service <span class="req">*</span></label>
                                        <div class="apt-input-wrap">
                                            <i class="ri-sparkles-line"></i>
                                            <select id="service_type" name="service_type" required>
                                                <option value="">-- Choose a Cleaning Service --</option>
                                                @if(count($services) > 0)
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->title }}">{{ $service->title }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="Water Tank Cleaning">Water Tank Cleaning</option>
                                                    <option value="Home Deep Cleaning">Home Deep Cleaning</option>
                                                    <option value="Sofa & Carpet Wash">Sofa & Carpet Wash</option>
                                                    <option value="Commercial Office Cleaning">Commercial Office Cleaning</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date & Time -->
                                <div class="col-md-6 col-12">
                                    <div class="apt-input-group">
                                        <label for="date">Preferred Date <span class="req">*</span></label>
                                        <div class="apt-input-wrap">
                                            <i class="ri-calendar-line"></i>
                                            <input type="date" id="date" name="date" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="apt-input-group">
                                        <label for="time">Preferred Time <span class="req">*</span></label>
                                        <div class="apt-input-wrap">
                                            <i class="ri-time-line"></i>
                                            <input type="time" id="time" name="time" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address / Location -->
                                <div class="col-12">
                                    <div class="apt-input-group">
                                        <label for="car_model">Cleaning Location / Address <span class="req">*</span></label>
                                        <div class="apt-input-wrap">
                                            <i class="ri-map-pin-line"></i>
                                            <input type="text" id="car_model" name="car_model" placeholder="House #, Road #, Block/Sector, Area, City" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Notes -->
                                <div class="col-12">
                                    <div class="apt-input-group">
                                        <label for="note">Special Instructions / Notes</label>
                                        <div class="apt-input-wrap textarea-wrap">
                                            <i class="ri-file-text-line"></i>
                                            <textarea id="note" name="note" rows="3" placeholder="Describe apartment size (e.g. 1500 sqft), specific cleaning requirements, or landmark directions..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 mt-4">
                                    <button type="submit" class="apt-submit-btn">
                                        <i class="ri-calendar-check-fill"></i> Confirm Appointment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ── Custom Page Styles ── -->
<style>
    /* ── Hero Banner ── */
    .apt-hero-banner {
        position: relative;
        padding: 120px 0 80px;
        background: #111D5E;
        color: #fff;
        overflow: hidden;
    }

    .apt-hero-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .apt-hero-overlay {
        position: absolute;
        inset: 0;
        z-index: 1;
        background: linear-gradient(90deg, rgba(17, 29, 94, 0.92) 0%, rgba(17, 29, 94, 0.75) 50%, rgba(17, 29, 94, 0.4) 100%);
    }

    .apt-hero-content {
        max-width: 720px;
    }

    .apt-hero-eyebrow {
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

    .apt-hero-content h1 {
        font-size: clamp(30px, 4vw, 48px);
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 10px;
        line-height: 1.2;
    }

    .apt-hero-content p {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 18px;
    }

    .apt-hero-crumbs {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13.5px;
        color: rgba(255, 255, 255, 0.7);
    }

    .apt-hero-crumbs a {
        color: #29A9E0;
        text-decoration: none;
        transition: color 0.2s;
    }

    .apt-hero-crumbs a:hover {
        color: #fff;
    }

    .apt-hero-crumbs .active {
        color: #fff;
        font-weight: 600;
    }

    /* ── Main Section ── */
    .apt-main-section {
        padding: 70px 0 90px;
        background: #f8fafc;
    }

    /* ── Left Column Info Card ── */
    .apt-info-card {
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

    .apt-info-header {
        margin-bottom: 24px;
    }

    .apt-badge {
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

    .apt-info-header h2 {
        font-size: 24px;
        font-weight: 800;
        color: #111D5E;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .apt-info-header p {
        font-size: 14px;
        color: #64748b;
        line-height: 1.55;
        margin: 0;
    }

    /* Feature List */
    .apt-feature-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
        margin-bottom: 26px;
    }

    .apt-feature-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
    }

    .apt-feature-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(41, 169, 224, 0.15), rgba(17, 29, 94, 0.08));
        color: #29A9E0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .apt-feature-text h4 {
        font-size: 15px;
        font-weight: 700;
        color: #111D5E;
        margin: 0 0 4px;
    }

    .apt-feature-text p {
        font-size: 13px;
        color: #64748b;
        margin: 0;
        line-height: 1.45;
    }

    /* Hotline Card */
    .apt-hotline-card {
        background: linear-gradient(135deg, #111D5E 0%, #1e3a8a 100%);
        border-radius: 14px;
        padding: 16px 20px;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }

    .apt-hotline-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(41, 169, 224, 0.25);
        color: #29A9E0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .apt-hotline-details span {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.75);
        display: block;
        margin-bottom: 2px;
    }

    .apt-hotline-details h3 {
        font-size: 16px;
        font-weight: 800;
        margin: 0;
    }

    .apt-hotline-details a {
        color: #fff;
        text-decoration: none;
        transition: color 0.2s;
    }

    .apt-hotline-details a:hover {
        color: #29A9E0;
    }

    /* Rating Badge */
    .apt-rating-badge {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f1f5f9;
        padding: 10px 16px;
        border-radius: 12px;
    }

    .apt-stars {
        color: #f59e0b;
        font-size: 14px;
        display: flex;
        gap: 2px;
    }

    .apt-rating-badge span {
        font-size: 12px;
        font-weight: 600;
        color: #475569;
    }

    /* ── Right Column Booking Form Card ── */
    .apt-form-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px 36px;
        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
    }

    .apt-form-header {
        margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e2e8f0;
    }

    .apt-form-header h2 {
        font-size: 26px;
        font-weight: 800;
        color: #111D5E;
        margin-bottom: 6px;
    }

    .apt-form-header p {
        font-size: 14px;
        color: #64748b;
        margin: 0;
    }

    /* Success Alert */
    .apt-success-alert {
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

    .apt-success-alert i {
        font-size: 22px;
        color: #10b981;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .apt-success-alert strong {
        display: block;
        font-size: 14.5px;
        margin-bottom: 2px;
    }

    .apt-success-alert p {
        font-size: 13.5px;
        margin: 0;
    }

    /* Form Fields */
    .apt-input-group label {
        display: block;
        font-size: 13.5px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 6px;
    }

    .apt-input-group label .req {
        color: #ef4444;
    }

    .apt-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .apt-input-wrap i {
        position: absolute;
        left: 14px;
        color: #94a3b8;
        font-size: 17px;
        pointer-events: none;
        transition: color 0.2s;
    }

    .apt-input-wrap input,
    .apt-input-wrap select,
    .apt-input-wrap textarea {
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

    .apt-input-wrap.textarea-wrap i {
        top: 14px;
    }

    .apt-input-wrap.textarea-wrap textarea {
        padding-top: 12px;
        resize: vertical;
    }

    .apt-input-wrap input:focus,
    .apt-input-wrap select:focus,
    .apt-input-wrap textarea:focus {
        background: #ffffff;
        border-color: #29A9E0;
        box-shadow: 0 0 0 4px rgba(41, 169, 224, 0.15);
    }

    .apt-input-wrap input:focus + i,
    .apt-input-wrap select:focus + i,
    .apt-input-wrap textarea:focus + i {
        color: #29A9E0;
    }

    /* Submit Button */
    .apt-submit-btn {
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

    .apt-submit-btn:hover {
        background: linear-gradient(135deg, #1b8fc0 0%, #0d1647 100%);
        box-shadow: 0 12px 30px rgba(41, 169, 224, 0.5);
        transform: translateY(-2px);
    }

    .apt-submit-btn i {
        font-size: 19px;
    }

    /* ── Responsive adjustments ── */
    @media (max-width: 991px) {
        .apt-hero-banner {
            padding: 90px 0 60px;
        }

        .apt-form-card,
        .apt-info-card {
            padding: 28px 22px;
        }
    }

    @media (max-width: 575px) {
        .apt-main-section {
            padding: 40px 0 60px;
        }

        .apt-form-header h2,
        .apt-info-header h2 {
            font-size: 22px;
        }

        .apt-submit-btn {
            font-size: 14.5px;
            padding: 13px 20px;
        }
    }
</style>
@endsection