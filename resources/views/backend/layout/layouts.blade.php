
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Gymove - Fitness Bootstrap Admin Dashboard</title>
    <!-- Favicon icon -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="crossorigin="anonymous"referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('dashboard_assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard_assets') }}/{{ asset('dashboard_assets') }}/images/favicon.png">
	<link rel="stylesheet" href="{{ asset('dashboard_assets') }}/vendor/chartist/css/chartist.min.css">
    <link href="{{ asset('dashboard_assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="{{ asset('dashboard_assets') }}/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="{{ asset('dashboard_assets') }}/css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .card {
            height: auto!important;
        }
        .toggle-btn .check-box {
            transform: scale(2);
        }

        .toggle-btn input[type="checkbox"] {
            position: relative;
            appearance: none;
            width: 18px;
            height: 10px;
            background: #ccc;
            border-radius: 50px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: 0.4s;
        }

        .toggle-btn input:checked[type="checkbox"] {
            background: #7da6ff;
        }

        .toggle-btn input[type="checkbox"]::after {
            position: absolute;
            content: "";
            width: 10px;
            height: 10px;
            top: 0;
            left: 0;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
            transition: 0.4s;
        }

        .toggle-btn input:checked[type="checkbox"]::after {
            left: 50%;
        }

    </style>
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('dashboard_assets') }}/images/logo.png" alt="">
                <img class="logo-compact" src="{{ asset('dashboard_assets') }}/images/logo-text.png" alt="">
                <img class="brand-title" src="{{ asset('dashboard_assets') }}/images/logo-text.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
								Dashboard
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                    @if (Auth::user()->profile_photo == null)
                                        <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" />
                                    @else
                                        <img src="{{ asset('uploads/profile_photo') }}/{{ Auth::user()->profile_photo }}" class="img-fluid rounded-circle" alt="">
                                    @endif

									<div class="header-info">
										<span class="text-black"><strong>{{ Auth()->user()->name }}</strong></span>
										<p class="fs-12 mb-0">Super Admin</p>
									</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('profile') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
                    @can('user')
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-television"></i>
							<span class="nav-text">Users</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('user.list') }}">User List</a></li>
                        </ul>
                    </li>
                    @endcan

                    @can('category_access')
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-television"></i>
							<span class="nav-text">Category</span>
						</a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('add.category') }}">Add New Category</a></li>
                            <li><a href="{{ route('subcategory') }}">Add New SubCategory</a></li>
                            <li><a href="{{ route('trash.category') }}">Trash Category</a></li>
                        </ul>
                    </li>
                    @endcan
                    <li><a class="has-arrow ai-icon" href="{{ route('brand') }}">
							<i class="flaticon-381-television"></i>
							<span class="nav-text">Brand</span>
						</a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Products</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('add.product') }}">Add New Product</a></li>
                        <li><a href="{{ route('product.list') }}">Product List</a></li>
                        <li><a href="{{ route('add.color.size') }}">Add Color & Size</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Offers</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('upcoming.offer') }}">Upcoming Offer</a></li>
                        <li><a href="{{ route('newyear.offer') }}">New Year Sale Offer</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="{{route('logo')}}">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Logo</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="{{route('social')}}">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Social Media</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="{{route('subscribe')}}">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Subscribe Part</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="{{route('coupon')}}">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Coupon</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="{{route('delivery.charge')}}">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Delivery Charge</span>
                    </a>
                </li>
                @can('order_access')
                <li><a class="has-arrow ai-icon" href="{{route('order')}}">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Orders</span>
                    </a>
                </li>
                @endcan
                @can('role_access')
                <li><a class="has-arrow ai-icon" href="{{route('role.manager')}}">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Role Manager</span>
                    </a>
                </li>
                @endcan
                <li><a class="has-arrow ai-icon" href="{{route('tags')}}">
                        <i class="flaticon-381-television"></i>
                        <span class="nav-text">Tags</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row">
                    @yield('content')
				</div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="http://dexignzone.com/" target="_blank">DexignZone</a> 2020</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/vendor/global/global.min.js"></script>
	<script src="{{ asset('dashboard_assets') }}/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="{{ asset('dashboard_assets') }}/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="{{ asset('dashboard_assets') }}/js/custom.min.js"></script>
	<script src="{{ asset('dashboard_assets') }}/js/deznav-init.js"></script>
	<script src="{{ asset('dashboard_assets') }}/vendor/owl-carousel/owl.carousel.js"></script>

	<!-- Chart piety plugin files -->
    <script src="{{ asset('dashboard_assets') }}/vendor/peity/jquery.peity.min.js"></script>

	<!-- Apex Chart -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="{{ asset('dashboard_assets') }}/vendor/apexchart/apexchart.js"></script>

	<!-- Dashboard 1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('dashboard_assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/plugins-init/datatables.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="crossorigin="anonymous"referrerpolicy="no-referrer"></script>
	<script src="{{ asset('dashboard_assets/js/dashboard/dashboard-1.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<script>
		function carouselReview(){
			/*  testimonial one function by = owl.carousel.js */
			jQuery('.testimonial-one').owlCarousel({
				loop:true,
				autoplay:true,
				margin:30,
				nav:false,
				dots: false,
				left:true,
				navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
				responsive:{
					0:{
						items:1
					},
					484:{
						items:2
					},
					882:{
						items:3
					},
					1200:{
						items:2
					},

					1540:{
						items:3
					},
					1740:{
						items:4
					}
				}
			})
		}
		jQuery(window).on('load',function(){
			setTimeout(function(){
				carouselReview();
			}, 1000);
		});
	</script>
    @yield('footer_script')

</body>
</html>
