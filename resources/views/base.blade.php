<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

		<title>Corn Maturity | Predictor</title>

		<!-- Bootstrap -->
		<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
		<link href="{{ asset('js/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="{{ asset('js/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<!-- NProgress -->
	    <link href="{{ asset('js/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
		<!-- iCheck -->
		<link href="{{ asset('js/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
		<!-- Datatables -->
		<link href="{{ asset('js/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('js/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('js/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('js/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('js/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

		<!-- Custom Theme Style -->
	    <link href="{{ asset('js/build/css/custom.min.css') }}" rel="stylesheet">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        
    <body class="nav-md">
        @yield('content')
        <!-- <script src="{{ asset('js/materials.table.js') }}" type="text/javascript"></script> -->

        <!-- jQuery -->
        <script src=" {{ asset('js/vendors/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src=" {{ asset('js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <!-- FastClick -->
       
        <!-- NProgress -->
        <script src=" {{ asset('js/vendors/nprogress/nprogress.js') }}"></script>
        <!-- iCheck -->
        <script src=" {{ asset('js/vendors/iCheck/icheck.min.js') }}"></script>
        <!-- Datatables -->
        <script src=" {{ asset('js/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
        <script src=" {{ asset('js/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/jszip/dist/jszip.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src=" {{ asset('js/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
       
        <!-- Custom Theme Scripts -->
        <script src=" {{ asset('js/build/js/custom.min.js') }}"></script>
        <script src=" {{ asset('js/batch.js') }}"></script>

        @yield('scripts')
    </body>
</html>