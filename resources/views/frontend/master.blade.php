<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registered Remit</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}"/>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    {{--    <meta name="msapplication-TileColor" content="#ffffff">--}}
    {{--    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">--}}
    {{--    <meta content="width=device-width, initial-scale=1.0" name="viewport">--}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('/css/frontend.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/icofont/icofont.min.css')}}" rel="stylesheet">
    <link href="{{asset("vendor/boxicons/css/boxicons.min.css")}}" rel="stylesheet">
    <link href="{{asset('vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/venobox/venobox.css')}}" rel="stylesheet">
    <link href='{{asset('vendor/owl.carousel/assets/owl.carousel.min.css')}}' rel="stylesheet">
    <link href="{{asset('vendor/aos/aos.css')}}" rel="stylesheet">

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="{{url('/')}}">
                Registered Remit
            </a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active">
                    <a href="{{url('/')}}">Home
                    </a>
                </li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="#contact">Contact</a></li>

            </ul>
        </nav><!-- .nav-menu -->

        <a href="{{route('login')}}" class="get-started-btn ">Login</a>

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                 data-aos="fade-up" data-aos-delay="200">
                <h1>Better & secure way to send Money</h1>
                <h2>Fast - Secure - Reliable </h2>
                <div class="d-lg-flex">
                    <a href="{{route('login')}}" class="btn-get-started" target="_blank">
                        Send Money
                    </a>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{asset('/images/hero-img.png')}}" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">

    <!-- ======= Cliens Section ======= -->
{{--    <section id="cliens" class="cliens section-bg">--}}
{{--        <div class="container">--}}

{{--            <div class="row" data-aos="zoom-in">--}}

