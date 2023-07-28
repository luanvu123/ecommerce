<!DOCTYPE html>
<html>

<head>
    <title>
        Trang Admin
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords"
        content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('backend/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- font-awesome icons CSS -->
    <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/SidebarNav.min.css') }}" media="all" rel="stylesheet" type="text/css" />


    <script src="{{ asset('backend/js/modernizr.custom.js') }}"></script>


    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet" />
    <script src="https://kit.fontawesome.com/3e3afb65d3.js" crossorigin="anonymous"></script>
    <!-- Metis Menu -->
    <script src="{{ asset('backend/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/js/custom.js') }}"></script>
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/owl.carousel.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/js/owl.carousel.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('backend/css/dropzone.min.css') }}">
    <script src="{{ asset('backend/js/jquery-1.11.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#owl-demo').owlCarousel({
                items: 3,
                lazyLoad: true,
                autoPlay: true,
                pagination: true,
                nav: true,
            });
        });
    </script>
    <style>
        .image-card {
            position: relative;
        }

        .image-card .btn-danger {
            position: absolute;
            right: 20px;
            top: 20px;
        }
    </style>
    <!-- //requried-jsfiles-for owl -->
</head>

<body class="cbp-spmenu-push">
    @if (Auth::check())
        <div class="main-content">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!--left-fixed -navigation-->
                <aside class="sidebar-left">
                    <nav class="navbar navbar-inverse">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target=".collapse" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <h1>
                                <a class="navbar-brand" href="{{ url('/') }}"><span
                                        class="fa fa-area-chart"></span> HOME<span class="dashboard_text">Litle&Litle
                                        Admin</span></a>
                            </h1>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="sidebar-menu">
                                <li class="header">MAIN EVENT</li>
                                <li class="treeview">
                                    <a href="{{ url('/home') }}">
                                        <lord-icon src="https://cdn.lordicon.com/ridbdkcb.json" trigger="loop"
                                            delay="2000" style="width:20px;height:20px">
                                        </lord-icon> <span>Dashboard</span>
                                    </a>
                                </li>
                                <li class="treeview">
                                    <a href="{{ route('info.create') }}">
                                        <lord-icon src="https://cdn.lordicon.com/lxotnbfa.json" trigger="loop"
                                            delay="2000" style="width:20px;height:20px">
                                        </lord-icon> <span>Thông tin website</span>
                                    </a>
                                </li>
                                @php
                                    $segment = Request::segment(1);
                                @endphp
                                <li class="treeview {{ $segment == 'products' ? 'active' : '' }}">
                                    <a href="#">
                                        <lord-icon src="https://cdn.lordicon.com/ihyatngg.json" trigger="loop"
                                            delay="2000" style="width:20px;height:20px">
                                        </lord-icon>
                                        <span>Sản phẩm</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('products.create') }}">
                                                <lord-icon src="https://cdn.lordicon.com/zgogqkqu.json" trigger="loop"
                                                    delay="2000" style="width:20px;height:20px">
                                                </lord-icon>Thêm sản phẩm
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('products.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/hursldrn.json" trigger="loop"
                                                    delay="2000" style="width:20px;height:20px">
                                                </lord-icon>Liệt kê sản phẩm
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="{{ route('users.index') }}">
                                        <lord-icon src="https://cdn.lordicon.com/ljvjsnvh.json" trigger="loop"
                                            delay="2000" style="width:20px;height:20px">
                                        </lord-icon>
                                        <span>User</span>
                                    </a>
                                </li>
                                <li class="treeview">
                                    <a href="{{ route('roles.index') }}">
                                        <lord-icon src="https://cdn.lordicon.com/amxnacxd.json" trigger="loop"
                                            delay="2000" style="width:20px;height:20px">
                                        </lord-icon>
                                        <span>Roles</span>
                                    </a>
                                </li>
                                <li class="treeview {{ $segment == 'categories' ? 'active' : '' }}">
                                    <a href="#">
                                        <lord-icon src="https://cdn.lordicon.com/ihyatngg.json" trigger="loop"
                                            delay="2000" style="width:20px;height:20px">
                                        </lord-icon>
                                        <span>Thể loại</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('categories.create') }}">
                                                <lord-icon src="https://cdn.lordicon.com/zgogqkqu.json" trigger="loop"
                                                    delay="2000" style="width:20px;height:20px">
                                                </lord-icon>Thêm thể loại
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('categories.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/hursldrn.json" trigger="loop"
                                                    delay="2000" style="width:20px;height:20px">
                                                </lord-icon>Liệt kê thể loại
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                 <li class="treeview {{ $segment == 'policies' ? 'active' : '' }}">
                                    <a href="#">
                                        <lord-icon src="https://cdn.lordicon.com/ihyatngg.json" trigger="loop"
                                            delay="2000" style="width:20px;height:20px">
                                        </lord-icon>
                                        <span>Polycies</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('policies.create') }}">
                                                <lord-icon src="https://cdn.lordicon.com/zgogqkqu.json" trigger="loop"
                                                    delay="2000" style="width:20px;height:20px">
                                                </lord-icon>Thêm Policies
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('policies.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/hursldrn.json" trigger="loop"
                                                    delay="2000" style="width:20px;height:20px">
                                                </lord-icon>Liệt kê Policies
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                 <li class="treeview {{ $segment == 'posters' ? 'active' : '' }}">
                                    <a href="#">
                                        <lord-icon src="https://cdn.lordicon.com/ihyatngg.json" trigger="loop"
                                            delay="2000" style="width:20px;height:20px">
                                        </lord-icon>
                                        <span>Poster</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('posters.create') }}">
                                                <lord-icon src="https://cdn.lordicon.com/zgogqkqu.json" trigger="loop"
                                                    delay="2000" style="width:20px;height:20px">
                                                </lord-icon>Thêm posters
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('posters.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/hursldrn.json" trigger="loop"
                                                    delay="2000" style="width:20px;height:20px">
                                                </lord-icon>Liệt kê posters
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                 <li class="treeview {{ $segment == 'metas' ? 'active' : '' }}">
                                    <a href="#">
                                        <lord-icon src="https://cdn.lordicon.com/ihyatngg.json" trigger="loop"
                                            delay="2000" style="width:20px;height:20px">
                                        </lord-icon>
                                        <span>Product_Meta</span>
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="{{ route('metas.create') }}">
                                                <lord-icon src="https://cdn.lordicon.com/zgogqkqu.json" trigger="loop"
                                                    delay="2000" style="width:20px;height:20px">
                                                </lord-icon>Thêm Product Meta
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('metas.index') }}">
                                                <lord-icon src="https://cdn.lordicon.com/hursldrn.json" trigger="loop"
                                                    delay="2000" style="width:20px;height:20px">
                                                </lord-icon>Liệt kê product meta
                                            </a>
                                        </li>
                                    </ul>
                                </li>





                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </aside>
            </div>
            <!--left-fixed -navigation-->
            <!-- header-starts -->
            <div class="sticky-header header-section">
                <div class="header-left">
                    <!--toggle button start-->
                    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                    <!--toggle button end-->
                    <div class="clearfix"></div>
                </div>
                <div class="header-right">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <div class="profile_details">
                            <ul>
                                <li class="dropdown profile_details_drop">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <div class="profile_img">
                                            <span class="prfil-img"><img
                                                    style="width:40px;"src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                                    alt="">
                                            </span>
                                            <div class="user-name">
                                                <p> {{ Auth::user()->name }}</p>
                                                <span>{{ Auth::user()->getRoleNames() }}</span>
                                            </div>
                                            <i class="fa fa-angle-down lnr"></i>
                                            <i class="fa fa-angle-up lnr"></i>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu drp-mnu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i> Đăng xuất
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @endguest
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>
            </div>
            <!-- //header-ends -->
            <!-- main content start-->
            <div id="page-wrapper">
                <div class="main-page">
                    <div class="col_3">
                        <div class="col-md-3 widget widget1">
                            <div class="r3_counter_box">
                                <a href="{{ route('products.index') }}">
                                    <i class="pull-left fa fa-file icon-rounded"></i>
                                    <div class="stats">
                                        <h5><strong>{{ $product_total }}</strong></h5>
                                        <span>Sản phẩm </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 widget widget1">
                            <div class="r3_counter_box">
                                <a href="{{ route('categories.index') }}">
                                    <i class="pull-left fa fa-book user1 icon-rounded"></i>
                                    <div class="stats">
                                        <h5><strong>{{ $category_total }}</strong></h5>
                                        <span>Thể loại</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <style>
                            .label-primary.pull-right.new-label {
                                animation: glow 2s infinite;
                            }

                            @keyframes glow {
                                0% {
                                    box-shadow: 0 0 0 rgba(255, 0, 0, 0.4);
                                }

                                50% {
                                    box-shadow: 0 0 20px rgba(255, 0, 0, 0.4);
                                }

                                100% {
                                    box-shadow: 0 0 0 rgba(255, 0, 0, 0.4);
                                }
                            }
                        </style>


                        <div class="clearfix"></div>
                    </div>
                    <br>


                    <script src="{{ asset('backend/js/dropzone.min.js') }}"></script>
                    <!-- for amcharts js -->

                    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                    <script src="{{ asset('backend/js/amcharts.js') }}"></script>
                    <script src="{{ asset('backend/js/serial.js') }}"></script>
                    <script src="{{ asset('backend/js/export.min.js') }}"></script>
                    <link rel="stylesheet" href="{{ asset('backend/css/export.css') }}" type="text/css"
                        media="all" />
                    <script src="{{ asset('backend/js/light.js') }}"></script>
                    <!-- for amcharts js -->
                    <script src="{{ asset('backend/js/index1.js') }}"></script>
                    <script src="{{ asset('backend/js/index.js') }}"></script>
                    <script src="{{ asset('backend/js/index2.js') }}"></script>
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <!--footer-->
            <div class="footer">
                <p>
                    &copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by
                    <a href="#" target="_blank">w3layouts</a>
                </p>
            </div>
            <!--//footer-->
        </div>
    @else
        @yield('content_login')
    @endif
    <!-- for toggle left push menu script -->
    <script src="{{ asset('backend/js/classie.js') }}"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <!--//scrolling js-->
    <!-- side nav js -->
    <script src="{{ asset('backend/js/SidebarNav.min.js') }}" type="text/javascript"></script>
    <script>
        $('.sidebar-menu').SidebarNav();
    </script>
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <!-- //Bootstrap Core JavaScript -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        let table = new DataTable('#tableevent');
        $(document).ready(function() {
            $('#tableevent').DataTable();
        });
    </script>
    <script>
        function ChangeToSlug() {

            var slug;

            //Lấy text từ thẻ input title
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '-');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#start_date, #end_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
    </script>

    {{-- chon trang thai --}}


    {{-- <script type="text/javascript">
        $(document).on('change', '.file_image', function() {

            // Lấy ID của sự kiện
            var event_id = $(this).data('event_id');
            // Lấy tập tin hình ảnh được chọn
            var files = $("#file-" + event_id)[0].files;
            var image = document.getElementById("file-" + event_id).files[0];
            // Khởi tạo đối tượng form data để gửi qua ajax
            var form_data = new FormData();

            // Thêm hình ảnh và ID sự kiện vào form data
            form_data.append("file", document.getElementById("file-" + event_id).files[0]);
            form_data.append("id", event_id);

            // Gọi ajax để update hình ảnh cho sự kiện
            $.ajax({
                url: "{{ route('update-image-event-ajax') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: form_data,

                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {
                    // Cập nhật hình ảnh mới trên trang web
                    $('#success_image').html(
                        '<span class="text-success">Thay đổi ảnh thành công</span>');
                    $('img[data-event_id="' + event_id + '"]').attr('src',
                        '{{ asset('uploads/event') }}/' + response);
                }
            });
        });
    </script> --}}

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('.delete-image-btn').click(function() {
                var event_id = $(this).data('event_id');
                if (confirm("Bạn có chắc muốn xóa ảnh này?")) {
                    $.ajax({
                        url: "{{ route('delete-image-event-ajax') }}",
                        method: "POST",
                        data: {
                            event_id: event_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#file-' + event_id).val('');
                                $('#success_image').text('Xóa ảnh thành công');
                                $('#success_image').css('color', 'green');
                            } else {
                                $('#success_image').text('Xóa ảnh thất bại');
                                $('#success_image').css('color', 'red');
                            }
                        }
                    });
                }
            });
        });
    </script> --}}
    <script type="text/javascript">
        $('.trangthai_choose').change(function() {

            var trangthai_val = $(this).val();
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('trangthai-choose') }}",
                method: "GET",
                data: {
                    trangthai_val: trangthai_val,
                    id: id
                },
                success: function(data) {
                    alert('Thay đổi trạng thái sản phẩm thành công!');
                }
            });
        })
    </script>
    <script>
         $('.policy_choose').change(function() {

            var trangthai_val = $(this).val();
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('policy-choose') }}",
                method: "GET",
                data: {
                    trangthai_val: trangthai_val,
                    id: id
                },
                success: function(data) {
                    alert('Thay đổi trạng thái policy thành công!');
                }
            });
        })
    </script>
     <script>
         $('.poster_choose').change(function() {

            var trangthai_val = $(this).val();
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('poster-choose') }}",
                method: "GET",
                data: {
                    trangthai_val: trangthai_val,
                    id: id
                },
                success: function(data) {
                    alert('Thay đổi trạng thái poster thành công!');
                }
            });
        })
    </script>
    <script type="text/javascript">
        $('.newviral_choose').change(function() {

            var newviral_val = $(this).val();
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('newviral-choose') }}",
                method: "GET",
                data: {
                    newviral_val: newviral_val,
                    id: id
                },
                success: function(data) {
                    alert('Thay đổi trạng thái newviral thành công!');
                }
            });
        })
    </script>
    <script type="text/javascript">
        $('.mostsold_choose').change(function() {

            var mostsold_val = $(this).val();
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('mostsold-choose') }}",
                method: "GET",
                data: {
                    mostsold_val: mostsold_val,
                    id: id
                },
                success: function(data) {
                    alert('Thay đổi bán chạy thành công!');
                }
            });
        })
    </script>

    <script type="text/javascript">
        $('.cate_choose').change(function() {

            var trangthai_val = $(this).val();
            var id = $(this).attr('id');
            //   alert(trangthai_val)
            // alert(id)
            $.ajax({
                url: "{{ route('cate-choose') }}",
                method: "GET",
                data: {
                    trangthai_val: trangthai_val,
                    id: id
                },
                success: function(data) {
                    alert('Thay đổi trạng thái thể loại thành công!');
                }
            });
        })

        $('.hotDeal_choose').change(function() {

            var hotDeal_val = $(this).val();
            var product_id = $(this).attr('id');

            $.ajax({
                url: "{{ route('hotDeal-choose') }}",
                method: "GET",
                data: {
                    hotDeal_val: hotDeal_val,
                    product_id: product_id
                },
                success: function(data) {
                    alert('Thay đổi Hot deal thành công!');
                }
            });
        })
    </script>
    <script src="{{ asset('backend/js/utils.js') }}"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>

</html>
