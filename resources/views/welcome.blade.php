<x-app-layout title="{{ __('Home') }}">
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">{{ __('Two Kids Are Better') }}</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">{{ __('Lets Join the Family Planning Program to Become a Better Family') }}</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="{{ route('register') }}"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>{{ __('Sign up now') }}</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('dist/img/banner2.png') }}" class="img-fluid" alt="" style="border-bottom-left-radius: 40%; border-bottom-right-radius: 40%;">
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->


    <main id="main">
        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>{{ __('About Us') }}</h2>
                    <p>Bidan Nurhamilah</p>
                </header>
                <!-- Feature Tabs -->
                <div class="row feture-tabs" data-aos="fade-up">
                    <div class="col-lg-6">
                        <h3>{{ __('Midwife Nurhalimah is a private practice midwife in Karawang') }}</h3>

                        <!-- Tabs -->
                        <ul class="nav nav-pills mb-3">
                            <li>
                                <a class="nav-link active" data-bs-toggle="pill" href="#tab1">{{ __('a brief description') }}</a>
                            </li>
                            <li>
                                <a class="nav-link" data-bs-toggle="pill" href="#tab2">{{ __('VISION') }}</a>
                            </li>
                            <li>
                                <a class="nav-link" data-bs-toggle="pill" href="#tab3">{{ __('MISSION') }}</a>
                            </li>
                        </ul><!-- End Tabs -->

                        <!-- Tab Content -->
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab1">
                                <p>{{ __('Midwife Nurhalimah is one of the independent practicing midwives in the Karawang district, Klari district, Cimahi village.') }}</p>
                                <p>{{ __('The midwife practice Nurhalimah has been established for about 2 years, which aims to serve the community, especially mothers and babies in pregnancy, childbirth and family planning (KB) programs.') }}</p>
                            </div><!-- End Tab 1 Content -->
                            <div class="tab-pane fade show" id="tab2">
                                <p>
                                    {{ __('Midwife Nurhalimah practice as a place for Public Health and Midwifery services which:') }}
                                </p>
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-check2"></i>
                                    <h4>{{ __('Safe') }}</h4>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-check2"></i>
                                    <h4>{{ __('Professional') }}</h4>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-check2"></i>
                                    <h4>{{ __('Superior in service quality') }}</h4>
                                </div>
                            </div><!-- End Tab 2 Content -->

                            <div class="tab-pane fade show" id="tab3">
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-check2"></i>
                                    <h4>{{ __('Carry out community service and approach') }}</h4>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-check2"></i>
                                    <h4>{{ __('Carry out Midwifery service activities, especially for mothers and children') }}</h4>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-check2"></i>
                                    <h4>{{ __('Carry out coaching and counseling (PUS and WUS) related to Midwifery') }}</h4>
                                </div>
                                <div class="d-flex align-items-center mb-4">
                                    <i class="bi bi-check2"></i>
                                    <h4>{{ __('Develop NKKBS and emphasis on maternal and infant mortality') }}</h4>
                                </div>
                            </div><!-- End Tab 3 Content -->

                        </div>

                    </div>

                    <div class="col-lg-6">
                        <img src="{{ asset('dist/img/features-2.png') }}" class="img-fluid" alt="">
                    </div>

                </div>
            </div>
        </section>
        <!-- End Features Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>{{ __('Services') }}</h2>
                    <p>{{ __('Services provided by Midwife Nurhalimah') }}</p>
                </header>
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-box blue">
                            <i class="ri-discuss-line icon"></i>
                            <h3>{{ __('Apotek') }}</h3>
                            <p>{{ __('An Nur Pharmacy is one of the services available at the midwife nurhalimah, the pharmacy provides various kinds of medicines for the community.') }}
                            </p>
                            {{-- <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-box orange">
                            <i class="ri-discuss-line icon"></i>
                            <h3>{{ __('Consultation') }}</h3>
                            <p>{{ __('Midwife Nurhalimah handles consulting services for planning pregnancy, childbirth, maternal and child health.') }}
                            </p>
                            {{-- <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a> --}}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-box green">
                            <i class="ri-discuss-line icon"></i>
                            <h3>{{ __('Childbirth') }}</h3>
                            <p>{{ __('In addition to a pharmacy and consultation, Midwife Nurhalimah also provides services for deliveries with good delivery room facilities.') }}
                            </p>
                            {{-- <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a> --}}
                        </div>
                    </div>
                    {{-- <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-box red">
                            <i class="ri-discuss-line icon"></i>
                            <h3>Asperiores Commodi</h3>
                            <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga
                                sit provident adipisci neque.
                            </p>
                            <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-box purple">
                            <i class="ri-discuss-line icon"></i>
                            <h3>Velit Doloremque.</h3>
                            <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed
                                animi at autem alias eius labore.
                            </p>
                            <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
                        <div class="service-box pink">
                            <i class="ri-discuss-line icon"></i>
                            <h3>Dolori Architecto</h3>
                            <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure.
                                Corrupti recusandae ducimus enim.
                            </p>
                            <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- End Services Section -->


        <!-- ======= F.A.Q Section ======= -->
        @if(count($faqs) > 0)
        <section id="faq" class="faq">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>F.A.Q</h2>
                    <p>Frequently Asked Questions</p>
                </header>
                <div class="row">
                    @if(count($faqs) >= 2)
                    <div class="col-lg-6">
                        <!-- F.A.Q List 1-->
                        <div class="accordion accordion-flush" id="faqlist1">
                            @foreach ($faqs[0] as $key => $first) 
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-{{ $first['id'] }}">
                                        {{ $first['title'] }}
                                    </button>
                                </h2>
                                <div id="faq-content-{{ $first['id'] }}" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                    <div class="accordion-body">
                                        {!! $first['description'] !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- F.A.Q List 2-->
                        <div class="accordion accordion-flush" id="faqlist2">
                            @foreach ($faqs[1] as $key => $second) 
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"data-bs-target="#faq2-content-{{ $second['id'] }}">
                                        {{ $second['title'] }}
                                    </button>
                                </h2>
                                <div id="faq2-content-{{ $second['id'] }}" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        {!! $second['description'] !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="col-lg-12">
                        <div class="accordion accordion-flush" id="faqlist2">
                            @foreach ($faqs as $single) 
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"data-bs-target="#faq2-content-{{ $single->id }}">
                                        {{ $single->title }}
                                    </button>
                                </h2>
                                <div id="faq2-content-{{ $single->id }}" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                    <div class="accordion-body">
                                        {!! $single->description !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- End F.A.Q Section -->
        @endif

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>{{ __('Gallery') }}</h2>
                    <p>{{ __('Check our latest work') }}</p>
                </header>
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">{{ __('All') }}</li>
                            @foreach ($categories as $category)
                            <li data-filter=".filter-{{ $category->slug }}">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($galleries as $gallery)
                    <div class="col-lg-3 col-md-6 portfolio-item filter-{{ $gallery->category->slug }}">
                        <div class="portfolio-wrap">
                            <img src="{{ $gallery->image }}" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4>{{ $gallery->title }}</h4>
                                <p>{{ $gallery->category->name }}</p>
                                <div class="portfolio-links">
                                    <a href="{{ $gallery->image }}" data-gallery="portfolioGallery" class="portfokio-lightbox" title="{{ $gallery->title }}"><i class="bi bi-plus"></i></a>
                                    {{-- <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{-- <div class="col-lg-12 mt-4 d-flex justify-content-end">
                    {{ $galleries->links() }}
                </div> --}}
            </div>
        </section>
        <!-- End Portfolio Section -->
    
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>{{ __('Contact') }}</h2>
                    <p>{{ __('Contact Us') }}</p>
                </header>
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-geo-alt"></i>
                            <h3>{{ __('Address') }}</h3>
                            <p>{{ $site->address }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-telephone"></i>
                            <h3>{{ __('Call Us') }}</h3>
                            <p>{{ $site->telp }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-envelope"></i>
                            <h3>{{ __('Email Us') }}</h3>
                            <p>{{ $site->email }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-clock"></i>
                            <h3>{{ __('Open Hours') }}</h3>
                            <p>{{ __('Monday') }} - {{ __('Saturday') }}, <strong>(08:00AM - 05:00PM)</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Section -->
    </main>
    <!-- End #main -->

</x-app-layout>
