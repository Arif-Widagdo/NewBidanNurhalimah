<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- SEO Meta Tags -->
    <meta name="description" content="Bidan Nurhalimah merupakan salah satu bidan praktek mandiri yang berada di daerah kabupaten karawang, kecamatan klari di desa cimahi." />
    <meta name="author" content="Arif Widagdo | arifwidagdo24@gmail.com" />

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="Bidan Nurhalimah" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="Bidan Nurhalimah" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="Bidan Nurhalimah merupakan salah satu bidan praktek mandiri yang berada di daerah kabupaten karawang, kecamatan klari di desa cimahi." /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="{{ asset('dist/img/logo.jpg') }}" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image" /> <!-- to have large image post format in Twitter -->

    <title>{{ $title }}</title>

    <!-- Favicons -->
    <link href="{{ asset('dist/img/logos/logo.png') }}" rel="icon">
    <link href="{{ asset('dist/img/logos/logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset('dist/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendor/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendor/remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/vendor/swiper/swiper-bundle.min.css') }}">
    <!-- Template Main CSS File -->
    <link href="{{ asset('dist/css/styleFront.css') }}" rel="stylesheet">
</head>

<body>

    @include('components.front.navbar')
    
    {{ $slot }}

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    
    @include('components.front.footer')


    <script src="{{ asset('dist/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('dist/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('dist/js/mainFront.js') }}"></script>

</body>

</html>