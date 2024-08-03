@extends('SistemaComercio.app.app')
@section('page', 'Categoria Productos')
@section('tittle', 'Categoria Productos')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Categorias Productos</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="crear()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">Agregar Categoria</button>
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th data-priority="1">Nombres</th>
                                    <th class="text-center" data-priority="2">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombres</th>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre" class="form-control-label">Nombre Categoria</label>
                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre Categoria"
                                        minlength="3" maxlength="255" required>
                                    <small class="form-text">Nombre Categoria (Obligatorio)</small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn bg-gradient-success">Guardar</button>
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
            ajax: '{{ route('categoriaProductos.lista') }}',
            responsive: true,
            processing: true,
            serverSide: true,
            lengthMenu: [
                [5, 10],
                [5, 10],
            ],
            columns: [{
                    data: 'nombre',
                    name: 'nombre',
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
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:editar(${row.id});"><i class="fa fa-edit text-warning"></i> Editar</a></li>
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:eliminar(${row.id});"><i class="fa fa-trash text-danger"></i> Eliminar</a></li>
                            </ul>
                        </div>`;
                    },
                    "orderable": false
                },
            ],
            columnDefs: [{
                orderable: false,
                targets: [1],
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
        consulta = function(id) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ route('categoriaProductos.consulta') }}/" + id,
                    method: "GET",
                    success: function(Data) {
                        resolve(Data);
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                });
            });
        };

        // Enviar datos
        $('#formulario').submit(function(e) {
            e.preventDefault(); // Previene el recargo de la página

            var formData = new FormData(this);
            formData.append('nombre', $.trim($('#nombre').val()));

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
                    table.ajax.reload(null, false);
                    if (data.success) {
                        if (accion === 1) {
                            notificacion.fire({
                                icon: "success",
                                title: "Informacion Guardada!!",
                                text: "Registro guardado con exito."
                            });
                        } else {
                            notificacion.fire({
                                icon: "success",
                                title: "Informacion Editada!!",
                                text: "Registro Editado con exito."
                            });
                        }
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "Registro no cargado.",
                            text: "Recuerda que no pueden haber 2 Clientes con la misma cedula."
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
            rutaAccion = "{{ route('categoriaProductos.crear') }}";
            accion = 1;

            // reinicial Formulario
            $("#formulario").trigger("reset");

            // Editar Modal
            $("#titulo").html("Agregar Categoria");
            $("#titulo").attr("class", "modal-title text-white");
            $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");
            $('#modalCRUD').modal('show');
        };

        editar = async function(id) {
            rutaAccion = "{{ route('categoriaProductos.editar') }}/" + id;
            accion = 2
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Editar Categoria -> " + datos.nombre);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-warning");

                // asigancion de valores
                $("#nombre").val(datos.nombre);

                $('#modalCRUD').modal('show');
            } catch (error) {
                notificacion.fire({
                    icon: "error",
                    title: "¡ Eliminado !",
                    text: "Tu registro no se puede ver."
                });
            }
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
                        url: "{{ route('categoriaProductos.eliminar') }}/" + id,
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
