@extends('SistemaComercio.app.app')
@section('page', 'Modo Ventas')
@section('tittle', 'Modo Ventas')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Cajas Ventas</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="crear()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">Crear Caja Nueva</button>
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th data-priority="1">Codigo</th>
                                    <th>Estado</th>
                                    <th>Cantidad Bs</th>
                                    <th>Cantidad Dolar</th>
                                    <th>Productos Vendidos</th>
                                    <th>Facturas Realizadas</th>
                                    <th class="text-center" data-priority="2">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Estado</th>
                                    <th>Cantidad Bs</th>
                                    <th>Cantidad Dolar</th>
                                    <th>Productos Vendidos</th>
                                    <th>Facturas Realizadas</th>
                                    <th class="text-center">Accion</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="modalCRUD" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form id="formulario">
                    @csrf
                    <div id="bg-titulo" class="modal-header">
                        <h5 class="modal-title" id="titulo"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="codigo" class="form-control-label">Codigo de caja</label>
                            <input type="text" class="form-control" id="codigo" minlength="1" maxlength="255"
                                placeholder="Codigo de caja" oninput="this.value = this.value.replace(/ /g, '');" required>
                            <small class="form-text">Codigo de caja (Obligatorio)</small>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bs" class="form-control-label">Bs. Efectivo</label>
                                    <input type="number" class="form-control" id="bs" min="0"
                                        placeholder="Bs. Efectivo" required>
                                    <small class="form-text">Bs. Efectivo (Obligatorio)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dolar" class="form-control-label">Dolar Efectivo</label>
                                    <input type="number" class="form-control" id="dolar"placeholder="Dolar Efectivo"
                                        required min="0" />
                                    <small class="form-text">Dolar Efectivo (Obligatorio)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="submit" class="btn bg-gradient-success">Guardar</button>
                    </div>
                </form>
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
            ajax: '{{ route('modoVenta.lista') }}',
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
                    data: 'estado',
                    name: 'estado',
                    className: 'text-center',
                    render: function(data, type, row) {
                        if (row.estado == "Activa") {
                            return '<a href="'+row.ruta+'" target="_blank" class="badge badge-sm bg-gradient-info">Realizar Ventas</a>';
                        } else {
                            return '<span class="badge badge-sm bg-gradient-danger">Cerrada</span>';
                        }
                    }
                },
                {
                    data: 'bs',
                    name: 'bs',
                    className: 'text-center',
                },
                {
                    data: 'dolar',
                    name: 'dolar',
                    className: 'text-center',
                },
                {
                    data: 'pvendidos',
                    name: 'pvendidos',
                    className: 'text-center',
                },
                {
                    data: 'frealizadas',
                    name: 'frealizadas',
                    className: 'text-center',
                },
                {
                    "data": null,
                    "className": "align-middle text-center",
                    "render": function(data, type, row, meta) {
                        if (row.estado == "Activa") {
                            return `
                        <div class="dropdown">
                            <button class="btn btn-link text-secondary mb-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-placement="right">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:ver(${row.id});"><i class="fa fa-file text-primary"></i> Ver Datos</a></li>
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:cerrar(${row.id});"><i class="fa fa-lock text-warning"></i> Cerrar Caja</a></li>
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:eliminar(${row.id});"><i class="fa fa-trash text-danger"></i> Eliminar Caja</a></li>
                            </ul>
                        </div>`;
                        } else {
                            return `
                        <div class="dropdown">
                            <button class="btn btn-link text-secondary mb-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-placement="right">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:ver(${row.id});"><i class="fa fa-file text-primary"></i> Ver Datos</a></li>
                            </ul>
                        </div>`;
                        }
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

        // Enviar datos
        $('#formulario').submit(function(e) {
            e.preventDefault(); // Previene el recargo de la página

            var formData = new FormData(this);
            formData.append('codigo', $.trim($('#codigo').val()));
            formData.append('bs', $('#bs').val());
            formData.append('dolar', $('#dolar').val());

            $.ajax({
                url: rutaAccion,
                method: 'POST',
                data: formData,
                dataType: 'JSON',
                contentType: false,
                processData: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(data) {
                    if (data.success) {
                        table.ajax.reload(null, false);
                        if (accion === 1) {
                            notificacion.fire({
                                icon: "success",
                                title: "Caja Abierta!!",
                                text: "Puedes realizar ventas."
                            });
                        } else {
                            notificacion.fire({
                                icon: "success",
                                title: "Caja Cerrada",
                                text: "ya no puedes crear ventas en esta caja."
                            });
                        }
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "Registro no cargado.",
                            text: "Recuerda que no pueden haber 2 cajas con el mismo codigo y no se pueden eliminar cajas con operaciones dentro."
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Falla en el sistema",
                        text: "El registro no fue agregado al sistema!!",
                        icon: "error"
                    });
                }
            });

            $('#modalCRUD').modal('hide'); // Cierra el modal después de la solicitud AJAX
        });

        // ACCIONES
        crear = function() {
            rutaAccion = "{{ route('modoVenta.crear') }}";
            accion = 1;
            // reinicial Formulario
            $("#formulario").trigger("reset");
            // Editar Modal
            $("#titulo").html("Agregar Nueva Caja");
            $("#titulo").attr("class", "modal-title text-white");
            $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");



            $('#submit').show()
            $('#modalCRUD').modal('show');
        };

        ver = async function(id) {
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Ver Caja -> " + datos.codigo);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-info");

                $('#submit').hide()
                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "¡ Eliminado !",
                    text: "Tu registro no se puede ver."
                });
            }
        };

        cerrar = function(id) {
            Swal.fire({
                title: '¿ Estas seguro que desea Cerrar la caja?',
                text: "¡ No podrás revertir esto !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡ Sí, Cerrar !',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('modoVenta.estado') }}/" + id,
                        method: 'POST',
                        data: {
                            id: id
                        },
                        dataType: 'JSON',
                        cache: false,
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data) {
                            if (data.success) {
                                table.ajax.reload(null, false);
                                notificacion.fire({
                                    icon: "success",
                                    title: "¡ Cerrada !",
                                    text: "Caja Cerrada con Exito."
                                });
                            } else {
                                notificacion.fire({
                                    icon: "error",
                                    title: "¡ Error !",
                                    text: "Tu Caja no ha sido Cerrada."
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error en el sistema",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        };

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
                        url: "{{ route('modoVenta.eliminar') }}/" + id,
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

        // FIN ACCIONES
    </script>
@endsection
