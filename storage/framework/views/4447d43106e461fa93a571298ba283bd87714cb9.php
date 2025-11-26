 <?php
    $services = DB::table('services')->where('is_active', 1)->get();
?>

<style>

.modern-footer {background:linear-gradient(0deg, #b8c245 0%, #007e41 100%); color:#e5e7eb; padding:80px 0 0;}
.footer-grid {display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:50px; margin-bottom:50px;}
.footer-col h3 {font-size:22px; font-weight:700; margin:0 0 24px; color:#fff; position:relative; padding-bottom:12px;}
.footer-col h3:after {content:''; position:absolute; left:0; bottom:0; width:60px; height:3px; background:#ff8c00; border-radius:3px;}
.footer-logo-section img {height:70px; margin-bottom:18px; filter:brightness(1.1);}
.footer-logo-section p {font-size:15px; line-height:1.65; color:#d1d5db; margin:0;}
.footer-services-list {list-style:none; margin:0; padding:0;}
.footer-services-list li {margin-bottom:12px;}
.footer-services-list li a {color:#d1d5db; text-decoration:none; font-size:15px; transition:.3s; display:inline-flex; align-items:center;}
.footer-services-list li a:before {content:'▸'; margin-right:8px; color:#ff8c00; font-weight:700;}
.footer-services-list li a:hover {color:#ff8c00; transform:translateX(4px);}
.footer-contact-item {display:flex; align-items:flex-start; gap:14px; margin-bottom:18px;}
.footer-contact-item i {color:#ff8c00; font-size:20px; margin-top:2px;}
.footer-contact-item .contact-text {font-size:15px; line-height:1.6; color:#d1d5db;}
.footer-contact-item a {color:#d1d5db; text-decoration:none; transition:.3s;}
.footer-contact-item a:hover {color:#ff8c00;}
.footer-map-container {border-radius:12px; overflow:hidden; box-shadow:0 8px 24px -8px rgba(0,0,0,.4); margin-top:20px;}
.footer-map-container iframe {width:100%; height:240px; display:block; border:none;}
.footer-social-section {text-align:center; padding:30px 0; border-top:1px solid rgba(255,255,255,.1);}
.footer-social-label {font-size:16px; font-weight:600; color:#fff; margin-bottom:18px;}
.footer-social-links {display:flex; justify-content:center; gap:14px; flex-wrap:wrap;}
.footer-social-links a {display:inline-flex; align-items:center; justify-content:center; width:46px; height:46px; border-radius:50%; background:#ffffff; color:#007e41; font-size:20px; border:2px solid transparent; transition:.35s; box-shadow:0 4px 12px rgba(0,0,0,.2);}
.footer-social-links a:hover {background:#ff8c00; color:#fff; border-color:#fff; transform:translateY(-4px); box-shadow:0 8px 20px rgba(255,140,0,.5);}
.footer-bottom {background:rgba(0,0,0,.3); padding:24px 0; text-align:center; border-top:1px solid rgba(255,255,255,.1);}
.footer-bottom p {margin:0; font-size:15px; color:#d1d5db;}
.footer-bottom a {color:#ff8c00; text-decoration:none; font-weight:600; transition:.3s;}
.footer-bottom a:hover {color:#ffa438; text-decoration:underline;}
@media (max-width: 991px){.footer-grid {gap:40px;}}
@media (max-width: 575px){.modern-footer {padding:60px 0 0;} .footer-grid {gap:35px;} .footer-col h3 {font-size:20px;}}
</style>

<footer class="modern-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Company Info -->
            <div class="footer-col">
                <div class="footer-logo-section">
                    <img src="<?php echo e(asset(get_setting('frontend_logo_footer'))); ?>" alt="Solartech Services Logo">
                    <p><?php echo e(get_setting('footer_description')); ?></p>
                </div>
            </div>

            <!-- Our Services -->
            <div class="footer-col">
                <h3>Our Services</h3>
                <ul class="footer-services-list">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a href="/service/<?php echo e($service->id); ?>"><?php echo e($service->title); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-col">
                <h3>Contact Us</h3>
                <div class="footer-contact-item">
                    <i class="ri-map-pin-line"></i>
                    <div class="contact-text"><?php echo e(get_setting('office_address')); ?></div>
                </div>
                <div class="footer-contact-item">
                    <i class="ri-phone-line"></i>
                    <div class="contact-text">
                        <a href="tel:<?php echo e(get_setting('office_phone')); ?>"><?php echo e(get_setting('office_phone')); ?></a>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="ri-mail-line"></i>
                    <div class="contact-text">
                        <a href="mailto:<?php echo e(get_setting('office_email')); ?>"><?php echo e(get_setting('office_email')); ?></a>
                    </div>
                </div>
            </div>

            <!-- Google Map -->
            <div class="footer-col">
                <h3>Find Us</h3>
                <div class="footer-map-container">
                    <?php
                        $mapUrl = 'https://maps.google.com/maps?q=' . urlencode(get_setting('office_address')) . '&t=&z=13&ie=UTF8&iwloc=&output=embed';
                    ?>
                    <iframe src="<?php echo e($mapUrl); ?>" loading="lazy"></iframe>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="footer-social-section">
            <div class="footer-social-label">Follow Us On</div>
            <div class="footer-social-links">
                <a href="<?php echo e(get_setting('facebook')); ?>" target="_blank" aria-label="Facebook"><i class="ri-facebook-fill"></i></a>
                <a href="<?php echo e(get_setting('twitter')); ?>" target="_blank" aria-label="Twitter"><i class="ri-twitter-fill"></i></a>
                <a href="<?php echo e(get_setting('instagram')); ?>" target="_blank" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                <a href="<?php echo e(get_setting('linkedin')); ?>" target="_blank" aria-label="LinkedIn"><i class="ri-linkedin-fill"></i></a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-bottom">
        <div class="container">
            <p>
                © <?php echo e(get_setting('copyright_text')); ?> |
                <a href="https://www.techwebdit.com" target="_blank">Developed by Techweb BD IT</a>
            </p>
        </div>
    </div>
</footer>



<div class="go-top">
     <i class="ri-arrow-up-s-line"></i>
     <i class="ri-arrow-up-s-line"></i>
 </div>

<?php /**PATH C:\laragon\www\Solartech_Services_Foundation\resources\views/frontend/layouts/footer.blade.php ENDPATH**/ ?>