@extends('SistemaComercio.app.app')
@section('page', 'Facturas')
@section('tittle', 'Facturas')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Facturas</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0"
                            id="datatable" style="width: 100%">
                            <thead>
                                <tr>
                                    <th data-priority="1">Codigo</th>
                                    <th>Cliente</th>
                                    <th>Monto</th>
                                    <th>Metodo Pago</th>
                                    <th>Cantidad Productos</th>
                                    <th>IVA</th>
                                    <th>Fecha y Hora</th>
                                    <th class="text-center" data-priority="2">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Cliente</th>
                                    <th>Monto</th>
                                    <th>Metodo Pago</th>
                                    <th>Cantidad Productos</th>
                                    <th>IVA</th>
                                    <th>Fecha y Hora</th>
                                    <th class="text-center">Accion</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        var rutaAccion = "";
        var accion = 0;

        var table = new DataTable('#datatable', {
            ajax: '{{ route('facturas.lista') }}',
            responsive: true,
            processing: true,
            serverSide: true,
            lengthMenu: [
                [5, 10],
                [5, 10],
            ],
            columns: [{
                    data: 'codigo',
                    name: 'codigo',
                    className: 'text-center',
                },
                {
                    data: 'cliente',
                    name: 'cliente',
                    className: 'text-center',
                },
                {
                    data: 'pagado',
                    name: 'pagado',
                    className: 'text-center',
                },
                {
                    data: 'metodoPago',
                    name: 'metodoPago',
                    className: 'text-center',
                },
                {
                    data: 'productos',
                    name: 'productos',
                    className: 'text-center',
                },
                {
                    data: 'iva',
                    name: 'iva',
                    className: 'text-center',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    className: 'text-center',
                },
                {
                    "data": null,
                    "className": "align-middle text-center",
                    "render": function(data, type, row, meta) {
                        return `
                        <div class="dropdown">
                            <button class="btn btn-link text-secondary mb-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-placement="right">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:editar(${row.id});"><i class="fa fa-download text-primary"></i> Descargar</a></li>
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:eliminar(${row.id});"><i class="fa fa-trash text-danger"></i> Eliminar</a></li>
                            </ul>
                        </div>`;
                    },
                    "orderable": false
                },
            ],
            columnDefs: [{
                orderable: false,
                targets: [6],
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

        //  Consultas EndPoint
        // consulta = function(id) {
        //     return new Promise((resolve, reject) => {
        //         $.ajax({
        //             url: "/" + id,
        //             method: "GET",
        //             success: function(Data) {
        //                 resolve(Data);
        //             },
        //             error: function(xhr, status, error) {
        //                 reject(error);
        //             }
        //         });
        //     });
        // };

        eliminar = function(id) {
            Swal.fire({
                title: '¿ Estas seguro que desea eliminar el registro?',
                text: "¡ No podrás revertir esto !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡ Sí, bórralo !',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('facturas.eliminar') }}/" + id,
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data) {
                            if (data.success) {
                                table.row('#' + id).remove().draw();
                                // Mostrar mensaje de éxito con temporizador
                                notificacion.fire({
                                    icon: "success",
                                    title: "¡ Eliminado !",
                                    text: "Tu registro ha sido eliminado."
                                });
                            } else {
                                notificacion.fire({
                                    icon: "error",
                                    title: "¡ Error !",
                                    text: "Tu registro no ha sido eliminado."
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error en el sistema",
                                text: "El registro no fue agregado al sistema!!",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        };

    </script>
@endsection