<style>
    /* Transparent header by default */
    .navbar-area {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999;
        background-color: rgba(255, 255, 255, 0) !important;
        transition: all 0.3s ease;
    }

    /* Make header fixed and add background on scroll */
    .navbar-area.scrolled {
        position: fixed;
        /* background-color: #f1ef9b !important; */
        background: linear-gradient(181deg, #b8c2458c 0% 0%, #007e41d6 100%) !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Text color for transparent state */
    .navbar-area .navbar-nav .nav-item a {
        color: #ffffff !important;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    /* Text color when scrolled */
    .navbar-area.scrolled .navbar-nav .nav-item a {
        color: #000000 !important;
        text-shadow: none;
    }

    @media  only screen and (max-width: 991px) {
        .navbar-area {
            background-color: linear-gradient(181deg, #b8c2458c 0% 0%, #007e41d6 100%) !important;
            position: relative;
        }
        .navbar-area .navbar-nav .nav-item a {
            color: #000000 !important;
            text-shadow: none;
        }
        .rr {
            display: none !important;
        }
    }
</style>




 <div class="navbar-area nav-bg-1 pb-10">
     <div class="mobile-responsive-nav">
         <div class="container">
    <div class="mobile-responsive-menu">
        <div class="logo">
            <a href="/">
                <img src="<?php echo e(asset(get_setting('frontend_logo_menu'))); ?>" class="main-logo" alt="logo"
   >
<img src="<?php echo e(asset(get_setting('frontend_logo_menu'))); ?>" class="white-logo" alt="logo"
  ">

            </a>
        </div>
    </div>
</div>

     </div>
     <div class="desktop-nav">
         <div class="container-fluid">
             <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="/" style="margin-left: 0px;">
    <img src="<?php echo e(asset(get_setting('frontend_logo_menu'))); ?>"
         alt="logo"
         style="max-height: 50px; width: auto;">
</a>

                 <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                     <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                             <a href="/"  style="font-size:18px; padding:20px 20px; line-height:1;text-decoration:none;">
                                 Home
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="<?php echo e(route('about.index')); ?>" style="font-size:18px; padding:20px 20px; line-height:1;text-decoration:none;">
                                 About Us
                             </a>
                         </li>
                         <?php
                            //  $projects = DB::table('projects')
                            //      ->where('is_active', 1)
                            //      ->get();
                             $services = DB::table('services')
                                 ->where('is_active', 1)
                                 ->latest()->get();
                         ?>
                         




                         <li class="nav-item">
                            <a href="/service" style="font-size:18px; padding:20px 20px; line-height:1;text-decoration:none;">
                                 Services
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="/teams" style="font-size:18px; padding:20px 20px; line-height:1;text-decoration:none;">
                                 Our Team
                             </a>
                         </li>

                         <li class="nav-item">
                             <a href="/blogs" style="font-size:18px; padding:20px 20px; line-height:1;text-decoration:none;">
                                 Blog
                             </a>
                         </li>


                            


                         <li class="nav-item">
                             <a href="<?php echo e(route('gallery.index')); ?>"  style="font-size:18px; padding:20px 20px; line-height:1;text-decoration:none;">
                                 Gallery
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="/contact" style="font-size:18px; padding:20px 20px; line-height:1;text-decoration:none;">Contact Us</a>
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

 <!--Full width header End-->
<?php /**PATH C:\laragon\www\Solartech_Services_Foundation\resources\views/frontend/layouts/header.blade.php ENDPATH**/ ?>