{{--                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">--}}
{{--                    <img src="{{asset('images/clients/client-1.png')}}" class="img-fluid" alt="">--}}
{{--                </div>--}}

{{--                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">--}}
{{--                    <img src="{{asset('images/clients/client-2.png')}}" class="img-fluid" alt="">--}}
{{--                </div>--}}

{{--                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">--}}
{{--                    <img src="{{asset('images/clients/client-3.png')}}" class="img-fluid" alt="">--}}
{{--                </div>--}}

{{--                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">--}}
{{--                    <img src="{{asset('images/clients/client-4.png')}}" class="img-fluid" alt="">--}}
{{--                </div>--}}

{{--                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">--}}
{{--                    <img src="{{asset('images/clients/client-5.png')}}" class="img-fluid" alt="">--}}
{{--                </div>--}}

{{--                <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">--}}
{{--                    <img src="{{asset('images/clients/client-6.png')}}" class="img-fluid" alt="">--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </section><!-- End Cliens Section -->--}}

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>About Us</h2>
            </div>

            <div class="row content">
                <div class="col-lg-6">
                    <p>
                        We are devoted to serve Nepalese all over Nepal from Australia via our simple and systematic
                        remittance facilities. Ensuring to provide fast,cheap and reliable service is our foremost
                        purpose. Our
                        vision is to provide remittance facility globally. Our customers are important to us. We will be
                        taking care
                        of your loved ones by delivering remittances safely.
                    </p>
                    <ul>
                        <li><i class="ri-check-double-line"></i> we are registered in AUSTRAC</li>
                    </ul>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <p>
                        An Australia based Money transfer Company with, more than thousands corporate and individual
                        clients depends on Registered Remit for their best services to handle their millions of dollars
                        in
                        foreign currency transactions every year in an international Market.
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                    <div class="content">
                        <h3>Why <strong> Us ?</strong></h3>
                        <p>
                            Registered Remit makes it easier to send and receive money. Send your money, not your information.
                            We respect your privacy.
                        </p>
                    </div>

                    <div class="accordion-list">
                        <ul>
                            <li>
                                <a data-toggle="collapse"
                                   class="collapse" href="#accordion-list-1">
                                    <span>01</span>
                                    Low fees & excellent rates
                                    <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-1" class="collapse show" data-parent=".accordion-list">
                                    <p>

                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#accordion-list-2" class="collapsed">
                                    <span>02</span>
                                    Fast and easy to send Money <i
                                        class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-2" class="collapse" data-parent=".accordion-list">
{{--                                    <p>--}}
{{--                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id--}}
{{--                                        interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus--}}
{{--                                        scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.--}}
{{--                                        Mauris ultrices eros in cursus turpis massa tincidunt dui.--}}
{{--                                    </p>--}}
                                </div>
                            </li>

{{--                            <li>--}}
{{--                                <a data-toggle="collapse" href="#accordion-list-3" class="collapsed">--}}
{{--                                    <span>03</span>--}}
{{--                                    <i--}}
{{--                                        class="bx bx-chevron-down icon-show"></i><i--}}
{{--                                        class="bx bx-chevron-up icon-close"></i></a>--}}
{{--                                <div id="accordion-list-3" class="collapse" data-parent=".accordion-list">--}}
{{--                                    <p>--}}
{{--                                        Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci.--}}
{{--                                        Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl--}}
{{--                                        suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis--}}
{{--                                        convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis--}}
{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </li>--}}

                        </ul>
                    </div>

                </div>

                <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                     style='background-image: url("../images/why-us.png");' data-aos="zoom-in" data-aos-delay="150">
                    &nbsp;
                </div>
            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                    <img src="{{asset('images/skills.png')}}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                    <h3>Ratings By Customers</h3>
                    <p class="font-italic">
                        Overall rating by our customers.
                    </p>

                    <div class="skills-content">

                        <div class="progress">
                            <span class="skill">Reliable<i class="val">100%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="progress">
                            <span class="skill">FAST <i class="val">95%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="progress">
                            <span class="skill">SECURE <i class="val">100%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="progress">
                            <span class="skill">Guaranteed<i class="val">100%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Services</h2>
                <p>Registered Remit makes it easier to send and receive money wherever you are. Send your money, not your information.
                    Registered Remit makes sure your personal details are always protected.</p>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class="icofont-ssl-security"></i></div>
                        <h4><a href="">Secure Transactions</a></h4>
                        <p>Your payment details fully protected and encrypted by 256-Bit SSL Security.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                     data-aos-delay="200">
                    <div class="icon-box">
                        <div class="icon"><i class="icofont-email"></i></div>
                        <h4><a href="">Email notifications</a></h4>
                        <p>
                            You can turn on notifications to receive alerts on your phone or computer when you send a money
                        </p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
                     data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="icofont-settings-alt"></i></div>
                        <h4><a href="">100% money back guarantee</a></h4>
                        <p>All transactions are protected by our 100% guarantee.</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in"
                     data-aos-delay="400">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-layer"></i></div>
                        <h4><a href="">Pay With Confidence</a></h4>
                        <p>Registered remit customer support is here to help when you need us, where you need us.</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->

    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Customers Feedbacks</h2>
{{--                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint--}}
{{--                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia--}}
{{--                    fugiat sit in iste officiis commodi quidem hic quas.</p>--}}
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                        <div class="pic"><img src="images/team/team-1.jpg" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Walter White</h4>
                            <span>Chief Executive Officer</span>
                            <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                            <div class="social">
                                <a href=""><i class="ri-twitter-fill"></i></a>
                                <a href=""><i class="ri-facebook-fill"></i></a>
                                <a href=""><i class="ri-instagram-fill"></i></a>
                                <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="200">
                        <div class="pic"><img src="images/team/team-2.jpg" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Sarah Jhonson</h4>
                            <span>Product Manager</span>
                            <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                            <div class="social">
                                <a href=""><i class="ri-twitter-fill"></i></a>
                                <a href=""><i class="ri-facebook-fill"></i></a>
                                <a href=""><i class="ri-instagram-fill"></i></a>
                                <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="300">
                        <div class="pic"><img src="images/team/team-3.jpg" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>William Anderson</h4>
                            <span>CTO</span>
                            <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                            <div class="social">
                                <a href=""><i class="ri-twitter-fill"></i></a>
                                <a href=""><i class="ri-facebook-fill"></i></a>
                                <a href=""><i class="ri-instagram-fill"></i></a>
                                <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="400">
                        <div class="pic"><img src="images/team/team-4.jpg" class="img-fluid" alt=""></div>
                        <div class="member-info">
                            <h4>Amanda Jepson</h4>
                            <span>Accountant</span>
                            <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                            <div class="social">
                                <a href=""><i class="ri-twitter-fill"></i></a>
                                <a href=""><i class="ri-facebook-fill"></i></a>
                                <a href=""><i class="ri-instagram-fill"></i></a>
                                <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Team Section -->

    <!-- ======= Pricing Section ======= -->

    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Frequently Asked Questions</h2>
                {{--                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint--}}
                {{--                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia--}}
                {{--                    fugiat sit in iste officiis commodi quidem hic quas.</p>--}}
            </div>

            <div class="faq-list">
                <ul>
                    <li data-aos="fade-up" data-aos-delay="100">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-toggle="collapse" class="collapse"
                           href="#faq-list-1">WHAT IS REGISTERED REMIT ? <i class="bx bx-chevron-down icon-show"></i><i
                                class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-1" class="collapse show" data-parent=".faq-list">
                            <p>
                                Registered Remit is a money transfer service that ensures to provide
                                a secure way of sending money to Nepal.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="200">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-toggle="collapse" href="#faq-list-2"
                           class="collapsed"><i class="bx bx-chevron-down icon-show"></i>
                            WHY SHOULD I CHOOSE REGISTERED REMIT ?
                            <i
                                class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-2" class="collapse" data-parent=".faq-list">
                            <p>
                                Registered Remit assures to provide fast, easy and reliable remittance facility. We
                                offer
                                attractive exchange rate and two hours payment in Nepal* (Fees and restriction apply.
                                Please visit our T&C page). More importantly, we believe in providing value and security
                                to customers. Registered Remit definitely guarantees to be the best choice for sending
                                money
                                to your loves ones in Nepal.
                            </p>
                        </div>
                    </li>

                    <li data-aos="fade-up" data-aos-delay="300">
                        <i class="bx bx-help-circle icon-help"></i>
                        <a data-toggle="collapse" href="#faq-list-3"
                           class="collapsed">WHAT IS THE COST FOR A MONEY TRANSFER ?
                            <i class="bx bx-chevron-down icon-show"></i><i
                                class="bx bx-chevron-up icon-close"></i></a>
                        <div id="faq-list-3" class="collapse" data-parent=".faq-list">
                            <p>
                                The standard fee for an online money transfer is AU $10
                            </p>
                        </div>
                    </li>


                </ul>
            </div>

        </div>
    </section><!-- End Frequently Asked Questions Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Contact</h2>
                <p>Do you have any queries ? Ask Us .</p>
            </div>

            <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="icofont-google-map"></i>
                            <h4>Location:</h4>
                            <p>A108 Adam Street, New York, NY 535022</p>
                        </div>

                        <div class="email">
                            <i class="icofont-envelope"></i>
                            <h4>Email:</h4>
                            <p>info@registeredremit.com.au</p>
                        </div>

                        <div class="phone">
                            <i class="icofont-phone"></i>
                            <h4>Call:</h4>
                            <p>+1 5589 55488 55s</p>
                        </div>

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
                            frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="#" method="post" role="form" class="contact_us_form">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Your Name</label>
                                <input type="text" name="name" class="form-control"
                                       id="name"
                                       data-rule="minLen:4"
                                       data-msg="Please enter at least 4 chars"/>
                                <div class="validate"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Your Email</label>
                                <input type="email" class="form-control"
                                       name="email" id="email" data-rule="email"
                                       data-msg="Please enter a valid email"/>
                                <div class="validate"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Subject</label>
                            <input type="text" class="form-control"
                                   name="subject" id="subject" data-rule="minLen:4"
                                   data-msg="Please enter at least 8 chars of subject"/>
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="message"
                                      rows="10" data-rule="required"
                                      data-msg="Please write something for us"></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center">
                            <button type="submit">Send Message</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h4>Subscribe To Our Newsletter</h4>
                    <p>Join our subscribers list to get the latest news,
                        updates and special offers delivered directly in your inbox.</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Registered Remit</h3>
                    <p>
                        A108 Adam Street <br>
                        New York, NY 535022<br>
                        United States <br><br>
                        <strong>Phone:</strong> +1 5589 55488 55<br>
                        <strong>Email:</strong> info@registeredremit.com.au<br>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Features</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Secure</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Fast</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">100% cash back</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Social Networks</h4>
                    <p>Connect with us in</p>
                    <div class="social-links mt-3">
                        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container footer-bottom clearfix">
        <div class="copyright">
            &copy; Copyright <strong><span>Registered Remit</span></strong>. All Rights Reserved
        </div>

    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery.easing/jquery.easing.min.js')}}"></script>
{{--<script src="{{asset('vendor/contact_us_form/validate.js')}}"></script>--}}
<script src="{{asset('vendor/waypoints/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('vendor/venobox/venobox.min.js')}}"></script>
<script src="{{asset('vendor/owl.carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('vendor/aos/aos.js')}}"></script>
<script src="{{asset('js/contact-us.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('js/frontend.js')}}"></script>

</body>

</html>
