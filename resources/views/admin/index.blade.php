<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Admin </title>
    <base href="{{ URL::asset('/') }}" target="_top">
    <!-- Fontfaces CSS-->
    <link href="admin/css/font-face.css" rel="stylesheet" media="all">
    <link href="admin/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="admin/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="admin/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="admin/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="admin/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="admin/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="admin/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="admin/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="admin/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="admin/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <!-- Main CSS-->
    <link href="admin/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <!-- <img src="users/logo.png" alt="CoolAdmin" /> -->
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                                <a href="{{ route('admin.home') }}">
                                    <i class="fas fa-chart-bar"></i>Thống Kê</a>

                            <li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                <!-- <img src="users/logo.png" alt="CoolAdmin" style="width:200px" /> -->
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">


                        @if (Auth::user()->is_admin == 1)
                            <li>
                                <a href="{{ route('admin.home') }}">
                                    <i class="fas fa-chart-bar"></i>Thống Kê</a>

                            <li>
                            <li>
                                <a href="{{ route('Product.list') }}">
                                    <i class="fas fa-chart-bar"></i>Sản Phẩm</a>

                            <li>
                                <a href="{{ route('Category.list') }}">
                                    <i class="fas fa-map-marker-alt"></i>Danh Mục</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>Đơn hàng</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                            <a href="{{ route('admin.listBill', ['genaral' => 0]) }}">Danh sách đơn hiện tại</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listBill', ['genaral' => 1]) }}">Danh sách đơn đang giao</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listBill', ['genaral' => 2]) }}">Danh sách đơn đã giao</a>
                        </li>

                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('User.list') }}">
                                    <i class="fas fa-chart-bar"></i>QL TK khách hàng hàng</a>

                            <li>
                            <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Blog</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{route('admin.listBlog')}}">Danh sách Blog</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.addBlog')}}">Thêm Blog</a>
                                </li>
                            </ul>
                        </li>
                            <li>
                                <a href="{{ route('User.listNV') }}">
                                    <i class="fas fa-chart-bar"></i>QL TK nhân viên</a>

                            <li>
                            <li>
                                <a href="{{ route('NhapXuatKho.list') }}">
                                    <i class="fas fa-chart-bar"></i>Quản lý kho</a>

                            <li>
                            @elseif(Auth::user()->is_admin == 2)
                            <li>
                                <a href="{{ route('admin.home') }}">
                                    <i class="fas fa-chart-bar"></i>Thống Kê</a>

                            <li>
                            <li>
                                <a href="{{ route('Product.list') }}">
                                    <i class="fas fa-chart-bar"></i>Sản Phẩm</a>

                            <li>
                                <a href="{{ route('Category.list') }}">
                                    <i class="fas fa-map-marker-alt"></i>Danh Mục</a>
                            </li>
                            <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Blog</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="{{route('admin.listBlog')}}">Danh sách Blog</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.addBlog')}}">Thêm Blog</a>
                                </li>
                            </ul>
                        </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>Đơn hàng</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                            <a href="{{ route('admin.listBill', ['genaral' => 0]) }}">Danh sách đơn hiện tại</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listBill', ['genaral' => 1]) }}">Danh sách đơn đang giao</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.listBill', ['genaral' => 2]) }}">Danh sách đơn đã giao</a>
                        </li>

                                </ul>
                            </li>
                        @endif


                      
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                           
                            <div class="header-button">
                                <div class="noti-wrap">
                                    
                                   
                                    
                                </div>
                                <div style="margin-left:1400px">

                                    
                                <li >

<a href="{{ route('logout') }}"
    onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">
    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg"
        class="text-danger" width="18" height="18"
        viewbox="0 0 24 24" fill="none" stroke="currentColor"
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12">
        </line>
    </svg>
    <span>
        {{ __('Logout') }}
    </span>
    <form id="logout-form" action="{{ route('logout') }}" method="POST"
        class="d-none">
        @csrf
    </form>
</a>

</li>  
                                  



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            @yield('content')
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="admin/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="admin/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="admin/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="admin/vendor/slick/slick.min.js"></script>
    <script src="admin/vendor/wow/wow.min.js"></script>
    <script src="admin/vendor/animsition/animsition.min.js"></script>
    <script src="admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="admin/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="admin/vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="admin/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="admin/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="admin/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="admin/vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="admin/js/main.js"></script>
    <script>
        $('.btnAddImage').click(function() {
            let count = $('.image_count').length + 1;
            let imageHTML = '<div class="row form-group image_count">' +
                '<div class="col col-md-3">' +
                '<label for="text-input" class=" form-control-label">Ảnh ' + count + '</label>' +
                ' </div>' +
                '<div class="col-12 col-md-9">' +
                '<input type="file" id="text-input" name="image[]" placeholder="Nhập"' +
                'class="form-control">' +
                '</div>' +
                '</div>';
            $('.image_here').append(imageHTML);
        });
    </script>
</body>

</html>
<!-- end document-->
