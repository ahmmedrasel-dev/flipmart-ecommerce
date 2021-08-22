<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend-assets/images/favicon.ico') }}">

    <title>Flipmart Admin - Dashboard</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{  asset('backend-assets/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('backend-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend-assets/css/skin_color.css') }}">

    <!-- Toastr Style-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" type="text/css"/>

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">
        {{-- Admin Header Iclude Here --}}
        @include('backend.admin-body.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('backend.admin-body.sidebar')

        <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <div class="container-full">

        <!-- Main content -->
        @yield('content')
        <!-- /.content -->
        </div>
    </div>
<!-- /.content-wrapper -->

        <!-- Footer Section Include Here -->
        @include('backend.admin-body.footer')


        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->


    <!-- Vendor JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('backend-assets/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>

    <!-- Sunny Admin App -->
    <script src="{{ asset('backend-assets/js/template.js') }}"></script>
    <script src="{{ asset('backend-assets/js/pages/dashboard.js') }}"></script>
    @yield('footer_js')

    <!-- Sunny Admin Toastr Js -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if (Session::has('message'));
        var type =  "{{ Session::get('alert-type', 'info') }}"
        switch(type){
                case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

                case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

                case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
        }
        @endif
    </script>


</body>

</html>