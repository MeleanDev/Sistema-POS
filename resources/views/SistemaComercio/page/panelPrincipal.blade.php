@extends('SistemaComercio.app.app')
@section('page', 'Panel Principal')
@section('tittle', 'Panel Principal')

@section('contenido')
    {{-- Card --}}
    <div class="row">

        {{-- Ventas Mes --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Ventas del Mes</p>
                                <h5 id="h5ventaMes" class="font-weight-bolder"></h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ventas del año --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Ventas del año</p>
                                <h5 id="h5ventaAnio" class="font-weight-bolder"></h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Faturacion Total --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Facturas Total</p>
                                <h5 id="h5fatura" class="font-weight-bolder"></h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-book-bookmark text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Clientes --}}
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Clientes</p>
                                <h5 id="h5Cliente" class="font-weight-bolder"></h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charjs -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Dinero Acumulado en Ventas</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- productos y Factura -->
    <div class="row mt-4">

        <!-- productos -->
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Top4 Producto mas Vendidos</h6>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-11">Foto</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 ps-2">Nombre
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11">
                                    Cantidad Vendida</th>
                            </tr>
                        </thead>
                        <tbody id="productos">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Factura -->
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">5 Ventas mas Alta del Año</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-11">Codigo
                                    Fact.</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-11 ps-2">Monto
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-11">
                                    Fecha</th>
                            </tr>
                        </thead>
                        <tbody id="facturas">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: "Cargando informacion...",
                text: "Espere un momento mientra se busca la informacion",
                icon: "info",
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true
            });

            // Card
            $.ajax({
                url: "{{ route('panelPrincipal.datos') }}",
                type: 'GET',
                dataType: "json",
                success: function(datos) {
                    $("#h5Cliente").html(datos.cliente);
                    $("#h5ventaMes").html(datos.ventaMes);
                    $("#h5ventaAnio").html(datos.ventasAnio);
                    $("#h5fatura").html(datos.factura);
                }
            });

            // Facturas
            $.ajax({
                url: '{{ route('panelPrincipal.facturas') }}', // Reemplaza con la ruta correcta de tu endpoint
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Limpiamos la tabla antes de agregar nuevos datos
                    $('#facturas').empty();

                    // Iteramos sobre los datos y agregamos una fila por cada factura
                    $.each(data, function(index, factura) {
                        $('#facturas').append(`
                    <tr>
                        <td>${factura.codigo}</td>
                        <td>${factura.pagado}</td>
                        <td>${factura.create_at}</td>
                    </tr>
                `);
                    });
                },
                error: function(error) {
                    console.error('Error al obtener las facturas:', error);
                }
            });

            // Productos
            $.ajax({
                url: '{{ route('panelPrincipal.productos') }}', // Reemplaza con la ruta correcta de tu endpoint
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#productos').empty();
                    // Iteramos sobre los datos y agregamos una fila por cada factura
                    $.each(data, function(index, productos) {
                        $('#productos').append(`
                    <tr>
                        <td>
                            <div class="d-flex px-3 py-1">
                                <div>
                                    <img src="${productos.foto}"
                                        class="avatar avatar-lg me-5">
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">${productos.nombre}</p>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">${productos.vendidos}</span>
                        </td>
                    </tr>
                `);
                    });
                },
                error: function(error) {
                    console.error('Error al obtener los productos:', error);
                }
            });

            // grafica
            $.ajax({
                url: '{{ route('panelPrincipal.grafica') }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    grafica(data)
                },
                error: function(error) {
                    console.error('Error al obtener los datos:', error);
                }
            });

        });

        function grafica(datos) {
            var ctx1 = document.getElementById("chart-line").getContext("2d");
            var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
            gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

            new Chart(ctx1, {
                type: "line",
                data: {
                    labels: datos.label,
                    datasets: [{
                        label: "Dinero Bs. Acumulado",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#2E7305",
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: datos.data,
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#0F0F0F',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#565656',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }
    </script>
@endsection
