<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{env('APP_NAME')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/main.scss') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/responsive.css') }}">
     <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  @yield('content')
</body>
<script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery-ui.js') }}"></script>
<script src="{{ asset('backend/js/popper.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('backend/js/aos.js') }}"></script>
<script src="{{ asset('backend/js/main.js') }}"></script>
<script src="{{asset('backend/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
<script>
        toastr.options = {
          "closeButton": true,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-bottom-center",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
</script>
</html>
