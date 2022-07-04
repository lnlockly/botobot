<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ChipBot</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- endinject -->
    @laravelViewsStyles
</head>

<body>
    <!-- partial:partials/_navbar.html -->
    @if (Session::get('message') != null)
    <div class="modal" id="modal" tabindex="-1" role="dialog" style="display:block">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Успех</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> {{ Session::get('message') }} </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo me-5" href="index.html"><img src="{{ asset('/images/logo.jpg') }}"
                    class="me-2" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="ti-view-list"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right" style="margin-right:10px">
                <li class="nav-item nav-profile dropdown" style="margin-right:10px">
                    @if (auth()->user()->current_shop != null)
                    <a class="nav-link dropdown-toggle" href="{{ route('shop.switch') }}" data-bs-toggle="dropdown" id="shopsDropdown" style="margin-right:10px">
                        <img  img="test.png" alt="{{ auth()->user()->current_shop->username  }}" />
                    </a>
                    @endif

                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
                <span class="ti-view-list"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('statistic.catalogs') }}">
                        <span class="menu-title">Мои товары</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('statistic.users') }}">
                        <span class="menu-title">Клиенты</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('statistic.orders') }}">
                        <span class="menu-title">Заказы</span>
                    </a>
                </li>
                @if(count(auth()->user()->shops) < 2)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop.create') }}">
                        <span class="menu-title">Добавить магазин</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">

            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @laravelViewsScripts
    <!-- plugins:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>

    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- End custom js for this page-->
</body>
<script>
    $('#modal').modal('toggle');
</script>

</html>
