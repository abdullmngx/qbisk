<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success</title>

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="/assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="/assets/css/feather-icon.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/sweetalert2.css">
    @yield('css-links')
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link id="color" rel="stylesheet" href="/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">
</head>
<body>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h1>
                                <i class="fa fa-exclamation-triangle fa-4x text-warning">

                                </i>
                            </h1>
                            <h4>Your payment could not be verified, refresh this page to try again or click the button below to return to invoice</h4>
                            <p>
                                <a href="{{ url()->previous() }}" class="btn btn-primary">Back to invoice</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="/assets/js/sidebar-menu.js"></script>
    <script src="/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="/assets/js/bootstrap/popper.min.js"></script>
    <script src="/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="/assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="/assets/js/chart/apex-chart/moment.min.js"></script>
    <script src="/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="/assets/js/chart/apex-chart/stock-prices.js"></script>
    @yield('script-src')
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/assets/js/script.js"></script>
    <script>
      if (sessionStorage.getItem('theme'))
      {
        $('body').addClass(sessionStorage.getItem('theme'))
        if (sessionStorage.getItem('theme') == "dark-only")
        {
          document.querySelector('div.mode i').classList.remove('fa-moon-o')
          document.querySelector('div.mode i').classList.add('fa-lightbulb-o')
        }
      }
      $('.dark-toggle').click(function() {
        if (sessionStorage.getItem('theme'))
        {
          if (sessionStorage.getItem('theme') == "light-only")
          {
            sessionStorage.setItem('theme', 'dark-only')
          }else
          {
            sessionStorage.setItem('theme', 'light-only')
          }
        }else
        {
          sessionStorage.setItem('theme', 'dark-only')
        }
      })
    </script>
    @yield('scripts')
    <!-- login js-->
    <!-- Plugin used-->
</body>
</html>
