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
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <!-- endinject -->
    @laravelViewsStyles

</head>

<body>
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo me-5"><img src="{{ asset('/images/icon.svg') }}"
                                                           class="me-2" alt="logo" /></a>
              <a class="navbar-brand brand-logo-mini"><img src="{{ asset('/images/icon.svg') }}" /></a>
          </div>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users') }}">
              <span class="menu-title">Пользователи</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.mailing.create') }}">
              <span class="menu-title">Рассылка</span>
            </a>
          </li>
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
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->

    <footer>
        <div class="wraper">
            <div class="footer-block">
            </div>
            <div class="footer-links">
                <div class="footer-links-logo">

                </div>
                <div class="footer-link1">
                    <div class="footer-padding"><h1>Chipbot</h1></div>
                    <ul>
                        <li><a href="#">О компании</a></li>
                        <li><a href="#">Контакты</a></li>
                        <li><a href="#">Новости</a></li>
                        <li><a href="#">Пользовательское соглашение</a></li>
                    </ul>
                </div>
                <div class="footer-link2">
                    <div class="footer-padding"><h1>Услуги</h1></div>
                    <div class="footer-ul"><ul>
                            <li><a href="#">Telegram магазина под ключ</a></li>
                            <li><a href="#">Интеграция интернет-магазина с telegram</a></li>
                        </ul></div>
                </div>
                <div class="footer-link3">
                    <div class="footer-padding"><h1>Помощь</h1></div>
                    <div class="footer-ul"><ul>
                            <li><a href="#">База знаний</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul></div>
                </div>
                <div class="footer-link4">
                    <div class="footer-padding"><h1>Способы оплаты</h1></div>
                    <div class="footer-ul">

                        <a href="#">Подробнее о способах оплаты</a>
                        <ul>
                            <li><h6>ИП Иванцов А.А.</h6></li>
                            <li><h6>ИНН: 616806543687</h6></li>
                            <li><h6>ОГРНИП:321619600227803</h6></li>
                            <li><h6>ОКПО: 2012163842</h6></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>

