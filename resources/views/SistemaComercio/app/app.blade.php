<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('SystemComercio/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('SystemComercio/assets/img/favicon.png') }}">

  <title>
    @include('SistemaComercio.app.nombre') || @yield('tittle')
  </title>

  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  <!-- Nucleo Icons -->
  <link href="{{ asset('SystemComercio/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('SystemComercio/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <link href="{{ asset('SystemComercio/assets/css/nucleo-svg.css') }}" rel="stylesheet" />

  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('SystemComercio/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="{{ asset('SystemComercio/assets/icon/icon.js') }}" crossorigin="anonymous"></script>

  {{-- Jquery --}}
  <script src="{{ asset('SystemComercio/assets/js/plugins/jquery3.js') }}"></script>
  
  {{-- sweetalert2 --}}
  <script src="{{ asset('SystemComercio/assets/js/plugins/sweetalert2.js') }}"></script>
  
  {{-- RELS --}}
  <link href="https://cdn.datatables.net/2.1.0/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.min.css" rel="stylesheet">
  <script src="https://cdn.datatables.net/2.1.0/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.0/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>
  
</head>

<body class="g-sidenav-show   bg-gray-100">
  
  <!-- Background -->
  <div class="min-height-300 bg-success position-absolute w-100"></div>

  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <!-- Sidenav-->
    @include('SistemaComercio.app.sidenav')
    
    <hr class="horizontal dark mt-0">
    
    {{-- Menu --}}
    @include('SistemaComercio.app.navbar')
    
  </aside> 

  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('SistemaComercio.app.nav')

    <!-- End Navbar -->
    <div class="container-fluid py-4">

      @yield('contenido')

      <!-- Footer -->
      @include('SistemaComercio.app.footer')
    </div>
  </main>

  {{-- NoTocar --}}
  <div class="fixed-plugin">
    <div class="card shadow-lg">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="{{ asset('SystemComercio/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('SystemComercio/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('SystemComercio/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('SystemComercio/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('SystemComercio/assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('SystemComercio/assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>

  <script>
    // Notificaciones
    const notificacion = Swal.mixin({
                            toast: true,
                            position: "bottom-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
  </script>
  @yield('scripts')
</body>

</html>