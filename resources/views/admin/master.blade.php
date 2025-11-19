@if (!Auth::check())
    <script>
        window.location.href = "/login";
    </script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Inventory Management System</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="assets/img/kaiadmin/inventory.png" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
        
    </script>
    <!-- CSS: hide ALL search boxes -->

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="assets/css/demo.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- select  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* Success */
        .toast-success {
            background-color: rgb(1, 180, 1) !important;
            /* Bootstrap green */
            color: white;
            opacity: 100%;
            box-shadow: none
        }

        /* Error */
        .toast-error {
            background-color: #dc3545 !important;
            /* Bootstrap red */
            color: white;
        }

        /* Info */
        .toast-info {
            background-color: #17a2b8 !important;
            /* Bootstrap cyan */
            color: white;
        }

        /* Warning */
        .toast-warning {
            background-color: #ffc107 !important;
            /* Bootstrap yellow */
            color: black;
        }

        .table-responsive {
            overflow-x: auto;
            scrollbar-width: none;
        }

        .scrollable-td {
            max-width: 150px;
            overflow-x: auto;
            scrollbar-width: none;
            /* For Firefox */
        }

        .product_img {
            /* animation: scaleUp 1s ease-in-out infinite; */
            cursor: pointer;

        }

        @keyframes scaleUp {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="/" class="logo gap-2">
                        <img style="width: 60px;" src="assets/img/kaiadmin/inventory.png" alt="navbar brand"
                            class="rounded-circle navbar-brand " />
                        <h6 class="text-light">Inventory Management</h6>
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="more topbar-toggler">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="scrollbar scrollbar-inner sidebar-wrapper">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item">
                            <a href="/">
                                <i class="bi bi-speedometer2"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="/category">
                                <i class="bi bi-tags-fill"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/product">
                                <i class="bi bi-exclude"></i>
                                <p>Product </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/customer">
                                <i class="fas fa-users"></i>
                                <p> Customer </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sale">
                                <i class="bi bi-receipt"></i>
                                <p>Sale</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/supplier">
                                <i class="fas fa-truck-moving"></i>
                                <p>Supplier</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/purchese">
                                <i class="bi bi-cart-plus-fill"></i>
                                <p>Purchese </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/report">
                                <i class="bi bi-gear-wide-connected"></i>
                                <p>Report </p>
                            </a>
                        </li>
                        <li class="nav-item mx-3 mt-5 ">
                            <a href="/logout" class="btn btn-danger mt-4">
                                <i class="bi bi-box-arrow-left fw-bold text-light fs-5 text-start"></i>
                                <p class="text-light">Sign out</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="#" class="logo">
                            <img style="width: 60px;" src="assets/img/kaiadmin/inventory.png" alt="navbar brand"
                                class="rounded-circle navbar-brand " />
                            <h5 class="text-light">Inventory Management System</h5>

                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="more topbar-toggler">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-expand-lg navbar-header navbar-header-transparent border-bottom">
                    <div class="container-fluid">
                        <nav
                            class="d-lg-flex d-none nav-search navbar navbar-expand-lg navbar-form navbar-header-left p-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </nav>

                        <ul class="navbar-nav align-items-center ms-md-auto topbar-nav">
                            <li class="d-flex d-lg-none dropdown nav-item hidden-caret topbar-icon">
                                <a class="dropdown-toggle nav-link" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="nav-search navbar-form navbar-left">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>

                            <li class="dropdown nav-item hidden-caret topbar-icon">
                                <a class="dropdown-toggle nav-link" href="#" id="notifDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification">4</span>
                                </a>
                                <ul class="dropdown-menu animated fadeIn notif-box" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            You have 4 new notification
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-icon notif-primary">
                                                        <i class="fa fa-user-plus"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block"> New user registered </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-icon notif-success">
                                                        <i class="fa fa-comment"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Rahmad commented on Admin
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="assets/img/profile2.jpg" alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Reza send messages to you
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-danger notif-icon">
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block"> Farrah liked Admin </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all notifications<i
                                                class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>


                            <li class="dropdown nav-item hidden-caret topbar-user">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="{{ Auth::user()->profile ?? '/assets/img/profile4.png' }}"
                                            alt="Profile" class="rounded-circle avatar-img" />
                                    </div>

                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">{{Auth::user()->name ?? "guest" }}</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-sm">
                                                    <img src="{{ Auth::user()->profile ?? '/assets/img/profile4.png' }}"
                                                        alt="Profile" class="rounded avatar-img" />
                                                </div>

                                                <div class="u-text">
                                                    <h4>{{Auth::user()->name ?? "guest" }}</h4>
                                                    <p class="text-muted">{{Auth::user()->email ?? "guest" }}</p>
                                                    <a href="#" class="btn btn-secondary btn-sm btn-xs">View
                                                        Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">My Profile</a>
                                            <a class="dropdown-item" href="#">My Balance</a>
                                            <a class="dropdown-item" href="#">Inbox</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Account Setting</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="/logout">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    @yield('contents')

                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="#">
                                    Inventory Management System
                                </a>
                            </li>

                        </ul>
                    </nav>
                    <div class="copyright">
                        &copy;

                        Copy Right|All Right Reserve
                    </div>
                    <div>
                        Maded by
                        <a class="text-dark" target="_blank" href="#">Phearom</a>.
                    </div>
                </div>
            </footer>
        </div>

        <!-- Custom template | don't include it in your project! -->
        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeLogoHeaderColor selected" data-color="dark"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeTopBarColor" data-color="dark"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="green"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange"></button>
                            <button type="button" class="changeTopBarColor" data-color="red"></button>
                            <button type="button" class="changeTopBarColor selected" data-color="white"></button>
                            <br />
                            <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="green2"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                            <button type="button" class="changeTopBarColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeSideBarColor" data-color="white"></button>
                            <button type="button" class="changeSideBarColor selected" data-color="dark"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="icon-settings"></i>
            </div>
        </div>
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    {{-- select --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="assets/js/setting-demo.js"></script>
    {{-- <script src="assets/js/demo.js"></script> --}}
    <script src="assets/js/product.js"></script>
    {{-- <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
        var myPieChart = new Chart(pieChart, {
            type: "pie",
            data: {
                datasets: [{
                    data: [4, 11, 4],
                    backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b"],
                    borderWidth: 0,
                }, ],
                labels: ["Category", "Products", "Customer"],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
                    labels: {
                        fontColor: "rgb(154, 154, 154)",
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20,
                    },
                },
                pieceLabel: {
                    render: "percentage",
                    fontColor: "white",
                    fontSize: 14,
                },
                tooltips: false,
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20,
                    },
                },
            },
        });
    </script> --}}

