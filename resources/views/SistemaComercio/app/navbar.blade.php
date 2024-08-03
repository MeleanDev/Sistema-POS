<div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">

    <ul class="navbar-nav">

      {{-- Panel Principal --}}
      <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() === 'dashboard') active @endif" href="{{route('dashboard')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Panel Principal</span>
        </a>
      </li>

      {{-- Empresa Datos --}}
      <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() === 'empresa.Datos') active @endif" href="{{route('empresa.Datos')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-briefcase-24 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Empresa Datos</span>
        </a>
      </li>

      {{-- Modo Ventas --}}
      <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() === 'modoVenta') active @endif" href="{{route('modoVenta')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-shop text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Modo Ventas</span>
        </a>
      </li>

      {{-- Analisis Ventas --}}
      <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() === 'analisisComercio') active @endif" href="{{route('analisisComercio')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-chart-bar-32 text-success text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Analisis de Comercio</span>
        </a>
      </li>

      {{-- Facturas --}}
      <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() === 'facturas') active @endif" href="{{route('facturas')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-book-bookmark text-secondary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Faturas</span>
        </a>
      </li>

      {{-- Clientes --}}
      <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() === 'clientes') active @endif" href="{{route('clientes')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-single-02 text-info text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Clientes</span>
        </a>
      </li>

      {{-- Reabastecimiento --}}
      <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() === 'reabastecimiento') active @endif" href="{{route('reabastecimiento')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-basket text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Reabastecimiento</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Stock</h6>
      </li>

      {{-- Productos --}}
      <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() === 'productos') active @endif" href="{{route('productos')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-box-2 text-danger text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Productos</span>
        </a>
      </li>

      {{-- Categoria Productos --}}
      <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() === 'categoriaProductos') active @endif" href="{{route('categoriaProductos')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Categoria Producto</span>
        </a>
      </li>

      {{-- Proveedor Productos --}}
      <li class="nav-item">
        <a class="nav-link @if(Route::currentRouteName() === 'proveedorProductos') active @endif" href="{{route('proveedorProductos')}}">
          <div class="icon icon-badge icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-truck text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Proveedor Producto</span>
        </a>
      </li>

      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Configuracion Cuenta</h6>
      </li>
      
      {{-- <li class="nav-item">
        <a class="nav-link " href="">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-circle-08 text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Profile</span>
        </a>
      </li> --}}

      {{-- Configuracion --}}
      {{-- <li class="nav-item">
        <a class="nav-link" href="">
          <div class="icon icon-badge icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-settings text-warning text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Configuracion</span>
        </a>
      </li> --}}

      {{-- Cerrar Sesion --}}
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a class="nav-link " href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-button-power text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Cerrar Sesión</span>
          </a>
        </form>
      </li>

    </ul>
  
</div>