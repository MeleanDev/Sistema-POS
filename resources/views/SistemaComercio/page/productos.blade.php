@extends('SistemaComercio.app.app')
@section('page', 'Productos')
@section('tittle', 'Productos')

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 text-center">
                    <h3>Productos</h3>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <button onclick="crear()" class="btn bg-gradient-primary btn-sm pb-2 ms-4">Agregar Producto</button>
                    <div class="container mt-4">
                        <table class="table align-items-center mb-0 display responsive nowrap" cellspacing="0" id="datatable"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th data-priority="1">Codigo</th>
                                    <th>Nombre</th>
                                    <th>Proveedor</th>
                                    <th>Categoria</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th class="text-center" data-priority="2">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Foto</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Proveedor</th>
                                    <th>Categoria</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
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
                        <div class="text-center">
                            <img id="preview" src="" width="150" height="150">
                        </div>
                        {{-- Foto --}}
                        <div class="form-group">
                            <label for="foto" id="fotoTitle">Foto Producto || Solo Formato (JPG Y PNG)</label>
                            <input type="file" id="foto" class="form-control" accept=".jpg,.png"
                                onchange="previewImage()" required>
                            <small class="form-text" id="fotosmall">Foto Producto (Obligatorio)</small>
                        </div>
                        <div class="row">
                            {{-- Codigo --}}
                            <div class="form-group text-center col-6">
                                <label for="codigo">Codigo del producto</label>
                                <input type="text" class="form-control" id="codigo" minlength="1" maxlength="100"
                                    placeholder="Codigo del Producto." required
                                    oninput="this.value = this.value.replace(/ /g, '');">
                                <small id="codigosmall" class="form-text">Codigo del producto (Obligatorio)</small>
                            </div>
                            {{-- Nombre --}}
                            <div class="form-group text-center col-6">
                                <label for="nombre">Nombre del producto</label>
                                <input type="text" class="form-control" id="nombre" minlength="3" maxlength="100"
                                    placeholder="Nombre del Producto." required>
                                <small id="nombresmall" class="form-text">Nombre del producto (Obligatorio)</small>
                            </div>
                        </div>
                        <div class="row">
                            {{-- Categoria --}}
                            <div class="form-group text-center col-6">
                                <label for="categoria">Categoria del Producto.</label>
                                <input type="hidden" class="form-control" id="categoriaVer" readonly>
                                <select class="form-control mb-2" id="categoria" style="width: 100%" required>
                                    <option>Seleccione una opción</option>
                                </select>
                                <small id="categoriasmall" class="form-text">Categoria del Producto (Obligatorio)</small>
                            </div>
                            {{-- Proveedor --}}
                            <div class="form-group text-center col-6">
                                <label for="proveedor">Proveedor del Producto.</label>
                                <input type="hidden" class="form-control" id="proveedorVer" readonly>
                                <select class="form-control mb-2" id="proveedor" style="width: 100%" required>
                                    <option>Seleccione una opción</option>
                                </select>
                                <small id="proveedorsmall" class="form-text">Proveedor del Producto (Obligatorio)</small>
                            </div>
                        </div>
                        {{-- Descripcion --}}
                        <div class="form-group text-center">
                            <label for="descripcion">Descripcion del Producto.</label>
                            <input type="text" class="form-control" id="descripcion" minlength="1" maxlength="100"
                                placeholder="Descripcion del Producto." required>
                            <small id="descripcionsmall" class="form-text">Descripcion del Producto (Obligatorio)</small>
                        </div>
                        {{-- Precio y Cantidad --}}
                        <div class="row mb-4">
                            <div class="col-6">
                                <label for="cantidad" class="form-label">Cantidades del Producto</label>
                                <input type="number" class="form-control" id="cantidad" required min="1"
                                    placeholder="Cantidad disponibles del producto.">
                                <small id="cantidadsmall" class="form-text">Cantidades del Producto (Obligatorio)</small>
                            </div>
                            <div class="col-6">
                                <label for="precio" class="form-label">Precio del Producto</label>
                                <input type="number" class="form-control" id="precio" required min="1"
                                    placeholder="Precio del producto.">
                                <small id="preciosmall" class="form-text">Precio del Producto (Obligatorio)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-danger text-white"
                                data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" id="submit" class="btn bg-gradient-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const selectCat = $("#categoria");
            const selectPro = $("#proveedor");

            // Categorias
            $.ajax({
                url: "{{ route('productos.CategoriaList') }}",
                type: 'GET',
                dataType: "json",
                success: function(data) {
                    data.forEach(function(item) {
                        const optionCat = new Option(item.categoriaText, item.categoriaId);
                        selectCat.append(optionCat);
                    });
                }
            });

            // Proveedor
            $.ajax({
                url: "{{ route('productos.ProveedorList') }}",
                type: 'GET',
                dataType: "json",
                success: function(data) {
                    data.forEach(function(item) {
                        const optionPro = new Option(item.proveedorText, item.proveedorId);
                        selectPro.append(optionPro);
                    });
                }
            });
        });

        var token = $('meta[name="csrf-token"]').attr('content');
        var rutaAccion = "";
        var accion = 0;

        var table = new DataTable('#datatable', {
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
                    data: 'codigo',
                    name: 'codigo',
                    className: 'text-center',
                },
                {
                    data: 'nombre',
                    name: 'nombre',
                    className: 'text-center',
                },
                {
                    data: 'proveedor',
                    name: 'proveedor',
                    className: 'text-center',
                },
                {
                    data: 'categoria',
                    name: 'categoria',
                    className: 'text-center',
                },
                {
                    data: 'cantidad',
                    name: 'cantidad',
                    className: 'text-center',
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
                        return `
                        <div class="dropdown">
                            <button class="btn btn-link text-secondary mb-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" data-bs-placement="right">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" data-id="${row.id}" href="javascript:ver(${row.id});"><i class="fa fa-file text-primary"></i> Ver</a></li>
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
                targets: [7, 0],
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
                    url: "{{ route('productos.consulta') }}/" + id,
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
            formData.append('foto', $('#foto')[0].files[0]);
            formData.append('codigo', $.trim($('#codigo').val()));
            formData.append('nombre', $.trim($('#nombre').val()));
            formData.append('descripcion', $.trim($('#descripcion').val()));
            formData.append('categoria', $('#categoria').val());
            formData.append('proveedor', $('#proveedor').val());
            formData.append('precio', $('#precio').val());
            formData.append('cantidad', $('#cantidad').val());

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
            rutaAccion = "{{ route('productos.crear') }}";
            accion = 1;

            // reinicial Formulario
            $("#formulario").trigger("reset");

            // asigancion de valores
            $("#preview").attr("src", "{{ asset('SystemComercio/assets/img/producto.webp') }}");

            $('#foto').show();
            $("#foto").attr("required", true);
            $('#fotoTitle').show();
            $('#fotosmall').show();

            $("#codigo").attr("readonly", false);
            $('#codigosmall').show();

            $("#nombre").attr("readonly", false);
            $('#nombresmall').show();


            $("#descripcion").attr("readonly", false);
            $('#descripcionsmall').show();

            $('#categoriaVer').attr('type', 'hidden');
            $('#categoriasmall').show();
            $('#categoria').show();

            $('#proveedorVer').attr('type', 'hidden');
            $('#proveedorsmall').show();
            $('#proveedor').show();

            $("#precio").attr("readonly", false);
            $('#preciosmall').show();

            $("#cantidad").attr("readonly", false);
            $('#cantidadsmall').show();

            $('#submit').show()

            // Editar Modal
            $("#titulo").html("Agregar Productos");
            $("#titulo").attr("class", "modal-title text-white");
            $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");
            $('#modalCRUD').modal('show');
        };

        ver = async function(id) {
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Ver Producto -> " + datos.codigo);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-info");

                // asigancion de valores
                $('#preview').attr("src", datos.foto);

                $('#foto').hide();
                $('#fotoTitle').hide();
                $('#fotosmall').hide();

                $("#codigo").val(datos.codigo);
                $("#codigo").attr("readonly", true);
                $('#codigosmall').hide();

                $("#nombre").val(datos.nombre);
                $("#nombre").attr("readonly", true);
                $('#nombresmall').hide();

                $("#descripcion").val(datos.descripcion);
                $("#descripcion").attr("readonly", true);
                $('#descripcionsmall').hide();

                $('#categoriaVer').attr('type', 'text');
                $("#categoriaVer").val(datos.categoria);
                $('#categoriasmall').hide();
                $('#categoria').hide();

                $('#proveedorVer').attr('type', 'text');
                $("#proveedorVer").val(datos.proveedor);
                $('#proveedorsmall').hide();
                $('#proveedor').hide();

                $("#precio").val(datos.precio);
                $("#precio").attr("readonly", true);
                $('#preciosmall').hide();

                $("#cantidad").val(datos.cantidad);
                $("#cantidad").attr("readonly", true);
                $('#cantidadsmall').hide();

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

        editar = async function(id) {
            rutaAccion = "{{ route('productos.editar') }}/" + id;
            accion = 2
            try {
                $("#formulario").trigger("reset");
                datos = await consulta(id);
                $("#titulo").html("Editar Producto -> " + datos.codigo);
                $("#titulo").attr("class", "modal-title text-white");
                $("#bg-titulo").attr("class", "modal-header bg-warning");

                // asigancion de valores
                $("#preview").attr("src", datos.foto);

                $('#foto').show();
                $("#foto").attr("required", false);
                $('#fotoTitle').show();
                $('#fotosmall').show();

                $("#codigo").attr("readonly", false);
                $("#codigo").val(datos.codigo);
                $('#codigosmall').show();

                $("#nombre").attr("readonly", false);
                $("#nombre").val(datos.nombre);
                $('#nombresmall').show();

                $("#descripcion").attr("readonly", false);
                $("#descripcion").val(datos.descripcion);
                $('#descripcionsmall').show();

                $('#categoriaVer').attr('type', 'hidden');
                $('#categoriasmall').show();
                $("#categoria").val(datos.categoria);

                $('#categoria').show();

                $('#proveedorVer').attr('type', 'hidden');
                $('#proveedorsmall').show();
                $("#proveedor").val(datos.proveedor);

                $('#proveedor').show();

                $("#precio").attr("readonly", false);
                $("#precio").val(datos.precio);
                $('#preciosmall').show();

                $("#cantidad").attr("readonly", false);
                $("#cantidad").val(datos.cantidad);
                $('#cantidadsmall').show();

                $('#submit').show()
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
                        url: "{{ route('productos.eliminar') }}/" + id,
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

        function previewImage() {
            const file = document.getElementById('foto').files[0];
            const preview = document.getElementById('preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }

        // FIN ACCIONES
    </script>
@endsection