</body>

</html>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        // Initialize the image preview when the file input changes



        $("#reset").click(function() {
            $("#productPreview").hide();
        });

        // category
        $("#addcategory").click(function() {
            $("#modal_addcategory").modal("show");
        });
        $("#editcategory").click(function() {
            $("#modal_editcategory").modal("show");
        });

        // notification
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
            "showDuration": "300",
            "hideDuration": "1000",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        // Show toastr after reload
        if (localStorage.getItem('showToastr') === '1') {
            toastr.success('Category added successfully!');
            localStorage.removeItem('showToastr');
        }


        // Enter key triggers save
        $('#category_name').on('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // prevent form from submitting
                $('#btnsave').click(); // trigger Save logic
            }
        });

        // add category
        $('#btnsave').click(function() {
            let name = $('#category_name').val();

            if (name === "") {
                toastr.error('Category name is required!');
                return;
            }

            $.post('/addcategory', {
                category_name: name
            }, function(data, status) {
                if (data == 1) {
                    localStorage.setItem('showToastr', '1');
                    window.location.reload();
                }
            });
        });

        // delete category
        $('#category_table tr').on('click', '#delete_category', function() {
            var current_row = $(this).closest('tr');
            var id_category = current_row.find('td').eq(0).text();
            var name_category = current_row.find('td').eq(1).text();
            $("#edit_name_category").val(name_category);
            $('#title_delete').text('You want to delete category (' + name_category +
                ') Are you sure ?');
            $('#modal_deletecategory').modal('show');
            $('#id_delete_cat').val(id_category);

        });

        // edit Category
        $('#category_table tr').on('click', '#edit_category', function() {
            var current_row = $(this).closest('tr');
            var id_category = current_row.find('td').eq(0).text();
            var name_category = current_row.find('td').eq(1).text();
            $("#edit_name_category").val(name_category);
            $("#modal_editcategory").modal('show');
            $('#id_edit_cat').val(id_category);
        });



        // product
        $("#addproduct").click(function() {
            $("#modal_addproduct").modal("show");

        });
        // add product img
        $("#product_image").change(function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#productPreview").attr("src", e.target.result).show();
            };
            reader.readAsDataURL(event.target.files[0]);
        });
        // edit product img
        $("#edit_image").change(function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#edit_productPreview").attr("src", e.target.result).show();
            };
            reader.readAsDataURL(event.target.files[0]);
        });

        // modal delete product

        $(document).on('click', '#delete_product', function() {
            const id = $(this).data('id');
            $('#id_delete_product').val(id);
            $('#modal_deleteproduct').modal('show');
        });

        // show products image detail on modal
        $('#products_table tr').on('click', '#show_imgproduct', function() {
            var current_row = $(this).closest('tr');
            var imageUrl = $(this).attr('src');
            $('#show_img_product').attr('src', imageUrl);
            $("#modal_show_imageProduct").modal("show");
        });
        $(document).on('click', '#edit_product', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const price = $(this).data('price');
            const stock = $(this).data('stock');
            const category = $(this).data('category');
            const desc = $(this).data('description');
            const image = $(this).data('image');
            const suppliers = $(this).data('suppliers'); // This will be an array like [1, 2, 3]

            $('#id_edit_product').val(id);
            $('#edit_name_product').val(name);
            $('#edit_price_product').val(price);
            $('#edit_stock_product').val(stock);
            $('#edit_category_product').val(category);
            $('#product_desc').val(desc);

            if (image) {
                $('#edit_productPreview').attr('src', image).show();
            } else {
                $('#edit_productPreview').hide();
            }

            // Select supplier(s)
            // $('select[name="suppliers[]" ]').val(suppliers).trigger('change');

            $('#edit_suppliers').val(suppliers).trigger('change');

            $('#modal_editproduct').modal('show');
        });
        $(document).on('click', '#view_product', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const price = $(this).data('price');
            const stock = $(this).data('stock');
            const category = $(this).data('category');
            const desc = $(this).data('description');
            const status = $(this).data('status');
            34
            const image = $(this).data('image');

            $('#view_id').text('ID: ' + id);
            $('#view_product_name').text('Name: ' + name);
            $('#view_price').text('Price: $' + price);
            $('#view_stock').text('stock: ' + stock);
            $('#view_category').text('Category: ' + category);;
            $('#view_description').text('Description: ' + desc);;
            $('#view_status').text('Status: ' + status);


            if (image) {
                $('#view_image_detail').attr('src', image).show();
            }

            $('#modal_viewproduct').modal('show');
        });

        // show product detail
        // $('#products_table tr').on('click', '#view_product', function() {
        //     var current_row = $(this).closest('tr');
        //     var id_product = current_row.find('td').eq(0).text();
        //     var product_name = current_row.find('td').eq(1).text();
        //     var product_price = current_row.find('td').eq(2).text();
        //     var product_stock = current_row.find('td').eq(3).text();
        //     var product_category = current_row.find('td').eq(5).text();
        //     var product_image = current_row.find('td').eq(6).find('img').attr('src');
        //     var product_description = current_row.find('td').eq(7).text();
        //     var product_status = current_row.find('td').eq(8).text();

        //     $('#modal_viewproduct').modal('show');
        //     $('#view_id').text('ID:' + id_product);
        //     $('#view_product_name').text('Product Name: ' + product_name);
        //     $('#view_category').text('Category:' + product_category);
        //     $('#view_price').text('Price:' + product_price);
        //     $('#view_stock').text('Stock: ' + product_stock);
        //     $('#view_status').text('Status' + product_status);
        //     $('#view_description').text('Description: ' + product_description);
        //     $('#view_image_detail').attr('src', product_image).show();

        // });



        // customer
        $('#addcustomer').click(function() {
            $('#modal_addcustomer').modal('show');
        });
        // Show toastr after reload


        // delete customer

        $(document).on('click', '#delete_customer', function() {
            const id = $(this).data('id');
            $('#id_delete_customer').val(id);
            $('#modal_deletecustomer').modal('show');
        });


        // edit Customer
        $(document).on('click', '#edit_customer', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const phone = $(this).data('phone');
            const email = $(this).data('email');
            const address = $(this).data('address');

            $('#id_edit_customer').val(id);
            $('#edit_name_customer').val(name);
            $('#edit_phone_number').val(phone);
            $('#edit_customer_email').val(email);
            $('#edit_customer_address').val(address);

            $('#modal_editcustomer').modal('show');
        });





        // delete supplier
        $('#supplier_table tr').on('click', '#delete_supplier', function() {
            var current_row = $(this).closest('tr');
            var id_supplier = current_row.find('td').eq(0).text();
            $("#modal_deletesupplier").modal("show");
            $('#id_delete_supplier').val(id_supplier);
        });


        // edit Supplier
        $('#supplier_table tr').on('click', '#edit_supplier', function() {
            var current_row = $(this).closest('tr');
            var id_supplier = current_row.find('td').eq(0).text();
            var supplier_name = current_row.find('td').eq(1).text();
            var supplier_phone = current_row.find('td').eq(2).text();
            var supplier_email = current_row.find('td').eq(3).text();
            var supplier_address = current_row.find('td').eq(4).text();

            $("#modal_editsupplier").modal('show');
            $('#id_edit_supplier').val(id_supplier);
            $("#edit_name_supplier").val(supplier_name);
            $("#edit_phone").val(supplier_phone);
            $("#edit_supplier_email").val(supplier_email);
            $("#edit_supplier_address").val(supplier_address);
        });



        // purchase
        // Auto-calculate total price when price or qty changes
        $('#purchase_price, #purchase_qty').on('input', function() {
            var price = parseFloat($('#purchase_price').val()) || 0;
            var qty = parseFloat($('#purchase_qty').val()) || 0;
            var total = price * qty;
            $('#total').val(total);
        });
        // delete purchase

        $(document).on('click', '#btndelete_purchase', function() {
            const id = $(this).data('id');
            $('#id_delete_purchase').val(id);
            $('#modal_deletepurchase').modal('show');

        });

        // Auto-calculate total price when price or qty changes
        $('#price, #qty').on('input', function() {
            var price = parseFloat($('#price').val()) || 0;
            var qty = parseFloat($('#qty').val()) || 0;
            var total = price * qty;
            $('#total_price').val(total);
        });

        // edit purchase
        $(document).on('click', '#editpurchase', function() {
            const id = $(this).data('id');
            const product = $(this).data('product');
            const qty = $(this).data('qty');
            const price = $(this).data('price');
            const totalprice = $(this).data('totalprice');
            const description = $(this).data('description');
            const status = $(this).data('status');
            const date = $(this).data('date');
            const supplier = $(this).data('supplier');
            const payment = $(this).data('payment');

            $('#edit_purchase_supplier').val(supplier);

            $('#purchase_id').val(id);
            $('#edit_products_id').val(product);
            $('#qty').val(qty);
            $('#price').val(price);
            $('#total_price').val(totalprice);
            $('#edit_description').val(description);
            $('#edit_status').val(status);
            $('#edit_purchase_payment').val(payment);
            $('#edit_purchase_date').val(date);


            $('#modal_editpurchase').modal('show');

        });

        // view purchase detail
        $(document).on('click', '#view_purchas_detail', function() {
            const id = $(this).data('id');
            const supplier = $(this).data('supplier');
            const product = $(this).data('product');
            const image = $(this).data('image');
            const qty = $(this).data('qty');
            const price = $(this).data('price');
            const totalprice = $(this).data('totalprice');
            const description = $(this).data('description');
            const payment = $(this).data('payment');
            const status = $(this).data('status');

            const date = $(this).data('date');

            $('#view_id').text(id);
            $('#view_supplier_name').text(supplier);
            $('#view_product_name').text(product);
            $('#view_qty').text(qty);
            $('#view_price').text(price);
            $('#view_total').text(totalprice);
            $('#view_description').text(description);
            $('#view_payment').text(payment);
            $('#view_status').text(status);
            $('#view_date').text(date);

            $('#view_image_detail').attr('src', image).show();

        });





        // show products image detail on modal
        $('#purchase_table tr').on('click', '#showimage', function() {
            var current_row = $(this).closest('tr');
            var imageUrl = $(this).attr('src');
            $('#show_img_product').attr('src', imageUrl);
            $("#modal_show_imageProduct").modal("show");

        });

        //end Purchase




        // delete sale

        $(document).on('click', '#delete_sale', function() {
            const id = $(this).data('id');
            $('#id_delete_sale').val(id);
            $('#modal_delete_sale').modal('show');

        });
        // edit sale

        // $(document).on('click', '#edit_sale', function() {
        //     const id = $(this).data('id');
        //     const customer = $(this).data('customer');

        //     const product = $(this).data('product');
        //     const qty = $(this).data('qty');
        //     const price = $(this).data('price');
        //     const total = $(this).data('total');
        //     const status = $(this).data('status');
        //     const date = $(this).data('date');
        //     const address = $(this).data('address');
        //     const payment = $(this).data('payment');
        //     const invoice = $(this).data('invoice');
        //     $('#edit_customer_id').change(function() {
        //         var customerId = $(this).val();

        //         // Assuming invoices is available as JSON array
        //         var customerInvoices = invoices.filter(function(inv) {
        //             return inv.customer_id == customerId;
        //         });

        //         if (customerInvoices.length > 0) {
        //             var latestInvoice = customerInvoices[customerInvoices.length - 1];
        //             $('#edit_invoice_id').val(latestInvoice.id);
        //         } else {
        //             $('#edit_invoice_id').val('');
        //         }
        //     });
        //     $('#edit_invoice_id').val(invoice);


        //     $('#id_edit_sale').val(id);
        //     $('#edit_customer_id').val(customer);
        //     $('#edit_product_id').val(product);
        //     $('#edit_sale_price').val(price);
        //     $('#edit_sale_qty').val(qty);
        //     $('#edit_total_price').val(total);
        //     $('#edit_status').val(status);
        //     $('#edit_sale_date').val(date);
        //     $('#edit_payment').val(payment);
        //     $('#edit_address').val(address);


        //     $('#modal_editsale').modal('show');

        //     // Auto-fill price when product is selected
        //     $('#edit_product_id').on('change', function() {
        //         var price = $(this).find('option:selected').data('price');
        //         $('#edit_sale_price').val(price);
        //         calculateTotal();
        //     });

        //     // Calculate total when qty changes
        //     $('#edit_sale_qty').on('input', calculateTotal);

        //     function calculateTotal() {
        //         var price = parseFloat($('#edit_sale_price').val()) || 0;
        //         var qty = parseInt($('#edit_sale_qty').val()) || 0;
        //         $('#edit_total_price').val(price * qty);
        //     }
        // });

        // edit sale
        // $('#sale_table tr').on('click', '#edit_sale', function() {
        //     var current_row = $(this).closest('tr');
        //     var id_sale = current_row.find('td').eq(1).text();
        //     var customer_name = current_row.find('td').eq(2).text();
        //     var product_name = current_row.find('td').eq(3).text();

        //     var priceText = current_row.find('td').eq(4).text();
        //     var cleanPriceText = priceText.replace(/[$\s]/g, ''); // remove $ and spaces
        //     var price = parseFloat(cleanPriceText);

        //     var qty = current_row.find('td').eq(5).text();

        //     var totalText = current_row.find('td').eq(6).text();
        //     var cleanTotalText = totalText.replace(/[$\s]/g, ''); // remove $ and spaces
        //     var total = parseFloat(cleanTotalText);

        //     var payment = current_row.find('td').eq(8).text();
        //     var sale_date = current_row.find('td').eq(9).text();
        //     var status = current_row.find('td').eq(10).text();


        //     $('#modal_editsale').modal('show');
        //     $('#id_edit_sale').val(id_sale);
        //     $('#edit_customer_id').val(customer_name);
        //     $('#edit_sale_price').val(price);
        //     $('#edit_sale_qty').val(qty);
        //     $('#edit_total_price').val(total);
        //     $('#edit_status').val(status);
        //     $('#edit_sale_date').val(sale_date);

        //     $('#edit_customer_id option').each(function() {
        //         if ($(this).text().trim() === customer_name.trim()) {
        //             $('#edit_customer_id').val($(this).val());
        //         }
        //     });
        //     $('#edit_product_id option').each(function() {
        //         if ($(this).text().trim() === product_name.trim()) {
        //             $('#edit_product_id').val($(this).val());
        //         }
        //     });
        //     $('#edit_payment option').each(function() {
        //         if ($(this).text().trim() === payment.trim()) {
        //             $('#edit_payment').val($(this).val());
        //         }
        //     });
        //     $('#edit_status option').each(function() {
        //         if ($(this).text().trim() === status.trim()) {
        //             $('#edit_status').val($(this).val());
        //         }
        //     });

        //     // Auto-fill price when product is selected
        //     $('#edit_product_id').on('change', function() {
        //         var price = $(this).find('option:selected').data('price');
        //         $('#edit_sale_price').val(price);
        //         calculateTotal();
        //     });

        //     // Calculate total when qty changes
        //     $('#edit_sale_qty').on('input', calculateTotal);

        //     function calculateTotal() {
        //         var price = parseFloat($('#edit_sale_price').val()) || 0;
        //         var qty = parseInt($('#edit_sale_qty').val()) || 0;
        //         $('#edit_total_price').val(price * qty);
        //     }
        // });


        // view sale detail



        // show products image detail on modal
        $('#sale_table tr').on('click', '#showimage', function() {
            var current_row = $(this).closest('tr');
            var imageUrl = $(this).attr('src');
            $('#show_img').attr('src', imageUrl);
            $("#modal_show_imageProduct").modal("show");
        });

        // auto invoice show
        $('#customer_id').change(function() {
            var customerId = $(this).val();

            var customerInvoices = invoices.filter(function(inv) {
                return inv.customer_id == customerId;
            });

            if (customerInvoices.length > 0) {
                var latestInvoice = customerInvoices[customerInvoices.length - 1];
                $('.invoice_id').val(latestInvoice.id);
                console.log('Invoice ID set to:', latestInvoice.id);
                console.log('Invoice Number:', latestInvoice
                    .invoice_number); // if you want to log number
            } else {
                $('.invoice_id').val('');
                console.log('No invoice found for customer ID:', customerId);
            }
        });
        $('#edit_customer_id').change(function() {
            var customerId = $(this).val();

            var customerInvoices = invoices.filter(function(inv) {
                return inv.customer_id == customerId;
            });

            if (customerInvoices.length > 0) {
                var latestInvoice = customerInvoices[customerInvoices.length - 1];
                $('.ediit_invoice_id').val(latestInvoice.id);
                console.log('Invoice ID set to:', latestInvoice.id);
                console.log('Invoice Number:', latestInvoice
                    .invoice_number); // if you want to log number
            } else {
                $('.edit_invoice_id').val('');
                console.log('No invoice found for customer ID:', customerId);
            }
        });
        // $('#edit_customer_id').on('change', function() {
        //     const customerId = $(this).val();

        //     if (customerId) {
        //         const timestamp = Date.now(); // or use a better format like yyyymmddhhmmss
        //         const invoiceId = 'INV-' + customerId + '-' + timestamp;
        //         $('#edit_invoice_id').val(invoiceId);
        //     } else {
        //         $('#edit_invoice_id').val('');
        //     }
        // });

    });

    $(document).ready(function() {
        let saleItems = [];

        function updateTable() {
            let $tbody = $('#productsTable tbody');
            $tbody.empty();
            let total = 0;

            $.each(saleItems, function(index, item) {
                let subtotal = item.price * item.quantity;
                total += subtotal;

                let row = `
                <tr>
                    <td>${item.name}<input type="hidden" name="items[${index}][product_id]" value="${item.product_id}"></td>
                    <td><input type="hidden" name="items[${index}][quantity]" value="${item.quantity}">${item.quantity}</td>
                    <td><input type="hidden" name="items[${index}][price]" value="${item.price}">$${item.price.toFixed(2)}</td>
                    <td>$${subtotal.toFixed(2)}</td>
                    <td><button type="button" class="btn btn-danger btn-sm removeBtn" data-index="${index}">Remove</button></td>
                </tr>
            `;
                $tbody.append(row);
            });

            $('#totalAmount').text(total.toFixed(2));
        }

        // Add product button click
        $('#addProductBtn').click(function() {
            let $productSelect = $('#product_id');
            let productId = $productSelect.val();
            let productName = $productSelect.find('option:selected').text();
            let price = parseFloat($productSelect.find('option:selected').data('price') || 0);
            let quantity = parseInt($('#quantity').val());

            if (!productId) {
                alert('Please select a product.');
                return;
            }
            if (isNaN(quantity) || quantity < 1) {
                alert('Please enter a valid quantity.');
                return;
            }

            // Check if product already added
            let existingIndex = saleItems.findIndex(item => item.product_id == productId);
            if (existingIndex !== -1) {
                saleItems[existingIndex].quantity += quantity;
            } else {
                saleItems.push({
                    product_id: productId,
                    name: productName,
                    price: price,
                    quantity: quantity
                });
            }

            updateTable();

            // Reset inputs
            $productSelect.val('');
            $('#quantity').val(1);
        });

        // Remove button (use event delegation because buttons are dynamic)
        $('#productsTable tbody').on('click', '.removeBtn', function() {
            let index = $(this).data('index');
            saleItems.splice(index, 1);
            updateTable();
        });
    });
</script>
