
<!DOCTYPE html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @if (env('IS_DEMO'))
      <x-demo-metas></x-demo-metas>
  @endif

  <link rel="" sizes="76x76" href="{{ url('assets/img/user.png') }}">
  <link rel="icon" type="image/png" href="{{ url('assets/img/pup-logo.png') }}">
  <title>
   AROtrack System
  </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ url('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ url('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-AWe0I5vVpFY4Fgo7GU85L6oN/e6jvHkX4bXC5ZzBzw+ndEw/q4oxeFpdnKmnv2ZZ9J7F08m7JFDrx4BW8jq+1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="{{ url('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ url('assets/css/docu2.css?v=1.0.3') }}" rel="stylesheet" />
</head>
  @auth
    @yield('auth')
  @endauth
  @guest
    @yield('guest')
  @endguest

  @if(session()->has('success'))
    <div x-data="{ show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="position-fixed bg-success rounded right-3 text-sm py-2 px-4 bottom-0 m-3" style="z-index: 99999; ">
      <p class="m-0">{{ session('success')}}</p>
    </div>
  @endif
    <!--   Core JS Files   -->
  <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <!-- <script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ url('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ url('assets/js/plugins/fullcalendar.min.js') }}"></script>
  <script src="{{ url('assets/js/plugins/chartjs.min.js') }}"></script> -->
  @stack('dashboard')
  <!-- <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script> -->

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js') }}"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ url('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
  <script src="{{ url('assets/vendor/fslightbox-basic-3.4.1/fslightbox.js') }}"></script>
</body>

</html>
