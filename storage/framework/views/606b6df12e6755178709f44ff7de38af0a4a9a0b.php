<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php $__env->startSection('content'); ?>

   <?php
        $sliders = DB::table('sliders')
            ->where('is_active', 1)
            ->get();
    ?>

    <div class="banner-area pb-100" style="position: relative; margin-top: -80px; padding-top: 80px;">
        <div class="container-fluid">
            <div class="hero-slider owl-carousel owl-theme" data-slider-id="1">
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="slider-item">
                        <div class="slider-bg" style="background-image: url('<?php echo e(asset('setting/banner/' . $slider->image)); ?>');"></div>
                        <div class="slider-content <?php if($key == 0): ?> active <?php endif; ?>">
                            <h1><?php echo e($slider->header_title); ?></h1>
                            <p style="text-align: center; font-size: 22px;"><?php echo e($slider->bottom_title); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <!-- Fixed CTA and Hero slider manual navigation -->
        <div class="hero-fixed-cta">
            <a href="<?php echo e(route('appointment.index')); ?>" class="hero-cta-btn">Book Appointment</a>
        </div>
        <div class="hero-nav" aria-label="Hero slider controls">
            <button id="heroPrev" type="button" class="hero-nav-btn prev" aria-label="Previous slide">&#10094;</button>
            <button id="heroNext" type="button" class="hero-nav-btn next" aria-label="Next slide">&#10095;</button>
        </div>
    </div>
    <style>
        .banner-area { position: relative; }
        .slider-item { position: relative; overflow: hidden; min-height:750px; }
        .slider-bg { position: absolute; inset:0; background-size: cover; background-position: center; background-repeat:no-repeat; transform: scale(1); will-change: transform; }
        .hero-slider .owl-item.active .slider-bg { animation: heroKenBurns 3s linear forwards; }
        @keyframes  heroKenBurns { from { transform: scale(1); } to { transform: scale(1.12); } }
        .slider-content { position:absolute; top:45%; left:50%; transform:translate(-50%, -45%); width:100%; max-width:1000px; padding:0 25px; text-align:center; z-index: 5; color:#fff; text-shadow:0 2px 6px rgba(0,0,0,.45); }
        .slider-content h1 { font-size:80px; line-height:1.05; margin:0 0 18px; }
        .slider-content p { margin:0 0 28px; }
        .hero-fixed-cta { position:absolute; top: calc(45% + 210px); left:50%; transform:translate(-50%, 0); z-index:11; }
        .hero-cta-btn { display:inline-block; padding:16px 44px; background:#1565c098; color:#fff; font-size:22px; font-weight:700; border-radius:10px; text-decoration:none; letter-spacing:.5px; box-shadow:0 8px 25px rgba(21,101,192,.35); transition:.35s; border:2px solid transparent; }
        .hero-cta-btn:hover { background:#ff6a009a; border-color:#0059ff; transform:translateY(-3px); box-shadow:0 12px 32px rgba(255,140,0,.45); }
        .hero-nav { position: absolute; top: 50%; left: 0; right: 0; transform: translateY(-50%); pointer-events: none; z-index: 10; }
        .hero-nav-btn { position: absolute; width: 46px; height: 46px; border-radius: 50%; border: none; background: rgba(34, 139, 34, 0.85); color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; pointer-events: auto; transition: all 0.3s; box-shadow: 0 4px 12px rgba(0,0,0,0.2); font-size: 18px; font-weight: bold; }
        .hero-nav-btn:hover { background: rgba(34, 139, 34, 1); transform: scale(1.1); }
        .hero-nav-btn.prev { left: 20px; }
        .hero-nav-btn.next { right: 20px; }
        /* Tablet responsive */
        @media (max-width: 991px){
            .slider-item { min-height:520px; }
            .slider-content { top:42%; padding:0 20px; }
            .slider-content h1 { font-size:54px; line-height:1.1; margin:0 0 15px; }
            .slider-content p { font-size:18px; margin-bottom:22px; }
            .hero-fixed-cta { top: calc(42% + 200px); }
            .hero-cta-btn { font-size:18px; padding:14px 34px; }
            .hero-nav-btn { width:42px; height:42px; font-size:17px; }
            .hero-nav-btn.prev { left: 15px; }
            .hero-nav-btn.next { right: 15px; }
        }
        /* Mobile responsive */
        @media (max-width: 575px){
            .slider-item { min-height:420px; }
            .slider-content { top:38%; padding:0 15px; max-width:90%; }
            .slider-content h1 { font-size:32px; line-height:1.15; margin:0 0 12px; }
            .slider-content p { font-size:14px; margin-bottom:18px; line-height:1.4; }
            .hero-fixed-cta { top: calc(38% + 200px); }
            .hero-cta-btn { padding:11px 26px; font-size:15px; border-radius:8px; }
            .hero-nav-btn { width:36px; height:36px; font-size:15px; }
            .hero-nav-btn.prev { left: 10px; }
            .hero-nav-btn.next { right: 10px; }
        }
        /* Extra small mobile */
        @media (max-width: 400px){
            .slider-item { min-height:380px; }
            .slider-content h1 { font-size:28px; }
            .slider-content p { font-size:13px; }
            .hero-cta-btn { padding:10px 22px; font-size:14px; }
        }
    </style>
        <!-- Duplicate hero CTA/navigation removed -->
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            if (typeof jQuery !== 'undefined'){
                // Wire up manual navigation buttons
                var $hero = jQuery('.hero-slider');
                var prevBtn = document.getElementById('heroPrev');
                var nextBtn = document.getElementById('heroNext');
                if(prevBtn){ prevBtn.addEventListener('click', function(){ $hero.trigger('prev.owl.carousel'); }); }
                if(nextBtn){ nextBtn.addEventListener('click', function(){ $hero.trigger('next.owl.carousel'); }); }
            }
        });
    </script>

    <!-- Solar Panel Installation Section -->
    <div class="solar-installation-area" style="background-color: #ffffff; padding: 60px 0;">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center mb-5">
                <h2 style="font-size: 48px; color: #3e9d4f; font-weight: bold; margin-bottom: 40px;">
                    SOLAR PANEL INSTALLATION IS FOR EVERYONE
                </h2>
            </div>

            <!-- Main Images Row -->
            <div class="row mb-4">
                <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-right" data-aos-duration="1000">
                    <div class="installation-card" style="position: relative; overflow: hidden; border-radius: 8px;">
                        <img src="<?php echo e(asset('setting/homepage/residential-solar.png')); ?>" alt="Residential Solar Installation"
                             style="width: 100%; height: 400px; object-fit: cover; display: block;">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(186, 124, 26, 0.95), rgba(186, 124, 26, 0.8)); padding: 20px; text-align: center;">
                            <h3 style="color: #ffffff; font-size: 32px; font-weight: bold; margin: 0;">Residential</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-left" data-aos-duration="1000">
                    <div class="installation-card" style="position: relative; overflow: hidden; border-radius: 8px;">
                        <img src="<?php echo e(asset('setting/homepage/commercial-solar.jpg')); ?>" alt="Commercial Solar Installation"
                             style="width: 100%; height: 400px; object-fit: cover; display: block;">
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(186, 124, 26, 0.95), rgba(186, 124, 26, 0.8)); padding: 20px; text-align: center;">
                            <h3 style="color: #ffffff; font-size: 32px; font-weight: bold; margin: 0;">Commercial</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Buttons Row -->
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="100">
                    <a href="#" class="category-btn" style="display: block; background-color: #ba7c1a; color: #ffffff; text-align: center; padding: 20px 15px; border-radius: 5px; text-decoration: none; font-size: 20px; font-weight: bold; transition: all 0.3s ease;">
                        Schools
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="200">
                    <a href="#" class="category-btn" style="display: block; background-color: #ba7c1a; color: #ffffff; text-align: center; padding: 20px 15px; border-radius: 5px; text-decoration: none; font-size: 20px; font-weight: bold; transition: all 0.3s ease;">
                        Agriculture
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="300">
                    <a href="#" class="category-btn" style="display: block; background-color: #ba7c1a; color: #ffffff; text-align: center; padding: 20px 15px; border-radius: 5px; text-decoration: none; font-size: 20px; font-weight: bold; transition: all 0.3s ease;">
                        Institutions
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="400">
                    <a href="#" class="category-btn" style="display: block; background-color: #ba7c1a; color: #ffffff; text-align: center; padding: 20px 15px; border-radius: 5px; text-decoration: none; font-size: 20px; font-weight: bold; transition: all 0.3s ease;">
                        Government
                    </a>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="500">
                    <a href="#" class="category-btn" style="display: block; background-color: #ba7c1a; color: #ffffff; text-align: center; padding: 20px 15px; border-radius: 5px; text-decoration: none; font-size: 20px; font-weight: bold; transition: all 0.3s ease;">
                        Utility
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .category-btn:hover {
            background-color: #9a6515 !important;
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(186, 124, 26, 0.4);
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

    <div class="campus-information-area " style="background-color: #063f8a21;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-duration="1300"
                    data-aos-once="true">
                    <div class="campus-content pr-20">
                        <div class="campus-title">
                            <h2 style="font-size:50px; color:#000000;">About Us</h2>
                            <hr>

                            <p><?php echo e($about->short_description); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-easing="ease-in-sine" data-aos-duration="1300"
                    data-aos-once="true">
                    <div class="campus-image pl-20">
                        <img src="<?php echo e(asset('/setting/about/' . $about->about_image)); ?>" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="features-section" style="background-color: #F2F7FB; width: 100%;">

     <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 23px; padding: 50px 20px; max-width: 1200px; margin: auto;">

    <!-- Feature 1 -->
    <div class="feature-item" style="flex: 1 1 calc(25% - 20px); text-align: center; min-width: 220px;">
        <img src="<?php echo e(asset('setting/brand/hybrid.png')); ?>" alt="Quick & Reliable" style="width: 100px; height: auto; margin-bottom: 30px;margin-top: 10px;">
        <h3 class="feature-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;"> Reliable</h3>
        <p class="feature-text" style="font-size: 14px; color: #555; text-align: justify; text-justify: inter-word; hyphens: auto; line-height: 1.6; margin: 0 10px;">Our service is fully customer-centric and focused on bringing the best dazzle and shine on the face and smile of satisfaction on your face.</p>
    </div>


    <!-- Feature 2 -->
    <div class="feature-item" style="flex: 1 1 calc(25% - 20px); text-align: center; min-width: 220px;">
        <img src="<?php echo e(asset('setting/brand/best_price.jpg')); ?>" alt="Affordable Price" style="width: 100px; height: auto; margin-bottom: 15px;">
        <h3 class="feature-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Affordable Price</h3>
        <p class="feature-text" style="font-size: 14px; color: #555; text-align: justify; text-justify: inter-word; hyphens: auto; line-height: 1.6; margin: 0 10px;">Affordability and quality are always on top of our agenda with customers convenience given top priority.</p>
    </div>

    <!-- Feature 3 -->
    <div class="feature-item" style="flex: 1 1 calc(25% - 20px); text-align: center; min-width: 220px;">
        <img src="<?php echo e(asset('setting/brand/quality.png')); ?>" alt="High Quality Service" style="width: 100px; height: auto; margin-bottom: 15px;">
        <h3 class="feature-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">High Quality Service</h3>
        <p class="feature-text" style="font-size: 14px; color: #555; text-align: justify; text-justify: inter-word; hyphens: auto; line-height: 1.6; margin: 0 10px;">Premium quality eco-friendly solar panels are used for achieving maximun efficiency.</p>
    </div>

    <!-- Feature 4 -->
    <div class="feature-item" style="flex: 1 1 calc(25% - 20px); text-align: center; min-width: 220px;">
        <img src="<?php echo e(asset('setting/brand/eco.jpg')); ?>" alt="Eco Friendly" style="width: 100px; height: auto; margin-bottom: 15px;">
        <h3 class="feature-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Green Energy</h3>
        <p class="feature-text" style="font-size: 14px; color: #555; text-align: justify; text-justify: inter-word; hyphens: auto; line-height: 1.6; margin: 0 10px;">
            We are committed to promoting sustainable and eco-friendly energy solutions for a greener future.
        </p>
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
    background: linear-gradient(135deg, #cad1439b 0%, #4ba278 100%);
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
    background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    animation: borderRotate 3s linear infinite;
}
@keyframes  borderRotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.modern-counter-card.orange .modern-counter-icon {
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
}
.modern-counter-card.green .modern-counter-icon {
    background: linear-gradient(135deg, #26de81, #20bf6b);
}
.modern-counter-card.blue .modern-counter-icon {
    background: linear-gradient(135deg, #4bcffa, #1e90ff);
}
.modern-counter-card.purple .modern-counter-icon {
    background: linear-gradient(135deg, #a29bfe, #6c5ce7);
}
.modern-counter-title {
    font-size: 20px;
    font-weight: 700;
    color: #2d3436;
    margin: 0 0 15px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.modern-counter-value {
    font-size: 48px;
    font-weight: 800;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    display: inline-block;
}
.modern-counter-plus {
    font-size: 32px;
    font-weight: 700;
    color: #764ba2;
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
                        <img src="<?php echo e(asset('setting/banner/done.jpg')); ?>" alt="Projects Done">
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
                        <img src="<?php echo e(asset('setting/banner/staf.png')); ?>" alt="Our Staff">
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
                        <img src="<?php echo e(asset('setting/banner/trust.jpg')); ?>" alt="Trusted Clients">
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
                        <img src="<?php echo e(asset('setting/banner/satisfied.jpg')); ?>" alt="Satisfied Clients">
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
        .services-section .section-title h2:after {content:''; width:450px; height:4px; background:#2D6DB0; position:absolute; left:0; bottom:-15px; border-radius:3px;}
        .service-card {position:relative; border-radius:20px; overflow:hidden; background:#fff; box-shadow:0 10px 30px rgba(0,0,0,.08); transition:transform .5s cubic-bezier(.19,1,.22,1), box-shadow .5s, border .3s; border:3px solid transparent;}
        .service-card:hover {transform:translateY(-8px); box-shadow:0 15px 35px rgba(0,0,0,.15); border-color:#ff8c00;}
        .service-card img {width:100%; height:320px; object-fit:cover; display:block; filter:brightness(.9); transition:filter .3s ease, border-radius .3s; border-radius:20px 20px 0 0;}
        .service-card:hover img {filter:brightness(.3); border-radius:20px;}
        .service-info {padding:22px 28px 35px;}
        .service-info h3 {font-size:24px; font-weight:600; margin:0; color:#17354f;}
        .service-badge {position:absolute; top:18px; left:18px; background:rgba(45,109,176,.9); color:#fff; padding:6px 14px; font-size:14px; border-radius:30px; letter-spacing:.5px; font-weight:600; box-shadow:0 4px 12px rgba(0,0,0,.25);}
        .service-overlay {position:absolute; inset:0; background:linear-gradient(180deg, rgba(23,53,79,0) 0%, rgba(23,53,79,.85) 75%); display:flex; flex-direction:column; justify-content:flex-end; padding:28px; opacity:0; transition:opacity .45s ease; color:#fff;}
        .service-card:hover .service-overlay {opacity:1;}
        .service-overlay .details {max-height:160px; overflow:auto; scrollbar-width:thin; color:#ffffff; font-size:15px;}
        .service-overlay .details p {color:#ffffff !important;}
        .service-overlay .details::-webkit-scrollbar {width:6px;}
        .service-overlay .details::-webkit-scrollbar-track {background:rgba(146, 22, 22, 0.15); border-radius:10px;}
        .service-overlay .details::-webkit-scrollbar-thumb {background:#2D6DB0; border-radius:10px;}
        .service-actions {margin-top:16px;}
        .service-actions a {display:inline-block; background:#2D6DB0; color:#fff; padding:12px 24px; border-radius:30px; font-size:15px; font-weight:600; text-decoration:none; letter-spacing:.5px; transition:background .3s;}
        .service-actions a:hover {background:#184b7a;}
        /* Mobile tap: show overlay when active */
        @media (hover:none) { .service-overlay {opacity:1; background:linear-gradient(180deg, rgba(23,53,79,.25) 0%, rgba(23,53,79,.92) 70%);} .service-info {padding-bottom:20px;} }
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
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="service-flex-item" style="flex:0 0 calc(33.333% - 16px);" data-aos="fade-up" data-aos-duration="900">
                            <div class="service-card">
                                <span class="service-badge">Service</span>
                                <img src="<?php echo e(asset('/setting/service/' . $service->image1)); ?>" alt="<?php echo e($service->title); ?>" loading="lazy">
                                <div class="service-info">
                                    <h3><?php echo e($service->title); ?></h3>
                                </div>
                                <div class="service-overlay">
                                    <div class="details"><?php echo $service->details1; ?></div>
                                    <div class="service-actions"><a href="<?php echo e(route('service.show', $service->id)); ?>">See More</a></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="services-controls text-center mt-4">
                <div class="svc-dots mb-3">
                    <?php $serviceCount = $services->count(); ?>
                    <?php for($i = 0; $i < max(0,$serviceCount-2); $i++): ?>
                        <button type="button" class="svc-dot <?php echo e($i===0 ? 'active' : ''); ?>" data-index="<?php echo e($i); ?>" aria-label="Slide <?php echo e($i+1); ?>"></button>
                    <?php endfor; ?>
                </div>
                <a href="/service" class="btn btn-outline-secondary px-4 py-2" style="border-radius:30px; font-weight:600;">See All Services</a>
                <div class="small mt-2" style="color:#555;"> </div>
            </div>
        </div>
    </div>
    <style>
        .svc-dot {width:14px; height:14px; border-radius:50%; border:none; background:#2D6DB0; opacity:.35; margin:0 6px; transition:.3s; cursor:pointer;}
        .svc-dot.active {opacity:1; transform:scale(1.15);} .svc-dot:hover {opacity:.75;}
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


<div id="brandsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="false"
     style="width: 100%; padding: 60px 20px; background: #09622333;"> <!-- light skyish background -->

    <!-- Section Title -->
    <h2 style="text-align: center; margin-bottom: 40px; font-weight: 800; font-size: 2.2rem; ">
        Our Partners
        <span style="display: block; width: 80px; height: 5px; background: #2D6DB0; margin: 10px auto 0; border-radius: 3px;"></span>
    </h2>

    <!-- Slides -->
    <div class="carousel-inner">
        <?php $__currentLoopData = $brands->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                <div class="row justify-content-center">
                    <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-sm-4 col-md-3 mb-4 text-center">
                            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 15px; border-radius: 12px; background: #ffffffaa;">
                                <?php if($brand->logo): ?>
                                    <img src="<?php echo e(asset('/setting/brand/' . $brand->logo)); ?>"
                                         alt="<?php echo e($brand->name); ?>"
                                         style="max-height: 80px; max-width: 100%; object-fit: contain; margin-bottom: 10px;">
                                <?php else: ?>
                                    <p style="font-size: 12px; color:#2D6DB0;"><em>No logo</em></p>
                                <?php endif; ?>
                                <h6 style="font-size: 15px; font-weight: 600; color: #333; margin:0;">
                                    <?php echo e($brand->title ?? $brand->name); ?>

                                </h6>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Navigation Buttons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#brandsCarousel" data-bs-slide="prev"
        style="top: 50%; transform: translateY(-50%); left: 15px; width: 40px; height: 40px; border-radius: 50%; background: #ffffff55; border: none;"></button>

    <button class="carousel-control-next" type="button" data-bs-target="#brandsCarousel" data-bs-slide="next"
        style="top: 50%; transform: translateY(-50%); right: 15px; width: 40px; height: 40px; border-radius: 50%; background: #ffffff55; border: none;"></button>

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
                        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $ids = [
                                    'collapseOne','collapseTwo','collapseThree',
                                    'collapseFour','collapseFive','collapseSix','collapseSeven'
                                ];
                                $i = $ids[$key] ?? 'collapse'.$key;
                            ?>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#<?php echo e($i); ?>" aria-expanded="false"
                                        aria-controls="<?php echo e($i); ?>">
                                        <?php echo e($faq->question ?? 'FAQ'); ?>

                                    </button>
                                </div>
                                <div id="<?php echo e($i); ?>" class="collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo e($faq->answer ?? 'N/A'); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

<!-- Right side: Static image -->
<div class="col-lg-4 d-flex justify-content-center align-items-start">
    <div class="faq-img text-center p-4 shadow-lg rounded-4"
         style="background:#ffffff; min-height: 500px; display:flex; flex-direction:column; justify-content:center; align-items:center;">

       <img src="<?php echo e(asset('setting/brand/8ed0971d-71d2-4acf-bd05-8e9e76418d2c.png')); ?>"
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
            .single-news-card:hover {border-color:#ff8c00; box-shadow:0 14px 34px -10px rgba(0,0,0,.25); transform:translateY(-6px); background:#ffffff;}
            .single-news-card .read-more-btn {display:inline-block; margin-top:8px; font-weight:600;}
            .single-news-card .read-more-btn i {margin-left:6px;}
            /* Dark theme */
            .theme-dark .single-news-card {background:#1f2937; box-shadow:0 8px 22px -8px rgba(0,0,0,.6);}
            .theme-dark .single-news-card:hover {background:#1f2937; border-color:#ff8c00;}
        </style>
        <div class="row justify-content-center">
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200"
                    data-aos-once="true">
                    <div class="single-news-card">
                        <div class="news-img">
                            <a href="/blog/details/<?php echo e($blog->id); ?>">
                                <img src="<?php echo e(asset('/setting/blog/' . $blog->image1)); ?>" alt="Image">
                            </a>
                        </div>
                        <div class="news-content">
                            <div class="list">
                                <ul>
                                    <li><i class="flaticon-user"></i>
                                        By <a href="/blog/details/<?php echo e($blog->id); ?>" style="text-decoration: none; color: #000;">Admin</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="/blog/details/<?php echo e($blog->id); ?>" style="text-decoration: none; color: #000;">
                                <h3><?php echo e($blog->short_details); ?></h3>
                            </a>
                            <a href="/blog/details/<?php echo e($blog->id); ?>" class="read-more-btn" style="text-decoration: none; color: #000;">
                                Read More<i class="flaticon-next"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="more-latest-news text-center">
            <a href="/blogs" class="read-more-btn active" style="text-decoration: none; color: #000;">
                More on Blogs<i class="flaticon-next"></i>
            </a>
        </div>
    </div>
</div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Solartech_Services_Foundation\resources\views/frontend/index.blade.php ENDPATH**/ ?>