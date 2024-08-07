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
                                <div class="container">
                                    <div class="row">
                                        {{-- Cliente --}}
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <p class="h3">Cliente</p>
                                                <div class="mx-3">
                                                    <button class="btn bg-gradient-info btn-xs" data-bs-toggle="modal"
                                                        data-bs-target="#cliente"><i class="fa fa-plus"
                                                            aria-hidden="true"></i></button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md">
                                                    <label for="cedula" class="form-label">Cedula</label>
                                                    <select class="form-control" id="cedula" style="width: 100%">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Factura --}}
                                        <div class="col-md-8 border-start">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <p class="h3">Datos Factura</p>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label for="codigoFactura" class="form-label">Codigo Factura</label>
                                                    <input type="text" class="form-control" id="codigoFactura"
                                                        minlength="1" maxlength="255" placeholder="Codigo de Factura"
                                                        oninput="this.value = this.value.replace(/ /g, '');" required>
                                                    <small>Debe ser unico (No repetible)</small>
                                                </div>
                                                <div class="col">
                                                    <label for="monedaPago" class="form-label">Moneda de pago</label>
                                                    <select id="monedaPago" class="form-control" style="width: 100%"
                                                        required>
                                                        <option></option>
                                                        <option value="bs">Bs</option>
                                                        <option value="dolar">Dolar</option>
                                                    </select>
                                                    <small>moneda de pago del Cliente</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                {{-- Datos --}}
                                <div class="bg-dark mb-3">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <p class="h3 text-white">Informacion Factura</p>
                                    </div>
                                    <div class="row">
                                        {{-- Cliente --}}
                                        <div class="col">
                                            <h4 class="text-white">Cliente:</h4>
                                            <p class="text-white" id="nombre"></p>
                                            <p class="text-white" id="apellido"></p>
                                            <p class="text-white" id="correo"></p>
                                        </div>
                                        {{-- Factura --}}
                                        <div class="col">
                                            <h4 class="text-white">Factura: BS</h4>
                                            <p class="text-white" id="facturaCod"></p>
                                            <p class="text-white" id="pagoTotal"></p>
                                            <p class="text-white" id="pagoImpuesto"></p>
                                            <p class="text-white" id="pagoNeto"></p>
                                        </div>
                                        <div class="col">
                                            <h4 class="text-white">Factura: Dolar</h4>
                                            <p class="text-white" id="facturaCodSE"></p>
                                            <p class="text-white" id="pagoTotalSE"></p>
                                            <p class="text-white" id="pagoImpuestoSE"></p>
                                            <p class="text-white" id="pagoNetoSE"></p>
                                        </div>
                                    </div>
                                </div>



                                {{-- Productos --}}
                                <button class="btn bg-gradient-warning btn-xs" data-bs-toggle="modal"
                                    data-bs-target="#productos"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>

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
                                    </tbody>
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
        var token = $('meta[name="csrf-token"]').attr('content');
        var sumaTotal = 0;
        // const url = "{{ url()->full() }}";
        // const ultimoSegmento = url.split('/').pop();

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

        $(document).ready(function() {
            const selectOptio = $("#cedula");
            $("#cedula").select2({
                width: 'resolve',
                theme: "classic",
                placeholder: "Selecciona un CLiente",
                allowClear: true
            });

            $("#monedaPago").select2({
                width: 'resolve',
                theme: "classic",
                placeholder: "Elige Moneda de pago",
                allowClear: true
            });

            // Cliente
            $.ajax({
                url: "{{ route('puntoVenta.cedula') }}",
                type: 'GET',
                dataType: "json",
                success: function(data) {
                    $(this).empty();
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
                    notificacion.fire({
                        icon: "question",
                        title: "¡ Debe Seleccionar un Cliente !",
                        text: "Debe Seleccionar un Cliente."
                    });
                }
                $.ajax({
                    url: '{{ route('puntoVenta.consultaDatoCliente') }}/' + cliente,
                    type: 'GET',
                    dataType: "json",
                    success: function(data) {
                        $('#nombre').text("Nombre: " + data.nombre);
                        $('#apellido').text("Apellido: " + data.apellido);
                        $('#correo').text("Correo: " + data.correo);
                        montoPago();
                    }
                });
            });

            $('#monedaPago').on('change', function() {
                var moneda = $(this).val();
                if (moneda === "") {
                    // cliente = "nada";
                    notificacion.fire({
                        icon: "question",
                        title: "¡ Debe Seleccionar un moneda de pago !",
                        text: "Selecciona una moneda de pago."
                    });
                }
                // $.ajax({
                //     url: '{{ route('puntoVenta.consultaDatoCliente') }}/' + cliente,
                //     type: 'GET',
                //     dataType: "json",
                //     success: function(data) {
                //         $('#nombre').val(data.nombre + " " + data.apellido);
                //         $('#correo').val(data.correo);
                //     }
                // });
            });

            // Input cantidades producto
            $(document).on('change', '.dynamicInput', function() {
                this.value = this.value.replace(/e/gi, '');
                var inputId = $(this).attr('id');
                var inputValue = $(this).val();

                var data = {
                    id: inputId,
                    cantidad: inputValue
                };

                $.ajax({
                    url: '{{ route('puntoVenta.actualizarPago') }}',
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {

                        if (response.success) {
                            $('#precioTotal' + inputId).text(response.precioTnuevo);
                            montoPago();

                        }

                        if (response.noDisponible) {
                            $('#precioTotal' + inputId).text("Cantidad No Valida");
                            notificacion.fire({
                                icon: "error",
                                title: "¡ Cantidad No disponible !",
                                text: "solamente se permiten: " + response.maximo
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error en la petición:', error);
                    }
                });
            });
        });

        var datatableProducto = new DataTable('#datatableProducto', {
            ajax: '{{ route('productos.lista') }}',
            responsive: false,
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

        var datatableFactura = new DataTable('#datatableFactura', {
            ajax: '{{ route('puntoVenta.consultaProductosF') }}',
            paging: false,
            searching: false,
            info: false,
            ordering: false,
            responsive: false,
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
                    render: function(data, type, row, meta) {
                        return '<input type="number" value="' + row.cantidad +
                            '" class="dynamicInput" id="' + row.id +
                            '" step="0.01" min="0" max="' + row.cantidadMaxima +
                            '" pattern="^\d+(\.\d{1,2})?$">';
                    }
                },
                {
                    data: 'precio',
                    name: 'precio',
                    className: 'text-center',
                },
                {
                    data: 'precioTotal',
                    name: 'precioTotal',
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        return '<p id="precioTotal' + row.id + '">' + row.precioTotal + '</p>';
                    }
                },
                {
                    "data": null,
                    "className": "align-middle text-center",
                    "render": function(data, type, row, meta) {
                        if (row.cantidad > 0) {
                            return `<a data-id="${row.id}" href="javascript:eliminarProducFactu(${row.id});" class="btn bg-gradient-danger btn-xs"><i
                                        class="fa fa-trash" aria-hidden="true"></i></a>
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

        // Acciones

        // MontoPagar
        function montoPago() {
            $.ajax({
                url: '{{ route('puntoVenta.montoPago') }}',
                type: 'GET',
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        $('#pagoTotal').text("pago Total: $" + data.pagoTotal);
                        $('#pagoImpuesto').text("Impuestos: " + data.pagoImpuesto);
                        $('#pagoNeto').text("Pago Neto: $" + data.pagoNeto);
                        $('#pagoTotalSE').text("pago Total: $" + data.pagoTotalSegundaMoneda);
                        $('#pagoImpuestoSE').text("Impuestos: " + data.pagoImpuestoSegundaMoneda);
                        $('#pagoNetoSE').text("Pago Neto: $" + data.pagoNetoSegundaMoneda);
                    }
                    if (data.error) {
                        $('#pagoTotal').text("pago Total: $N");
                        $('#pagoImpuesto').text("Impuestos: $N");
                        $('#pagoNeto').text("Pago Neto: $N");
                    }
                }
            });
        }

        // Agregar Product Factura
        agregarProducFactu = function(idProd) {
            $.ajax({
                url: '{{ route('puntoVenta.agregarProducF') }}',
                method: 'post',
                data: {
                    idProduct: idProd
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(data) {
                    if (data.success) {
                        datatableFactura.ajax.reload(null, false);
                        montoPago();
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "¡ No agregado !",
                            text: "Tu Producto no ha sido agregado."
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Problema en el sistema');
                }
            });
        };

        // Eliminar Product Factura
        eliminarProducFactu = function(id) {
            Swal.fire({
                title: '¿ Estas seguro que desea eliminar el producto?',
                text: "¡ Seguro?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡ Sí, bórralo !',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('puntoVenta.eliminarProducF') }}/" + id,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data) {
                            if (data.success) {
                                datatableFactura.row('#' + id).remove().draw();
                                montoPago();
                                notificacion.fire({
                                    icon: "success",
                                    title: "¡ Eliminado !",
                                    text: "Tu Producto ha sido eliminado."
                                });
                            } else {
                                notificacion.fire({
                                    icon: "error",
                                    title: "¡ Error !",
                                    text: "Tu Producto no ha sido eliminado."
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error en el sistema",
                                text: "El Producto no fue agregado al sistema!!",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>
