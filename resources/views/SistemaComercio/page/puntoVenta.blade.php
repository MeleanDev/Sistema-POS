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
        @include('SistemaComercio.app.nombre') || Punto de Venta
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body class="g-sidenav-show   bg-gray-100" style="height: 100%">

    <!-- Background -->
    <div class="min-height-300 bg-success position-absolute w-100"></div>

    <main class="main-content position-relative border-radius-lg ">

        <!-- End Navbar -->
        <div class="container-fluid py-4">

            {{-- ContenidoAqui --}}
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 text-center">
                            <h3>Punto de Venta</h3>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="container mt-4">
                                <hr class="horizontal dark">
                                <div class="d-flex justify-content-center align-items-center">
                                    <p class="h3">Cliente</p>
                                    <div class="mx-3">
                                        <button class="btn bg-gradient-info btn-xs" data-bs-toggle="modal"
                                            data-bs-target="#cliente"><i class="fa fa-plus"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>

                                <div class="row justify-content-md-center">
                                    <div class="col-auto">
                                        <label for="cedula" class="form-label">Cedula</label>
                                        <select class="form-control" id="cedula" style="width: 80%">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <label for="nombre" class="form-label">Nombre y Apellido</label>
                                        <input readonly id="nombre" class="form-control-plaintext"
                                            class="form-control">
                                    </div>
                                    <div class="col-auto">
                                        <label for="correo" class="form-label">Correo</label>
                                        <input id="correo" readonly class="form-control-plaintext"
                                            class="form-control">
                                    </div>
                                </div>

                                <hr class="horizontal dark">

                                {{-- Productos --}}
                                <button class="btn bg-gradient-warning btn-xs" data-bs-toggle="modal"
                                    data-bs-target="#productos"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0"
                                    id="datatableFactura" style="width: 100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Foto</th>
                                            <th data-priority="1">Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unidad</th>
                                            <th>Precio Total</th>
                                            <th data-priority="2">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>Foto</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unidad</th>
                                            <th>Precio Total</th>
                                            <th>Accion</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modales Agregar Productos --}}
            <div class="modal fade" id="productos" tabindex="-1" role="dialog" aria-labelledby="productos"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="formularioProducto">
                            @csrf
                            <div class="modal-header bg-gradient-warning">
                                <h5 class="modal-title text-white">Agregar Productos</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0"
                                    id="datatableProducto" style="width: 100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Foto</th>
                                            <th data-priority="1">Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th data-priority="2">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>Foto</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Accion</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-danger text-white"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modales Agregar Cliente --}}
            <div class="modal fade" id="cliente" tabindex="-1" role="dialog" aria-labelledby="cliente"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        @csrf
                        <div class="modal-header bg-gradient-info">
                            <h5 class="modal-title text-white">Agregar Cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">


                            <div class="modal-footer">
                                <button type="button" class="btn bg-danger text-white"
                                    data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('SistemaComercio.app.footer')
        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="{{ asset('SystemComercio/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('SystemComercio/assets/js/core/bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            const selectOptio = $("#cedula");
            $("#cedula").select2({
                width: 'resolve',
                theme: "classic",
                placeholder: "Selecciona un CLiente",
                allowClear: true
            });

            // Cliente
            $.ajax({
                url: "{{ route('puntoVenta.cedula') }}",
                type: 'GET',
                dataType: "json",
                success: function(data) {
                    data.forEach(function(item) {
                        const option = new Option(item.cedulaText, item.cedula);
                        selectOptio.append(option);
                    });
                }
            });

            $('#cedula').on('change', function() {
                var cliente = $(this).val();
                if (cliente === "") {
                    cliente = 0;
                }
                $.ajax({
                    url: '{{ route('puntoVenta.consultaDatoCliente') }}/' + cliente,
                    type: 'GET',
                    dataType: "json",
                    success: function(data) {
                        $('#nombre').val(data.nombre + " " + data.apellido);
                        $('#correo').val(data.correo);
                    }
                });
            });
        });

        var table = new DataTable('#datatableProducto', {
            ajax: '{{ route('productos.lista') }}',
            responsive: true,
            processing: true,
            serverSide: true,
            lengthMenu: [
                [5, 10],
                [5, 10],
            ],
            columns: [{
                    data: 'foto',
                    name: 'foto',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (row.foto) {
                            return '<img src="' + row.foto + '" width="100" height="100">';
                        } else {
                            return '<span class="text-muted">Imagen no disponible</span>';
                        }
                    }
                },
                {
                    data: 'nombre',
                    name: 'nombre',
                    className: 'text-center',
                },
                {
                    data: 'cantidad',
                    name: 'cantidad',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (row.cantidad > 0) {
                            return row.cantidad;
                        } else {
                            return '<span class="badge badge-sm bg-gradient-danger">No Hay</span>';
                        }
                    }
                },
                {
                    data: 'precio',
                    name: 'precio',
                    className: 'text-center',
                },
                {
                    "data": null,
                    "className": "align-middle text-center",
                    "render": function(data, type, row, meta) {
                        if (row.cantidad > 0) {
                            return `<a data-id="${row.id}" href="javascript:agregarProducFactu(${row.id});" class="btn bg-gradient-warning btn-xs"><i
                                        class="fa fa-plus" aria-hidden="true"></i></a>
                        `;
                        } else {
                            return '<span class="badge badge-sm bg-gradient-danger"><i class="fa fa-ban" aria-hidden="true"></i></span>';
                        }

                    },
                    "orderable": false
                },
            ],
            columnDefs: [{
                orderable: false,
                targets: [4, 0],
                responsivePriority: 1,
                responsivePriority: 2,

            }],
            language: {
                "zeroRecords": "No se encontraron resultados",
                "emptyTable": "Ningún dato disponible en esta tabla",
                "lengthMenu": "Mostrar _MENU_ registros",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },
        });

        function agregarProducFactu(id) {
            
            
        }
    </script>
</body>

</html>
