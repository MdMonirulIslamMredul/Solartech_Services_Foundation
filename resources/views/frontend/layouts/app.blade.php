<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from demo.xpeedstudio.com/html/charitypress/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jan 2023 07:49:13 GMT -->
{{-- new design for footer and header --}}

<head>
    <meta charset="utf-8">
    <title>{{ app_name() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', app_name())">
    <meta name="keywords"
        content="Education Consultants, USA Study Visa, Study Visa, Study Abroad Consultants, Study Visa For USA, Study in USA, Grace Education, " />
    <link rel="canonical" href="index.html">
    @yield('meta')
    <!-- responsive tag -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(get_setting('favicon')) }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(get_setting('favicon')) }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(get_setting('favicon')) }}">
    <link rel="manifest" href="{{ asset(get_setting('favicon')) }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Bootstrap v4.4.1 css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/meanmenu.css') }}">
    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <!-- flaticon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- owl.carousel css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flaticon.css') }}">
    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/remixicon.css') }}">
    <!-- off canvas css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/odometer.min.css') }}">
    <!-- magnific popup css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/aos.css') }}">
    <!-- Main Menu css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- spacing css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dark.css') }}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- This stylesheet dynamically changed from style.less -->

    <!-- Smart Bangla Cleaning Services Theme Tokens -->
    <style>
        :root {
            /* Brand Color Palette from Logo */
            --sb-primary-navy: rgb(27, 58, 107);     /* Header & Main Primary Navy */
            --sb-primary-dark: rgb(20, 44, 82);       /* Darker Navy Base */
            --sb-accent-cyan: #29A9E0;                /* Vivid Aqua Cyan Accent */
            --sb-accent-hover: #1F8FC2;               /* Hover Aqua Cyan */
            --sb-accent-light: #EBF7FC;               /* Soft Ice Blue Tint */
            --sb-bg-light: #F8FAFC;                   /* Clean Light Background */
            --sb-text-dark: #0F172A;                  /* High Contrast Text */
            --sb-text-muted: #64748B;                 /* Muted Text */

            /* Legacy variable overrides to seamlessly update all components */
            --nt-primary: #F8FAFC;
            --nt-secondary: rgb(27, 58, 107);
            --nt-accent: #29A9E0;
            --nt-dark: #0F172A;
            --nt-surface: #FFFFFF;
            --nt-border: #E2E8F0;
            --nt-text-muted: #64748B;
            --nt-text-on-dark: #FFFFFF;
            --nt-accent-10: rgba(41, 169, 224, 0.12);
            --nt-accent-25: rgba(41, 169, 224, 0.25);
            --nt-primary-50: #F8FAFC;
        }
    </style>

    @php
        $phone = get_setting('office_phone');
    @endphp

    <meta name="google-site-verification" content="W0apjtnnwb19hnHEXcsi6wq3R6GgJpFbAGQjakbqKBc" />



    <!-- WhatsApp Floating Chat -->
    <div class="whatsapp-wrapper">
        <div id="whatsapp-popup">
            <p class="m-0">👋 Hi there! Need help? <br> Chat with us on WhatsApp.</p>
        </div>
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone) }}" target="_blank" id="whatsapp-chat-btn">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="Chat on WhatsApp">
        </a>
    </div>

    <style>
        .whatsapp-wrapper {
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 9999;
        }

        /* Floating Button */
        #whatsapp-chat-btn {
            position: relative;
            background: #25D366;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        #whatsapp-chat-btn img {
            width: 35px;
            height: 35px;
        }

        #whatsapp-chat-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        /* Popup Message (Hidden by default, shown on hover) */
        #whatsapp-popup {
            position: absolute;
            bottom: 72px;
            right: 0;
            background: #fff;
            color: #333;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 220px;
            border-left: 4px solid #25D366;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .whatsapp-wrapper:hover #whatsapp-popup {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: auto;
        }
    </style>



</head>


<body>


    @include('frontend.layouts.header')
    @yield('content')
    @include('frontend.layouts.footer')

    <script data-cfasync="false" src="{{ asset('assets/js/email-decode.min.js') }}"></script>

    <!-- modernizr js -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!-- jquery latest version -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Bootstrap v4.4.1 js -->
    <script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
    <!-- Menu js -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- op nav js -->
    <script src="{{ asset('assets/js/carousel-thumbs.min.js') }}"></script>
    <!-- owl.carousel js -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.js') }}"></script>
    <!-- wow js -->
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <!-- Skill bar js -->
    <script src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/js/appear.min.js') }}"></script>
    <!-- counter top js -->
    <script src="{{ asset('assets/js/form-validator.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('assets/js/contact-form-script.js') }}"></script>
    <!-- particles js -->
    <script src="{{ asset('assets/js/ajaxchimp.min.js') }}"></script>
    <!-- magnific popup js -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>


<!-- Mirrored from demo.xpeedstudio.com/html/charitypress/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Jan 2023 07:49:19 GMT -->

</html>
