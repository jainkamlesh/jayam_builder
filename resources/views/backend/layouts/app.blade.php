<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME')}}</title>

  <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('backend/css/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/magnific-popup.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/jquery-ui.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/aos.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('backend/css/responsive.css')}}">
   <!-- Toastr CSS -->
  <link rel="stylesheet" href="{{asset('backend/css/toastr/toastr.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<div class="site-wrap">
    @include('backend.inc.nav')
    @yield('content')
</div>

  <script src="{{asset('backend/js/jquery-3.3.1.min.js')}}"></script>
  <script src="{{asset('backend/js/jquery-ui.js')}}"></script>
  <script src="{{asset('backend/js/popper.min.js')}}"></script>
  <script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('backend/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('backend/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('backend/js/aos.js')}}"></script>
  <script src="{{asset('backend/js/main.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
  <script src="https://cdn2.hubspot.net/hubfs/476360/Chart.js"></script>
  <script src="https://cdn2.hubspot.net/hubfs/476360/utils.js"></script>
  <script src="{{asset('backend/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
  <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });

     $('.printMe').click(function(){
        window.print()
      });

    $(".animated-progress span").each(function () {
      $(this).animate(
        {
          width: $(this).attr("data-progress") + "%",
        },
        1000
      );
      $(this).text($(this).attr("data-progress") + "%");
    });


    var ctx = document.getElementById("myChart2").getContext('2d');
      var myChart2 = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["M", "T", "W", "T", "F", "S", "S"],
          datasets: [{
            label: 'apples',
            data: [12, 19, 3, 17, 28, 24, 7],
            backgroundColor: "#543a9b"
          }, {
            label: 'oranges',
            data: [30, 29, 5, 5, 20, 3, 10],
            backgroundColor: "#ff7c48"
          }]
        }
      });

      var ctx = document.getElementById("myChart2").getContext('2d');



  </script>

  <script>
    var config = {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [{
        label: 'APAC RE Index',
        backgroundColor: window.chartColors.backgroundColor="#ff7c48",
        borderColor: window.chartColors.backgroundColor="#ff7c48",
        fill: false,
        data: [
          10,
          20,
          30,
          40,
          100,
          50,
          150
          /*randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor()*/
        ],
      }, {
        label: 'APAC PME',
        backgroundColor: window.chartColors.backgroundColor="#543a9b",
        borderColor: window.chartColors.backgroundColor="#543a9b",
        fill: false,
        data: [
          50,
          300,
          100,
          450,
          150,
          200,
          300
        ],
    
      }]
    },
    options: {
      responsive: true,
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Date'
          },
      
        }],
        yAxes: [{
          display: true,
          //type: 'logarithmic',
          scaleLabel: {
              display: true,
              labelString: 'Index Returns'
            },
            ticks: {
              min: 0,
              max: 500,

              // forces step size to be 5 units
              stepSize: 100
            }
        }]
      }
    }
  };

  window.onload = function() {
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myLine = new Chart(ctx, config);
  };

  document.getElementById('randomizeData').addEventListener('click', function() {
    config.data.datasets.forEach(function(dataset) {
      dataset.data = dataset.data.map(function() {
        return randomScalingFactor();
      });

    });
    window.myLine.update();
  });
  </script>
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
</body>
</html>