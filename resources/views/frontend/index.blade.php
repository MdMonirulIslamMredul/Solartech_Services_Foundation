@extends('frontend.layouts.app')
<meta name="viewport" content="width=device-width, initial-scale=1" />
@section('content')

   @php
        $sliders = DB::table('sliders')
            ->where('is_active', 1)
            ->get();
    @endphp

    <div class="banner-area pb-100" style="position: relative; margin-top: -80px; padding-top: 80px;">
        <div class="container-fluid p-0">
            <div class="hero-slider owl-carousel owl-theme" data-slider-id="1">
                @foreach ($sliders as $key => $slider)
                    <div class="slider-item">
                        <div class="slider-bg" style="background-image: url('{{ asset('setting/banner/' . $slider->image) }}');"></div>
                        <div class="slider-overlay"></div>
                        <div class="slider-grid"></div>
                        <div class="slider-content">
                            <span class="slider-eyebrow">Government-Enlisted Heavy Construction Contractor</span>
                            <h1>{{ $slider->header_title }}</h1>
                            <p>{{ $slider->bottom_title }}</p>
                            <div class="slider-cta-group">
                                <a href="{{ route('appointment.index') }}" class="hero-cta-btn">Book Appointment</a>
                                <a href="/service" class="hero-cta-btn-outline">Explore Services <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Hero slider manual navigation -->
        <div class="hero-nav" aria-label="Hero slider controls">
            <button id="heroPrev" type="button" class="hero-nav-btn prev" aria-label="Previous slide"><i class="ri-arrow-left-s-line"></i></button>
            <button id="heroNext" type="button" class="hero-nav-btn next" aria-label="Next slide"><i class="ri-arrow-right-s-line"></i></button>
        </div>

        @if ($sliders->count() > 1)
            <div class="hero-bottom-bar">
                <span class="hero-count"><span id="heroCurrentSlide">01</span><em>/ {{ str_pad($sliders->count(), 2, '0', STR_PAD_LEFT) }}</em></span>
                <div class="hero-dots" id="heroDots">
                    @foreach ($sliders as $key => $slider)
                        <button type="button" class="hero-dot @if ($key == 0) active @endif" data-index="{{ $key }}" aria-label="Go to slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <style>
        /* Prevent any off-canvas element (e.g. the theme's default owl nav/dots)
           from ever introducing a page-level horizontal scrollbar. */
        html, body { overflow-x: hidden; max-width: 100%; }

        .banner-area { position: relative; overflow: hidden; max-width: 100%; }
        .banner-area .container-fluid,
        .hero-slider,
        .hero-slider .owl-stage-outer { overflow: hidden; max-width: 100%; }
        /* NOTE: .owl-stage itself must NOT be capped with max-width/overflow –
           Owl Carousel intentionally sizes it wider than the viewport (sum of
           all slide widths) and slides it via transform. Constraining it here
           breaks the carousel layout and hides the slide images. */
        .slider-item { position: relative; overflow: hidden; min-height:750px; }
        .slider-bg { position: absolute; inset:0; background-size: cover; background-position: center; background-repeat:no-repeat; transform: scale(1); will-change: transform; }
        .hero-slider .owl-item.active .slider-bg { animation: heroKenBurns 6s linear forwards; }
        @keyframes heroKenBurns { from { transform: scale(1); } to { transform: scale(1.12); } }

        /* The base theme positions Owl Carousel's default nav/dots off-canvas
           (e.g. dots at left:-100px, nav at bottom:-130px) which can create a
           page-level horizontal scrollbar. Hide + neutralize them completely;
           this design uses its own custom nav/dots instead. */
        .hero-slider.owl-theme .owl-nav,
        .hero-slider.owl-theme .owl-dots {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
            overflow: hidden !important;
            position: static !important;
            left: auto !important;
            right: auto !important;
            top: auto !important;
            bottom: auto !important;
            transform: none !important;
        }

        /* Readability overlay + subtle blueprint grid texture */
        .slider-overlay { position:absolute; inset:0; z-index:1; background: linear-gradient(180deg, rgba(26,28,32,.35) 0%, rgba(26,28,32,.22) 38%, rgba(26,28,32,.58) 75%, rgba(26,28,32,.82) 100%); }
        .slider-grid { position:absolute; inset:0; z-index:2; pointer-events:none; opacity:.35; background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size:48px 48px; }

        .slider-content { position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); width:100%; max-width:920px; padding:0 25px; text-align:center; z-index: 5; color:#fff; }

        @keyframes heroFadeUp { from { opacity:0; transform:translateY(26px); } to { opacity:1; transform:translateY(0); } }
        .hero-slider .owl-item.active .slider-content .slider-eyebrow { animation: heroFadeUp .7s ease .1s both; }
        .hero-slider .owl-item.active .slider-content h1 { animation: heroFadeUp .7s ease .25s both; }
        .hero-slider .owl-item.active .slider-content p { animation: heroFadeUp .7s ease .4s both; }
        .hero-slider .owl-item.active .slider-content .slider-cta-group { animation: heroFadeUp .7s ease .55s both; }

        .slider-eyebrow { display:inline-flex; align-items:center; gap:10px; background: rgba(255,209,102,.14); border:1px solid rgba(255,209,102,.55); color: var(--nt-accent, #FFD166); font-size:13px; font-weight:700; text-transform:uppercase; letter-spacing:1.6px; padding:9px 20px; border-radius:999px; margin-bottom:24px; }
        .slider-eyebrow::before { content:''; width:7px; height:7px; border-radius:50%; background: var(--nt-accent, #FFD166); flex-shrink:0; }

        .slider-content h1 { font-size:80px; line-height:1.05; margin:0 0 20px; font-weight:800; text-shadow:0 4px 18px rgba(0,0,0,.5); }
        .slider-content p { margin:0 auto 34px; font-size:22px; max-width:720px; color:rgba(255,255,255,.92); text-shadow:0 2px 8px rgba(0,0,0,.4); }

        .slider-cta-group { display:flex; align-items:center; justify-content:center; gap:18px; flex-wrap:wrap; }
        .hero-cta-btn { display:inline-block; padding:16px 44px; background:var(--nt-accent, #ffd166); color:var(--nt-dark); font-size:20px; font-weight:700; border-radius:10px; text-decoration:none; letter-spacing:.5px; box-shadow:0 8px 25px rgba(255,209,102,.4); transition:.35s; border:2px solid transparent; }
        .hero-cta-btn:hover { background:var(--nt-secondary); color:var(--nt-text-on-dark); border-color:var(--nt-accent); transform:translateY(-3px); box-shadow:0 12px 32px rgba(43,48,58,.45); }
        .hero-cta-btn-outline { display:inline-flex; align-items:center; gap:8px; padding:14px 34px; border:2px solid rgba(255,255,255,.55); color:#fff; font-size:18px; font-weight:700; border-radius:10px; text-decoration:none; letter-spacing:.4px; transition:.3s; }
        .hero-cta-btn-outline:hover { border-color:var(--nt-accent, #FFD166); background:rgba(255,209,102,.12); color:var(--nt-accent, #FFD166); transform:translateY(-3px); }

        .hero-nav { position: absolute; top: 50%; left: 0; right: 0; transform: translateY(-50%); pointer-events: none; z-index: 10; }
        .hero-nav-btn { position: absolute; width: 46px; height: 46px; border-radius: 10px; border: 1px solid rgba(255,255,255,.35); background: rgba(43, 48, 58, 0.55); color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; pointer-events: auto; transition: all 0.3s; font-size: 22px; }
        .hero-nav-btn:hover { background: var(--nt-accent); border-color: var(--nt-accent); color: var(--nt-dark); }
        .hero-nav-btn.prev { left: 24px; }
        .hero-nav-btn.next { right: 24px; }

        .hero-bottom-bar { position:absolute; left:0; right:0; bottom:28px; z-index:10; display:flex; align-items:center; justify-content:center; gap:22px; }
        .hero-count { color:#fff; font-weight:700; font-size:15px; letter-spacing:.5px; }
        .hero-count em { font-style:normal; color:rgba(255,255,255,.6); margin-left:4px; }
        .hero-dots { display:flex; align-items:center; gap:8px; }
        .hero-dot { width:26px; height:4px; border-radius:999px; border:none; background:rgba(255,255,255,.4); cursor:pointer; transition:.3s; padding:0; }
        .hero-dot:hover { background:rgba(255,255,255,.7); }
        .hero-dot.active { width:38px; background: var(--nt-accent, #FFD166); }

        /* Tablet responsive */
        @media (max-width: 991px){
            .slider-item { min-height:560px; }
            .slider-content { padding:0 20px; }
            .slider-content h1 { font-size:54px; line-height:1.1; margin:0 0 15px; }
            .slider-content p { font-size:18px; margin-bottom:26px; }
            .hero-cta-btn { font-size:18px; padding:14px 34px; }
            .hero-cta-btn-outline { font-size:16px; padding:12px 28px; }
            .hero-nav-btn { width:42px; height:42px; font-size:19px; }
            .hero-nav-btn.prev { left: 15px; }
            .hero-nav-btn.next { right: 15px; }
            .hero-bottom-bar { bottom:18px; }
        }
        /* Mobile responsive */
        @media (max-width: 575px){
            .slider-item { min-height:460px; }
            .slider-content { padding:0 15px; max-width:92%; }
            .slider-eyebrow { font-size:11px; padding:7px 14px; margin-bottom:16px; }
            .slider-content h1 { font-size:30px; line-height:1.2; margin:0 0 12px; }
            .slider-content p { font-size:14px; margin-bottom:20px; line-height:1.4; }
            .slider-cta-group { gap:12px; }
            .hero-cta-btn { padding:11px 26px; font-size:15px; border-radius:8px; }
            .hero-cta-btn-outline { padding:10px 22px; font-size:14px; border-radius:8px; }
            .hero-nav-btn { width:36px; height:36px; font-size:16px; }
            .hero-nav-btn.prev { left: 10px; }
            .hero-nav-btn.next { right: 10px; }
            .hero-bottom-bar { bottom:14px; gap:14px; }
            .hero-count { font-size:12px; }
            .hero-dot { width:18px; height:3px; }
            .hero-dot.active { width:26px; }
        }
        /* Extra small mobile */
        @media (max-width: 400px){
            .slider-item { min-height:400px; }
            .slider-content h1 { font-size:26px; }
            .slider-content p { font-size:13px; }
            .hero-cta-btn { padding:10px 22px; font-size:14px; }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            if (typeof jQuery !== 'undefined'){
                var $hero = jQuery('.hero-slider');
                var prevBtn = document.getElementById('heroPrev');
                var nextBtn = document.getElementById('heroNext');
                if(prevBtn){ prevBtn.addEventListener('click', function(){ $hero.trigger('prev.owl.carousel'); }); }
                if(nextBtn){ nextBtn.addEventListener('click', function(){ $hero.trigger('next.owl.carousel'); }); }

                // Sync slide counter + dot indicators with the Owl Carousel
                var dots = document.querySelectorAll('#heroDots .hero-dot');
                var counter = document.getElementById('heroCurrentSlide');

                dots.forEach(function(dot){
                    dot.addEventListener('click', function(){
                        var index = parseInt(dot.getAttribute('data-index'), 10) || 0;
                        $hero.trigger('to.owl.carousel', [index, 300]);
                    });
                });

                $hero.on('changed.owl.carousel', function(e){
                    if (!e.item || typeof e.item.index === 'undefined') return;
                    var owl = $hero.data('owl.carousel');
                    var total = dots.length || e.item.count || 1;
                    var current = owl ? owl.relative(e.item.index) : (e.item.index % total);
                    current = ((current % total) + total) % total;

                    dots.forEach(function(dot, i){ dot.classList.toggle('active', i === current); });
                    if (counter) { counter.textContent = String(current + 1).padStart(2, '0'); }
                });
            }
        });
    </script>

    <!-- Solar Panel Installation Section -->
    <div class="solar-installation-area" style="background-color: #ffffff; padding: 60px 0;">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center mb-5">
                <h2 style="font-size: 48px; color: var(--nt-secondary); font-weight: bold; margin-bottom: 40px;">
                    Nawar Trader Believe For The Best
                </h2>
            </div>
            <!-- Main Images Row -->
            <div class="row mb-4">
                <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-right" data-aos-duration="1000">
                    <div class="installation-card" style="position: relative; overflow: hidden; border-radius: 8px;">
                        <img src="{{ asset('setting/homepage/road.jpg') }}" alt="Residential "
                             style="width: 100%; height: 400px; object-fit: cover; display: block;">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(43, 48, 58, 0.95), rgba(43, 48, 58, 0.75)); padding: 20px; text-align: center;">
                            <h3 style="color: #ffffff; font-size: 32px; font-weight: bold; margin: 0;">Road</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-left" data-aos-duration="1000">
                    <div class="installation-card" style="position: relative; overflow: hidden; border-radius: 8px;">
                        <img src="{{ asset('setting/homepage/building.jpg') }}" alt="Commercial "
                             style="width: 100%; height: 400px; object-fit: cover; display: block;">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(43, 48, 58, 0.95), rgba(43, 48, 58, 0.75)); padding: 20px; text-align: center;">
                            <h3 style="color: #ffffff; font-size: 32px; font-weight: bold; margin: 0;">Building</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Buttons Row -->
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="100">
                    <a href="#" class="category-btn" style="display: block; background-color: var(--nt-secondary); color: var(--nt-text-on-dark); text-align: center; padding: 20px 15px; border-radius: 5px; text-decoration: none; font-size: 20px; font-weight: bold; transition: all 0.3s ease;">
                        Schools
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="200">
                    <a href="#" class="category-btn" style="display: block; background-color: var(--nt-secondary); color: var(--nt-text-on-dark); text-align: center; padding: 20px 15px; border-radius: 5px; text-decoration: none; font-size: 20px; font-weight: bold; transition: all 0.3s ease;">
                        Colleges
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="300">
                    <a href="#" class="category-btn" style="display: block; background-color: var(--nt-secondary); color: var(--nt-text-on-dark); text-align: center; padding: 20px 15px; border-radius: 5px; text-decoration: none; font-size: 20px; font-weight: bold; transition: all 0.3s ease;">
                        Institutions
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="400">
                    <a href="#" class="category-btn" style="display: block; background-color: var(--nt-secondary); color: var(--nt-text-on-dark); text-align: center; padding: 20px 15px; border-radius: 5px; text-decoration: none; font-size: 20px; font-weight: bold; transition: all 0.3s ease;">
                        Government
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="500">
                    <a href="#" class="category-btn" style="display: block; background-color: var(--nt-secondary); color: var(--nt-text-on-dark); text-align: center; padding: 20px 15px; border-radius: 5px; text-decoration: none; font-size: 20px; font-weight: bold; transition: all 0.3s ease;">
                        Utility
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .category-btn:hover {
            background-color: var(--nt-accent) !important;
            color: var(--nt-dark) !important;
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(255, 209, 102, 0.45);
        }

        /* Dark theme support for solar installation section */
        .theme-dark .solar-installation-area {
            background-color: #0e0e0e !important;
        }
        .theme-dark .solar-installation-area h2 {
            color: #f1f1f1 !important;
        }
        .theme-dark .solar-installation-area h3 {
            color: #ffffff !important;
        }
        .theme-dark .installation-card {
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
        }
    </style>

    <div class="campus-information-area " style="background-color: var(--nt-primary);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-duration="1300"
                    data-aos-once="true">
                    <div class="campus-content pr-20">
                        <div class="campus-title">
                            <h2 style="font-size:50px; color:var(--nt-dark);">About Us</h2>
                            <hr>

                            <p>{{ $about->short_description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-easing="ease-in-sine" data-aos-duration="1300"
                    data-aos-once="true">
                    <div class="campus-image pl-20">
                        <img src="{{ asset('/setting/about/' . $about->about_image) }}" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="features-section" style="background-color: var(--nt-primary); width: 100%;">

     <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 23px; padding: 50px 20px; max-width: 1200px; margin: auto;">

    <!-- Feature 1 -->
    <div class="feature-item" style="flex: 1 1 calc(25% - 20px); text-align: center; min-width: 220px;">
        <div style="width: 84px; height: 84px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 22px; background: rgba(255, 209, 102, 0.2); color: var(--nt-secondary); font-size: 30px; box-shadow: 0 8px 20px rgba(43, 48, 58, 0.08);">
            <svg aria-hidden="true" focusable="false" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color:var(--nt-secondary);">
                <path d="M1 21l7-7 3 3-7 7H1v-3zM21.7 6.3l-4-4a1 1 0 00-1.4 0l-2.9 2.9 5.4 5.4L21.7 7.7a1 1 0 000-1.4zM7 13l5-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h3 class="feature-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">e-GP Enlisted</h3>
        <p class="feature-text" style="font-size: 14px; color: var(--nt-text-body); text-align: justify; text-justify: inter-word; hyphens: auto; line-height: 1.6; margin: 0 10px;">Fully registered and compliant with national electronic government procurement (e-GP) systems, ensuring complete transparency, rigorous legal compliance, and technical eligibility for high-budget public works tenders.</p>
    </div>

    <!-- Feature 2 -->
    <div class="feature-item" style="flex: 1 1 calc(25% - 20px); text-align: center; min-width: 220px;">
        <div style="width: 84px; height: 84px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 22px; background: rgba(255, 209, 102, 0.2); color: var(--nt-secondary); font-size: 30px; box-shadow: 0 8px 20px rgba(43, 48, 58, 0.08);">
            <svg aria-hidden="true" focusable="false" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color:var(--nt-secondary);">
                <path d="M12 2a7 7 0 00-7 7v1h14V9a7 7 0 00-7-7zM4 13v2a2 2 0 002 2h12a2 2 0 002-2v-2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h3 class="feature-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Structural Integrity</h3>
        <p class="feature-text" style="font-size: 14px; color: var(--nt-text-body); text-align: justify; text-justify: inter-word; hyphens: auto; line-height: 1.6; margin: 0 10px;">Adhering strictly to PWD, RHD, and LGED engineering specifications. We utilize premium-grade reinforced steel and high-strength concrete mixes to guarantee that every bridge, road, and school stands for generations.</p>
    </div>

    <!-- Feature 3 -->
    <div class="feature-item" style="flex: 1 1 calc(25% - 20px); text-align: center; min-width: 220px;">
        <div style="width: 84px; height: 84px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 22px; background: rgba(255, 209, 102, 0.2); color: var(--nt-secondary); font-size: 30px; box-shadow: 0 8px 20px rgba(43, 48, 58, 0.08);">
            <svg aria-hidden="true" focusable="false" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color:var(--nt-secondary);">
                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/>
                <path d="M12 7v5l3 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h3 class="feature-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">On-Time Execution</h3>
        <p class="feature-text" style="font-size: 14px; color: var(--nt-text-body); text-align: justify; text-justify: inter-word; hyphens: auto; line-height: 1.6; margin: 0 10px;">Driven by strict project management timelines and dynamic site scheduling to minimize public disruption and complete critical public infrastructure, highway networks, and institutional complexes exactly on schedule.</p>
    </div>

    <!-- Feature 4 -->
    <div class="feature-item" style="flex: 1 1 calc(25% - 20px); text-align: center; min-width: 220px;">
        <div style="width: 84px; height: 84px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 22px; background: rgba(255, 209, 102, 0.2); color: var(--nt-secondary); font-size: 30px; box-shadow: 0 8px 20px rgba(43, 48, 58, 0.08);">
            <svg aria-hidden="true" focusable="false" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="color:var(--nt-secondary);">
                <path d="M3 7h11v8H3z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"/>
                <path d="M14 10h4l3 3v2h-7" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"/>
                <circle cx="7.5" cy="17.5" r="1.5" fill="currentColor"/>
                <circle cx="18.5" cy="17.5" r="1.5" fill="currentColor"/>
            </svg>
        </div>
        <h3 class="feature-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Heavy Machinery Fleet</h3>
        <p class="feature-text" style="font-size: 14px; color: var(--nt-text-body); text-align: justify; text-justify: inter-word; hyphens: auto; line-height: 1.6; margin: 0 10px;">Backed by a powerful, company-owned logistics pipeline and a modern fleet of heavy construction equipment—including excavators, vibratory rollers, asphalt pavers, and piling rigs—built to scale.</p>
    </div>

</div>
</div>

<style>
    /* Dark theme support for Features section */
    .theme-dark .features-section {
        background-color: #0e0e0e !important;
    }
    .theme-dark .feature-title {
        color: #f1f1f1 !important;
    }
    .theme-dark .feature-text {
        color: #c7c7c7 !important;
    }
</style>








<style>
.modern-counter-section {
    background: linear-gradient(135deg, #2B303A 0%, #1A1C20 100%);
    padding: 80px 0;
    position: relative;
    overflow: hidden;
}
.modern-counter-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,117.3C1248,117,1344,139,1392,149.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
    background-size: cover;
    opacity: 0.3;
}
.modern-counter-wrapper {
    position: relative;
    z-index: 2;
}
.modern-counter-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 24px;
    padding: 40px 25px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}
.modern-counter-card:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}
.modern-counter-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    transition: all 0.4s ease;
}
.modern-counter-card:hover .modern-counter-icon {
    transform: rotate(360deg) scale(1.1);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.25);
}
.modern-counter-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.modern-counter-icon::before {
    content: '';
    position: absolute;
    inset: -5px;
    border-radius: 50%;
    padding: 3px;
    background: linear-gradient(135deg, #FFD166, #2B303A, #FFD166);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    animation: borderRotate 3s linear infinite;
}
@keyframes borderRotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.modern-counter-card.orange .modern-counter-icon {
    background: linear-gradient(135deg, #FFD166, #E6B84D);
}
.modern-counter-card.green .modern-counter-icon {
    background: linear-gradient(135deg, #3A4150, #2B303A);
}
.modern-counter-card.blue .modern-counter-icon {
    background: linear-gradient(135deg, #2B303A, #1A1C20);
}
.modern-counter-card.purple .modern-counter-icon {
    background: linear-gradient(135deg, #FFD166, #1A1C20);
}
.modern-counter-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--nt-dark);
    margin: 0 0 15px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.modern-counter-value {
    font-size: 48px;
    font-weight: 800;
    background: linear-gradient(135deg, #2B303A 0%, #1A1C20 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    display: inline-block;
}
.modern-counter-plus {
    font-size: 32px;
    font-weight: 700;
    color: var(--nt-secondary);
    margin-left: 5px;
}

/* Dark theme support */
.theme-dark .modern-counter-section {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
}
.theme-dark .modern-counter-card {
    background: rgba(30, 30, 46, 0.95);
    border-color: rgba(255, 255, 255, 0.1);
}
.theme-dark .modern-counter-title {
    color: #e5e7eb;
}
.theme-dark .modern-counter-value {
    background: linear-gradient(135deg, #60a5fa 0%, #a78bfa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.theme-dark .modern-counter-plus {
    color: #a78bfa;
}

@media (max-width: 991px) {
    .modern-counter-section { padding: 60px 0; }
    .modern-counter-card { padding: 35px 20px; margin-bottom: 25px; }
    .modern-counter-icon { width: 85px; height: 85px; margin-bottom: 20px; }
    .modern-counter-value { font-size: 40px; }
    .modern-counter-title { font-size: 18px; }
}
@media (max-width: 575px) {
    .modern-counter-section { padding: 50px 0; }
    .modern-counter-card { padding: 30px 18px; }
    .modern-counter-icon { width: 75px; height: 75px; }
    .modern-counter-value { font-size: 36px; }
    .modern-counter-title { font-size: 16px; }
}
</style>

<div class="modern-counter-section">
    <div class="container modern-counter-wrapper">
        <div class="row justify-content-center">
            <!-- Projects Done -->
            <div class="col-lg-3 col-md-6 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
                <div class="modern-counter-card orange">
                    <div class="modern-counter-icon">
                        <img src="{{ asset('setting/banner/done.jpg') }}" alt="Projects Done">
                    </div>
                    <h3 class="modern-counter-title">Projects Done</h3>
                    <div>
                        <span class="modern-counter-value" data-target="50">0</span>
                        <span class="modern-counter-plus">+</span>
                    </div>
                </div>
            </div>

            <!-- Our Staff -->
            <div class="col-lg-3 col-md-6 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="200">
                <div class="modern-counter-card green">
                    <div class="modern-counter-icon">
                        <img src="{{ asset('setting/banner/staf.png') }}" alt="Our Staff">
                    </div>
                    <h3 class="modern-counter-title">Our Staff</h3>
                    <div>
                        <span class="modern-counter-value" data-target="16">0</span>
                        <span class="modern-counter-plus">+</span>
                    </div>
                </div>
            </div>

            <!-- Trusted Clients -->
            <div class="col-lg-3 col-md-6 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="300">
                <div class="modern-counter-card blue">
                    <div class="modern-counter-icon">
                        <img src="{{ asset('setting/banner/trust.jpg') }}" alt="Trusted Clients">
                    </div>
                    <h3 class="modern-counter-title">Trusted Clients</h3>
                    <div>
                        <span class="modern-counter-value" data-target="50">0</span>
                        <span class="modern-counter-plus">+</span>
                    </div>
                </div>
            </div>

            <!-- Satisfied Clients -->
            <div class="col-lg-3 col-md-6 col-sm-6" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="400">
                <div class="modern-counter-card purple">
                    <div class="modern-counter-icon">
                        <img src="{{ asset('setting/banner/satisfied.jpg') }}" alt="Satisfied Clients">
                    </div>
                    <h3 class="modern-counter-title">Satisfied Clients</h3>
                    <div>
                        <span class="modern-counter-value" data-target="40">0</span>
                        <span class="modern-counter-plus">+</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Modern counter animation with Intersection Observer
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.modern-counter-value');
    const speed = 200; // Animation speed

    const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const increment = target / speed;
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.ceil(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };
        updateCounter();
    };

    // Use Intersection Observer for better performance
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                if (counter.textContent === '0') {
                    animateCounter(counter);
                }
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));
});
</script>




    <!-- Modern Services Grid -->
    <style>
        .services-section {padding: 80px 0;}
        .services-section .section-title h2 {font-weight:700; letter-spacing:.5px; position:relative;}
        .services-section .section-title h2:after {content:''; width:450px; height:4px; background:var(--nt-accent); position:absolute; left:0; bottom:-15px; border-radius:3px;}
        .service-card {position:relative; border-radius:20px; overflow:hidden; background:#fff; box-shadow:0 10px 30px rgba(0,0,0,.08); transition:transform .5s cubic-bezier(.19,1,.22,1), box-shadow .5s, border .3s; border:3px solid transparent;}
        .service-card:hover {transform:translateY(-8px); box-shadow:0 15px 35px rgba(0,0,0,.15); border-color:var(--nt-accent);}
        .service-card img {width:100%; height:320px; object-fit:cover; display:block; filter:brightness(.9); transition:filter .3s ease, border-radius .3s; border-radius:20px 20px 0 0;}
        .service-card:hover img {filter:brightness(.3); border-radius:20px;}
        .service-info {padding:22px 28px 35px;}
        .service-info h3 {font-size:24px; font-weight:600; margin:0; color:var(--nt-dark);}
        .service-badge {position:absolute; top:18px; left:18px; background:var(--nt-secondary); color:#fff; padding:6px 14px; font-size:14px; border-radius:30px; letter-spacing:.5px; font-weight:600; box-shadow:0 4px 12px rgba(0,0,0,.25);}
        .service-overlay {position:absolute; inset:0; background:linear-gradient(180deg, rgba(26,28,32,0) 0%, rgba(26,28,32,.88) 75%); display:flex; flex-direction:column; justify-content:flex-end; padding:28px; opacity:0; transition:opacity .45s ease; color:#fff;}
        .service-card:hover .service-overlay {opacity:1;}
        .service-overlay .details {max-height:160px; overflow:auto; scrollbar-width:thin; color:#ffffff; font-size:15px;}
        .service-overlay .details p {color:#ffffff !important;}
        .service-overlay .details::-webkit-scrollbar {width:6px;}
        .service-overlay .details::-webkit-scrollbar-track {background:rgba(255, 255, 255, 0.15); border-radius:10px;}
        .service-overlay .details::-webkit-scrollbar-thumb {background:var(--nt-accent); border-radius:10px;}
        .service-actions {margin-top:16px;}
        .service-actions a {display:inline-block; background:var(--nt-accent); color:var(--nt-dark); padding:12px 24px; border-radius:30px; font-size:15px; font-weight:600; text-decoration:none; letter-spacing:.5px; transition:background .3s;}
        .service-actions a:hover {background:#fff;}
        /* Mobile tap: show overlay when active */
        @media (hover:none) { .service-overlay {opacity:1; background:linear-gradient(180deg, rgba(26,28,32,.3) 0%, rgba(26,28,32,.92) 70%);} .service-info {padding-bottom:20px;} }
        /* Tablet responsive */
        @media (max-width: 991px){
            .services-section {padding: 60px 0;}
            .services-section .section-title h2:after {width:300px;}
            .service-card img {height:280px;}
            .service-info h3 {font-size:22px;}
            .service-overlay {padding:22px;}
        }
        /* Mobile responsive */
        @media (max-width: 575px){
            .services-section {padding: 50px 0;}
            .services-section .section-title h2 {font-size:28px;}
            .services-section .section-title h2:after {width:150px; height:3px;}
            .service-card {border-radius:16px;}
            .service-card img {height:240px; border-radius:16px 16px 0 0;}
            .service-card:hover img {border-radius:16px;}
            .service-info {padding:18px 20px 28px;}
            .service-info h3 {font-size:20px;}
            .service-badge {top:12px; left:12px; padding:5px 12px; font-size:13px;}
            .service-overlay {padding:18px;}
            .service-overlay .details {font-size:14px; max-height:140px;}
            .service-actions {margin-top:12px;}
            .service-actions a {padding:10px 20px; font-size:14px;}
        }
    </style>
    <div class="services-section">
        <div class="container">
            <div class="section-title mb-5">
                <h2>Our Services</h2>
            </div>
            <!-- Horizontal auto-scrolling track -->
            <div class="services-slider-wrapper position-relative" style="overflow:hidden;">
                <div id="servicesTrack" class="d-flex" style="gap:24px; will-change:transform;">
                    @foreach($services as $service)
                        <div class="service-flex-item" style="flex:0 0 calc(33.333% - 16px);" data-aos="fade-up" data-aos-duration="900">
                            <div class="service-card">
                                <span class="service-badge">Service</span>
                                <img src="{{ asset('/setting/service/' . $service->image1) }}" alt="{{ $service->title }}" loading="lazy">
                                <div class="service-info">
                                    <h3>{{ $service->title }}</h3>
                                </div>
                                <div class="service-overlay">
                                    <div class="details">{!! $service->details1 !!}</div>
                                    <div class="service-actions"><a href="{{ route('service.show', $service->id) }}">See More</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="services-controls text-center mt-4">
                <div class="svc-dots mb-3">
                    @php $serviceCount = $services->count(); @endphp
                    @for($i = 0; $i < max(0,$serviceCount-2); $i++)
                        <button type="button" class="svc-dot {{ $i===0 ? 'active' : '' }}" data-index="{{ $i }}" aria-label="Slide {{ $i+1 }}"></button>
                    @endfor
                </div>
                <a href="/service" class="btn btn-outline-secondary px-4 py-2" style="border-radius:30px; font-weight:600;">See All Services</a>
                <div class="small mt-2" style="color:#555;"> </div>
            </div>
        </div>
    </div>
    <style>
        .svc-dot {width:14px; height:14px; border-radius:50%; border:none; background:var(--nt-secondary); opacity:.35; margin:0 6px; transition:.3s; cursor:pointer;}
        .svc-dot.active {background:var(--nt-accent); opacity:1; transform:scale(1.15);} .svc-dot:hover {opacity:.75;}
        @media (max-width: 767px){ .service-flex-item{flex:0 0 100%; min-width:100%;} }
        @media (min-width: 768px) and (max-width: 991px){ .service-flex-item{flex:0 0 calc(50% - 12px); min-width:calc(50% - 12px);} }
    </style>
    <script>
        // Touch devices: tap to toggle overlay visibility
        (function(){
            if(matchMedia('(hover:none)').matches){
                document.querySelectorAll('.service-card').forEach(function(card){
                    card.classList.add('tap-mode');
                    var opened = true;
                    card.addEventListener('click', function(e){
                        if(e.target.closest('a')) return;
                        opened = !opened;
                        card.querySelector('.service-overlay').style.opacity = opened ? '1' : '0';
                    });
                });
            }
        })();

        // Auto slide logic (responsive card count)
        (function(){
            var track = document.getElementById('servicesTrack');
            if(!track) return;
            var items = track.querySelectorAll('.service-flex-item');
            var dots = document.querySelectorAll('.svc-dot');
            var index = 0;
            var intervalMs = 2000; // 2 seconds per slide
            var paused = false;

            function getVisibleCards(){
                var width = window.innerWidth;
                if(width <= 767) return 1; // Mobile: 1 card
                if(width <= 991) return 2; // Tablet: 2 cards
                return 3; // Desktop: 3 cards
            }

            function cardWidth(){
                var first = items[0];
                if(!first) return 0;
                var width = first.getBoundingClientRect().width;
                var gap = 24;
                return width + gap;
            }

            function setActiveDot(i){
                dots.forEach(function(d){ d.classList.remove('active'); });
                if(dots[i]) dots[i].classList.add('active');
            }

            function goTo(i){
                index = i;
                var cw = cardWidth();
                track.style.transform = 'translateX(' + (-index * cw) + 'px)';
                setActiveDot(index);
            }

            function next(){
                if(paused) return;
                var visibleCards = getVisibleCards();
                index++;
                if(index > items.length - visibleCards){
                    index = 0;
                }
                goTo(index);
            }

            var timer = setInterval(next, intervalMs);
            track.addEventListener('mouseenter', function(){ paused = true; });
            track.addEventListener('mouseleave', function(){ paused = false; });
            dots.forEach(function(dot){
                dot.addEventListener('click', function(){
                    var i = parseInt(dot.getAttribute('data-index'),10) || 0;
                    goTo(i);
                });
            });
            window.addEventListener('resize', function(){ goTo(index); });
        })();
    </script>

{{-- <div id="brandsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false"
     style="width: 100%; padding: 60px 20px; background: var(--nt-primary);">

    <!-- Section Title -->
    <h2 style="text-align: center; margin-bottom: 40px; font-weight: 800; font-size: 2.2rem; color: var(--nt-dark);">
        Our Service Areas
        <span style="display: block; width: 80px; height: 5px; background: var(--nt-accent); margin: 10px auto 0; border-radius: 3px;"></span>
    </h2>

    <!-- Slides -->
    <div class="carousel-inner">
        @foreach ($areas->chunk(4) as $index => $chunk)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="row justify-content-center">
                    @foreach ($chunk as $area)
                        <div class="col-6 col-sm-4 col-md-3 mb-4 text-center">
                            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 15px; border-radius: 12px; background: var(--nt-surface); border: 1px solid var(--nt-border);">
                                @if ($area->image)
                                    <img src="{{ asset( $area->image) }}"
                                         alt="{{ $area->areaname }}"
                                         style="max-height: 80px; max-width: 100%; object-fit: contain; margin-bottom: 10px;">
                                @else
                                    <p style="font-size: 12px; color:var(--nt-text-muted);"><em>No image available</em></p>
                                @endif
                                <h6 style="font-size: 15px; font-weight: 600; color: var(--nt-secondary); margin:0;">
                                    {{ $area->title ?? $area->areaname }}
                                </h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#brandsCarousel" data-bs-slide="prev"
        style="top: 50%; transform: translateY(-50%); left: 15px; width: 40px; height: 40px; border-radius: 50%; background: rgba(43, 48, 58, 0.55); border: none;"></button>

    <button class="carousel-control-next" type="button" data-bs-target="#brandsCarousel" data-bs-slide="next"
        style="top: 50%; transform: translateY(-50%); right: 15px; width: 40px; height: 40px; border-radius: 50%; background: rgba(43, 48, 58, 0.55); border: none;"></button>

</div> --}}







<div id="brandsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false"
     style="width: 100%; padding: 60px 20px; background: var(--nt-surface);">

    <!-- Section Title -->
    <h2 style="text-align: center; margin-bottom: 40px; font-weight: 800; font-size: 2.2rem; color: var(--nt-dark);">
        Our Partners
        <span style="display: block; width: 80px; height: 5px; background: var(--nt-accent); margin: 10px auto 0; border-radius: 3px;"></span>
    </h2>

    <!-- Slides -->
    <div class="carousel-inner">
        @foreach ($brands->chunk(4) as $index => $chunk)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="row justify-content-center">
                    @foreach ($chunk as $brand)
                        <div class="col-6 col-sm-4 col-md-3 mb-4 text-center">
                            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 15px; border-radius: 12px; background: var(--nt-primary); border: 1px solid var(--nt-border);">
                                @if ($brand->logo)
                                    <img src="{{ asset('/setting/brand/' . $brand->logo) }}"
                                         alt="{{ $brand->name }}"
                                         style="max-height: 80px; max-width: 100%; object-fit: contain; margin-bottom: 10px;">
                                @else
                                    <p style="font-size: 12px; color:var(--nt-text-muted);"><em>No logo</em></p>
                                @endif
                                <h6 style="font-size: 15px; font-weight: 600; color: var(--nt-secondary); margin:0;">
                                    {{ $brand->title ?? $brand->name }}
                                </h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#brandsCarousel" data-bs-slide="prev"
        style="top: 50%; transform: translateY(-50%); left: 15px; width: 40px; height: 40px; border-radius: 50%; background: rgba(43, 48, 58, 0.55); border: none;"></button>

    <button class="carousel-control-next" type="button" data-bs-target="#brandsCarousel" data-bs-slide="next"
        style="top: 50%; transform: translateY(-50%); right: 15px; width: 40px; height: 40px; border-radius: 50%; background: rgba(43, 48, 58, 0.55); border: none;"></button>

</div>







    <<div id="rs-faq" class="faq-area ptb-100">
    <div class="container">
        <div class="row">

            <!-- Left side: FAQ accordion -->
            <div class="col-lg-8">
                <div class="sec-title2 mb-45">
                    <h2 class="title title6">FAQs</h2>
                </div>
                <div class="faq-content">
                    <div id="accordionExample" class="accordion">
                        @foreach ($faqs as $key => $faq)
                            @php
                                $ids = [
                                    'collapseOne','collapseTwo','collapseThree',
                                    'collapseFour','collapseFive','collapseSix','collapseSeven'
                                ];
                                $i = $ids[$key] ?? 'collapse'.$key;
                            @endphp

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#{{ $i }}" aria-expanded="false"
                                        aria-controls="{{ $i }}">
                                        {{ $faq->question ?? 'FAQ' }}
                                    </button>
                                </div>
                                <div id="{{ $i }}" class="collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ $faq->answer ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

<!-- Right side: Static image -->
<div class="col-lg-4 d-flex justify-content-center align-items-start">
    <div class="faq-img text-center p-4 shadow-lg rounded-4"
         style="background:#ffffff; min-height: 500px; display:flex; flex-direction:column; justify-content:center; align-items:center;">

       <img src="{{ asset('setting/brand/Gemini_Generated_Image_13ws8713ws8713ws.png') }}"
             alt="FAQ Image"
             class="w-100 h-100"
             style="object-fit: cover; border-radius:12px;">

        <p class="fw-semibold text-dark fs-5">
            Have Questions? <br> We’ve Got Answers ⚡
        </p>
    </div>
</div>



        </div>
    </div>
</div>


   <div class="lates-news-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h2>Latest Blogs</h2>
        </div>
        <style>
            /* Blog card radius + orange hover customization */
            .single-news-card {border-radius:12px; overflow:hidden; transition:.35s ease; background:#ffffff; box-shadow:0 8px 22px -8px rgba(0,0,0,.1); border:2px solid transparent;}
            .single-news-card .news-img img {border-radius:0; width:100%; height:240px; object-fit:cover; display:block;}
            .single-news-card:hover {border-color:var(--nt-accent); box-shadow:0 14px 34px -10px rgba(0,0,0,.25); transform:translateY(-6px); background:#ffffff;}
            .single-news-card .read-more-btn {display:inline-block; margin-top:8px; font-weight:600;}
            .single-news-card .read-more-btn i {margin-left:6px;}
            /* Dark theme */
            .theme-dark .single-news-card {background:#1f2937; box-shadow:0 8px 22px -8px rgba(0,0,0,.6);}
            .theme-dark .single-news-card:hover {background:#1f2937; border-color:var(--nt-accent);}
        </style>
        <div class="row justify-content-center">
            @foreach ($blogs as $blog)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200"
                    data-aos-once="true">
                    <div class="single-news-card">
                        <div class="news-img">
                            <a href="/blog/details/{{ $blog->id }}">
                                <img src="{{ asset('/setting/blog/' . $blog->image1) }}" alt="Image">
                            </a>
                        </div>
                        <div class="news-content">
                            <div class="list">
                                <ul>
                                    <li><i class="flaticon-user"></i>
                                        By <a href="/blog/details/{{ $blog->id }}" style="text-decoration: none; color: var(--nt-dark);">Admin</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="/blog/details/{{ $blog->id }}" style="text-decoration: none; color: var(--nt-dark);">
                                <h3>{{ $blog->short_details }}</h3>
                            </a>
                            <a href="/blog/details/{{ $blog->id }}" class="read-more-btn" style="text-decoration: none; color: var(--nt-secondary);">
                                Read More<i class="flaticon-next"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="more-latest-news text-center">
            <a href="/blogs" class="read-more-btn active" style="text-decoration: none; color: var(--nt-secondary);">
                More on Blogs<i class="flaticon-next"></i>
            </a>
        </div>
    </div>
</div>




@endsection
