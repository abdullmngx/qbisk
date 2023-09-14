
<!DOCTYPE html>
<html lang="en">
<head>

     <title>{{ env('APP_NAME') }} | HOME</title>
<!--

Known Template

https://templatemo.com/tm-516-known

-->
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
     <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
     <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
     <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="{{ asset('css/templatemo-style.css') }}">
     <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo.png') }}">
</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>

          </div>
     </section>


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="#" class="navbar-brand"><span><img src="{{ asset('logo.png') }}" width="50" height="50" alt="logo"></span> <span>Queen<span class="text-danger">Bege</span>School</span></a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="#top" class="smoothScroll">Home</a></li>
                         <li><a href="#feature" class="smoothScroll">Features</a></li>
                         <li><a href="#about" class="smoothScroll">About</a></li>
                         <li><a href="#team" class="smoothScroll">Staffs</a></li>
                         <li><a href="#footer" class="smoothScroll">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="{{ route('student.login') }}" class="">Sign in</a></li>
                    </ul>
               </div>

          </div>
     </section>


     <!-- HOME -->
     <section id="home">
          <div class="row">

                    <div class="owl-carousel owl-theme home-slider">
                         <div class="item" style="background-image: url({{ asset('images/slider-image1.jpg') }});background-position: center;">
                              <div class="caption">
                                   <div class="container">
                                        <div class="col-md-6 col-sm-12">
                                             <h1 class="mt-4">Annual Graduation Ceremony</h1>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="item" style="background-image: url({{ asset('images/slider-image2.jpg') }});background-position: center;">
                              <div class="caption">
                                   <div class="container">
                                        <div class="col-md-6 col-sm-12 mt-4">
                                             <h1 class="mt-4">Drama Session</h1>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="item" style="background-image: url({{ asset('images/image4.jpg') }});background-position: center;">
                              <div class="caption">
                                   <div class="container">
                                        <div class="col-md-6 col-sm-12 mt-4">
                                             <h1 class="mt-4">Debate Session</h1>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="item" style="background-image: url({{ asset('images/slider-image3.jpg') }});background-position: center;">
                              <div class="caption">
                                   <div class="container">
                                        <div class="col-md-6 col-sm-12 mt-4">
                                             <h1 class="mt-4">Mr. Principal</h1>
                                             <!--<h3>Nam eget sapien vel nibh euismod vulputate in vel nibh. Quisque eu ex eu urna venenatis sollicitudin ut at libero. Visit <a rel="nofollow" href="https://www.facebook.com/templatemo">templatemo</a> page.</h3>
                                             <a href="#contact" class="section-btn btn btn-default smoothScroll">Let's chat</a>-->
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
          </div>
     </section>


     <!-- FEATURE -->
     <section id="feature">
          <div class="container">
            <h5 align="center">Features</h5>
            <h2 align="center">The Overview</h2>
            <p align="center">we're pleased to have you here. The online platform enables students to access online resources. These resources include student personal data, checking of results, etc. We present to you the overview of the students' portal features as a guide</p>
               <div class="row mb-4">

                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <span>01</span>
                              <h3>My Profile</h3>
                              <p>View, edit and print personal profile, academic, medical and parent/guardian details</p>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <span>02</span>
                              <h3>My Payments</h3>
                              <p>View payments record, statement of transactionsn and receipt for all payments</p>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <span>03</span>
                              <h3>My Result</h3>
                              <p>View and print current and previous terminal and cummulative academic results sheets</p>
                         </div>
                    </div>

               </div>
               <br><br>
               <div class="row">

                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <span>04</span>
                              <h3>My Settings</h3>
                              <p>View or change security settings. This include access password for the portal and other security details.</p>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <span>05</span>
                              <h3>Announcements</h3>
                              <p>View recent and past announcement updates. This information is for the students only.</p>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="feature-thumb">
                              <span>06</span>
                              <h3>Support</h3>
                              <p>You can send us a message for any inquiry, we will be there for response or call <a href="tel:+2347033973882">+234-7033973882</a></p>
                         </div>
                    </div>

               </div>
          </div>
     </section>


     <!-- ABOUT -->
     <section id="about">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-12">
                         <div class="about-info">
                              <h2>About Us</h2>

                              <figure>
                                   <span><i class="fa fa-users"></i></span>
                                   <figcaption>
                                        <h3>Our Mission</h3>
                                        <p>Training the child for nation building, equipping them morally and academically.</p>
                                   </figcaption>
                              </figure>

                              <figure>
                                   <span><i class="fa fa-certificate"></i></span>
                                   <figcaption>
                                        <h3>Our Vision</h3>
                                        <p>To be world class school for academic excellence.</p>
                                   </figcaption>
                              </figure>
                         </div>
                    </div>

                    <div class="col-md-offset-1 col-md-4 col-sm-12">
                         <div class="entry-form">
                              <div class="text-light">
                                                                      <h2>Announcement</h2>
                                   <marquee behavior="scroll" direction="up" scrollamount="2">
                                                                             <h2>{{ $announcement->name }}</h2>
                                     <p class="text-white" style="color: white">{{ $announcement->description }}</p>
                                                                           </marquee>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>


     <!-- TEAM -->
     <section id="team">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h2>Staffs <small>Meet Professional Trainers</small></h2>
                         </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image">
                                   <img src="{{ asset('images/author-image1.jpg') }}" class="img-responsive" height="50" alt="">
                              </div>
                              <div class="team-info">
                                   <h3>Jerimiah Zarmai Beri Ev.</h3>
                                   <span>Proprietor</span>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image">
                                   <img src="{{ asset('images/author-image2.jpg') }}" class="img-responsive" height="50" alt="">
                              </div>
                              <div class="team-info">
                                   <h3>Ikko Jerimiah</h3>
                                   <span>Director</span>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image">
                                   <img src="{{ asset('images/author-image3.jpg') }}" class="img-responsive" alt="">
                              </div>
                              <div class="team-info">
                                   <h3>Zephaniah Jerimiah</h3>
                                   <span>Principal</span>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                         <div class="team-thumb">
                              <div class="team-image">
                                   <img src="{{ asset('images/author-image4.jpg') }}" class="img-responsive" alt="">
                              </div>
                              <div class="team-info">
                                   <h3>Solomon B. Una</h3>
                                   <span>Exam Officer</span>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>

     <!-- TESTIMONIAL
     <section id="testimonial">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h2>Student Reviews <small>from around the world</small></h2>
                         </div>

                         <div class="owl-carousel owl-theme owl-client">
                              <div class="col-md-4 col-sm-4">
                                   <div class="item">
                                        <div class="tst-image">
                                             <img src="{{ asset('images/tst-image1.jpg') }}" class="img-responsive" alt="">
                                        </div>
                                        <div class="tst-author">
                                             <h4>Jackson</h4>
                                             <span>Shopify Developer</span>
                                        </div>
                                        <p>You really do help young creative minds to get quality education and professional job search assistance. I’d recommend it to everyone!</p>
                                        <div class="tst-rating">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-md-4 col-sm-4">
                                   <div class="item">
                                        <div class="tst-image">
                                             <img src="{{ asset('images/tst-image2.jpg') }}" class="img-responsive" alt="">
                                        </div>
                                        <div class="tst-author">
                                             <h4>Camila</h4>
                                             <span>Marketing Manager</span>
                                        </div>
                                        <p>Trying something new is exciting! Thanks for the amazing law course and the great teacher who was able to make it interesting.</p>
                                        <div class="tst-rating">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-md-4 col-sm-4">
                                   <div class="item">
                                        <div class="tst-image">
                                             <img src="{{ asset('images/tst-image3.jpg') }}" class="img-responsive" alt="">
                                        </div>
                                        <div class="tst-author">
                                             <h4>Barbie</h4>
                                             <span>Art Director</span>
                                        </div>
                                        <p>Donec erat libero, blandit vitae arcu eu, lacinia placerat justo. Sed sollicitudin quis felis vitae hendrerit.</p>
                                        <div class="tst-rating">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-md-4 col-sm-4">
                                   <div class="item">
                                        <div class="tst-image">
                                             <img src="{{ asset('images/tst-image4.jpg') }}" class="img-responsive" alt="">
                                        </div>
                                        <div class="tst-author">
                                             <h4>Andrio</h4>
                                             <span>Web Developer</span>
                                        </div>
                                        <p>Nam eget mi eu ante faucibus viverra nec sed magna. Vivamus viverra sapien ex, elementum varius ex sagittis vel.</p>
                                        <div class="tst-rating">
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                             <i class="fa fa-star"></i>
                                        </div>
                                   </div>
                              </div>

                         </div>

               </div>
          </div>
     </section>-->


     <!-- CONTACT
     <section id="contact">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-12">
                         <form id="contact-form" role="form" action="" method="post">
                              <div class="section-title">
                                   <h2>Contact us <small>we love conversations. let us talk!</small></h2>
                              </div>

                              <div class="col-md-12 col-sm-12">
                                   <input type="text" class="form-control" placeholder="Enter full name" name="name" required="">

                                   <input type="email" class="form-control" placeholder="Enter email address" name="email" required="">

                                   <textarea class="form-control" rows="6" placeholder="Tell us about your message" name="message" required=""></textarea>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                   <input type="submit" class="form-control" name="send message" value="Send Message">
                              </div>

                         </form>
                    </div>

                    <div class="col-md-6 col-sm-12">
                         <div class="contact-image">
                              <img src="{{ asset('images/contact-image.jpg') }}" class="img-responsive" alt="Smiling Two Girls">
                         </div>
                    </div>

               </div>
          </div>
     </section>-->


     <!-- FOOTER -->
     <footer id="footer">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Queen <span class="text-danger">Bege International</span> School</h2>
                              </div>
                              <address>
                                   <p>Queens' Ville, Anguwan Chika Kuta Shiroro L.G.A Niger State</p>
                              </address>

                              <ul class="social-icon">
                                   <li><a href="https://facebook.com/QueenBegeSchoolsKuta" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>

                              <div class="copyright-text">
                                   <p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> Queen Bege International School</p>

                                   <p>Design: <a href="tel:+2348161626675">The Nice Guy</a> </p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Contact Info</h2>
                              </div>
                              <address>
                                   <p><a href="tel:+2347033973882">+234-7033973882</a>, <a href="tel:+2348104985115">+234-8104985115</a>, <a href="tel:+2348060541259">+234-8060541259</a></p>
                                   <p><a href="mailto:ikkojeremiah@gmail.com">ikkojeremiah@gmail.com</a></p>
                              </address>


                         </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                         <div class="footer-info newsletter-form">
                              <div class="section-title">
                                   <h2>Quick Links</h2>
                              </div>
                              <div>
                                <ul>
                                     <li><a href="{{ route('applicant.apply') }}">Apply for Admission</a></li>
                                     <li><a href="{{ route('student.login') }}">Student Portal</a></li>
                                     <li><a href="{{ route('applicant.login') }}">Application Portal</a></li>
                                </ul>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </footer>


     <!-- SCRIPTS -->
     <script src="{{ asset('js/jquery.js') }}"></script>
     <script src="{{ asset('js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
     <script src="{{ asset('js/smoothscroll.js') }}"></script>
     <script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>
