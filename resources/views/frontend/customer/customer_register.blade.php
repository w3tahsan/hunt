
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wpocean.com/html/tf/themart/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jun 2023 08:56:41 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpOceans">
    <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
    <title>Themart - eCommerce HTML5 Template</title>
    <link href="{{ asset('front') }}/css/themify-icons.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/flaticon_ecommerce.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/owl.carousel.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/owl.theme.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/slick.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/slick-theme.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/swiper.min.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/owl.transitions.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/jquery.fancybox.css" rel="stylesheet">
    <link href="{{ asset('front') }}/css/odometer-theme-default.css" rel="stylesheet">
    <link href="{{ asset('front') }}/sass/style.css" rel="stylesheet">
</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <!-- start preloader -->
        <div class="preloader">
            <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <img src="{{ asset('front') }}/images/preloader.png" alt="">
                </div>
            </div>
        </div>
        <!-- end preloader -->

        <div class="wpo-login-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="wpo-accountWrapper" action="{{ route('customer.register.store') }}" method="POST">
                            @csrf
                            <div class="wpo-accountInfo">
                                <div class="wpo-accountInfoHeader">
                                    <a href="index.html"><img src="{{ asset('front') }}/images/logo-2.svg" alt=""></a>
                                    <a class="wpo-accountBtn" href="{{ route('customer.login') }}">
                                        <span class="">Log in</span>
                                    </a>
                                </div>
                                <div class="image">
                                    <img src="{{ asset('front') }}/images/login.svg" alt="">
                                </div>
                                <div class="back-home">
                                    <a class="wpo-accountBtn" href="{{ route('index') }}">
                                        <span class="">Back To Home</span>
                                    </a>
                                </div>
                            </div>
                            <div class="wpo-accountForm form-style">
                                @if (session('register_success'))
                                    <div class="alert alert-success">{{ session('register_success') }}</div>
                                @endif
                                <div class="fromTitle">
                                    <h2>Signup</h2>
                                    <p>Sign into your pages account</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <label for="name">Full Name</label>
                                        <input type="text" id="name" name="name" placeholder="Your name here..">
                                         @error('name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <label>Email</label>
                                        <input type="text" id="email" name="email" placeholder="Your email here..">
                                        @error('email')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="pwd2" type="password" placeholder="Your password here.." value="sfsg" name="password">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default reveal3" type="button"><i class="ti-eye"></i></button>
                                            </span>
                                            @error('password')
                                                <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="pwd3" type="password" placeholder="Your password here.." value="ssres" name="password_confirmation">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default reveal2" type="button"><i class="ti-eye"></i></button>
                                            </span>
                                             @error('password_confirmation')
                                                <strong class="text-danger">{{ $message }}</strong>
                                             @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <button type="submit" class="wpo-accountBtn">Signup</button>
                                    </div>
                                </div>

                                <p class="subText">Sign into your pages account <a href="{{ route('customer.login') }}">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{ asset('front') }}/js/jquery.min.js"></script>
    <script src="{{ asset('front') }}/js/bootstrap.bundle.min.js"></script>
    <!-- Plugins for this template -->
    <script src="{{ asset('front') }}/js/modernizr.custom.js"></script>
    <script src="{{ asset('front') }}/js/jquery.dlmenu.js"></script>
    <script src="{{ asset('front') }}/js/jquery-plugin-collection.js"></script>
    <!-- Custom script for this template -->
    <script src="{{ asset('front') }}/js/script.js"></script>
</body>


<!-- Mirrored from wpocean.com/html/tf/themart/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jun 2023 08:56:41 GMT -->
</html>
