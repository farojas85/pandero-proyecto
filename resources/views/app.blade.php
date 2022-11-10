<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <title>{{ config('app.name', 'Sistema Sufragio') }}</title>

        {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}"> --}}

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
        <!-- ICheck Bootstrap-->
        <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- SweetAlert2 -->
        {{-- <link rel="stylesheet" href="adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> --}}
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="adminlte/plugins/daterangepicker/daterangepicker.css">

        @routes
        @vite('resources/js/app.js')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed" translate="no">
        <div class="wrapper" id="wrapper">
            <App></App>
        </div>

        <!-- jQuery -->
        <script src="adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
         {{-- <script src="adminlte/plugins/sweetalert2/sweetalert2.min.js"></script> --}}
        <script src="adminlte/plugins/moment/moment.min.js"></script>
        <script src="adminlte/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="adminlte/dist/js/adminlte.js"></script>

        <script>
            function idleLogout() {
                var t;
                window.onload = resetTimer;
                window.onmousemove = resetTimer;
                window.onmousedown = resetTimer;  // catches touchscreen presses as well
                window.ontouchstart = resetTimer; // catches touchscreen swipes as well
                window.onclick = resetTimer;      // catches touchpad clicks as well
                window.onkeypress = resetTimer;
                window.addEventListener('scroll', resetTimer, true); // improved; see comments

                function yourFunction() {
                    // your function for too long inactivity goes here
                    // e.g. window.location.href = 'logout.php';
                        window.location.href= '/'
                }

                function resetTimer() {
                    clearTimeout(t);
                    t = setTimeout(yourFunction, 10000);  // time is in milliseconds
                }
            }
            //idleLogout();
        </script>
    </body>
</html>
