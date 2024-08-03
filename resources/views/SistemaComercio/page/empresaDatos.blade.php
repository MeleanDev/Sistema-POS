@extends('SistemaComercio.app.app')
@section('page', 'Empresa Datos')
@section('tittle', 'Empresa Datos')

@section('contenido')

    <div class="row">
        <div class="col-md-8">
            <form id="formulario" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Editar Datos de la Empresa</p>
                            <button type="submit" class="btn bg-gradient-primary btn-sm ms-auto">Guardar Cambios</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">Empresa Informacion</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nempresa" class="form-control-label">Nombre Empresa</label>
                                    <input class="form-control" readonly id="nempresa" type="text"
                                        placeholder="Ejemplo: Sonic A.C" required minlength="4" maxlength="255">
                                    <small class="form-text">Nombre la empresa</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rif" class="form-control-label">Cedula/Rif</label>
                                    <input class="form-control" readonly id="rif" type="text"
                                        placeholder="Ejemplo: J/V-3131231" required minlength="5" maxlength="50">
                                    <small class="form-text">Rif o Cedula.</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rsocial" class="form-control-label">Razon Social</label>
                                <input class="form-control" readonly id="rsocial" type="text"
                                    placeholder="Razon Social." required minlength="4" maxlength="255">
                                <small class="form-text">Razon Social de la Empresa.</small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo" class="form-control-label">Correo Electronico</label>
                                    <input class="form-control" readonly id="correo" type="email"
                                        placeholder="Ejemplo: empresa@gmail.com" required maxlength="255">
                                    <small class="form-text">Correo Electronico.</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono" class="form-control-label">Numero Telefono</label>
                                    <input class="form-control" readonly id="telefono" type="text"
                                        placeholder="Ejemplo: +58-3123123213" required minlength="8" maxlength="20">
                                    <small class="form-text">Numero de Telefono.</small>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Datos de la Direccion</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="direccion" class="form-control-label">Direccion</label>
                                    <input class="form-control" readonly id="direccion" type="text"
                                        placeholder="Ejemplo: Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" required
                                        minlength="5" maxlength="255">
                                    <small class="form-text">Direccion de la Empresa.</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pais" class="form-control-label">Pais</label>
                                    <input class="form-control" readonly id="pais" type="text"
                                        placeholder="Ejemplo: Venezuela" required minlength="3" maxlength="50">
                                    <small class="form-text">Pais.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado" class="form-control-label">Estado</label>
                                    <input class="form-control" readonly id="estado" type="text"
                                        placeholder="Ejemplo: Zulia" required minlength="3" maxlength="50">
                                    <small class="form-text">Estado.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ciudad" class="form-control-label">Ciudad</label>
                                    <input class="form-control" readonly id="ciudad" type="text"
                                        placeholder="Ejemplo: Maracaibo" required minlength="3" maxlength="50">
                                    <small class="form-text">Ciudad.</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cpostal" class="form-control-label">Codigo Postal</label>
                                    <input class="form-control" readonly id="cpostal" type="text"
                                        placeholder="Ejemplo: 437300" required minlength="3" maxlength="20">
                                    <small class="form-text">Codigo Postal.</small>
                                </div>
                            </div>
                        </div>
                        {{-- <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Opcional</p>
                    <div class="row">
                        <div class="col-md-12">
                            
                        </div>
                    </div> --}}
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <img src="" id="foto" height="300px" class="card-img-top">
                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                    <div class="d-flex justify-content-center">
                        <button onclick="subirF()" class="btn btn-sm bg-gradient-primary mb-0 d-lg-block">
                            Cambiar Logo
                        </button>
                    </div>
                </div>
                <hr class="horizontal dark">
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="fotoModal" tabindex="-1" role="dialog" aria-labelledby="fotoModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="formularioFoto" enctype="multipart/form-data">
                    <div class="modal-header bg-gradient-primary">
                        <h5 class="modal-title text-white">Logo de la Empresa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="text-center">
                            <img id="preview" width="200px" class="rounded mx-auto d-block mb-3" src="">
                            <div class="input-group">
                                <input type="file" class="form-control" id="inputFoto" accept=".jpg,.png" required
                                    onchange="previewImage()">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            Swal.fire({
                itle: "Cargando informacion...",
                text: "Espere un momento mientra se busca la informacion",
                icon: "info",
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true
            });
            cargarDatos();
        });

        // Carga los datos de la empresa
        function cargarDatos() {
            $.ajax({
                url: "{{ route('empresa.Datos.datos') }}", // URL del endpoint que devuelve los datos
                type: "GET", // Método de la solicitud (GET o POST)
                dataType: "json", // Tipo de respuesta esperado (JSON)
                success: function(data) {
                    if (data.success) {
                        // Cargamos los datos a los input
                        var valor = data.datos.fotoURL;
                        var resultado = valor != null ? valor :'{{ asset('SystemComercio/assets/img/StockGoCompleto.png') }}';

                        $("#nempresa").val(data.datos.nempresa);
                        $("#rif").val(data.datos.rif);
                        $("#rsocial").val(data.datos.rsocial);
                        $("#correo").val(data.datos.correo);
                        $("#telefono").val(data.datos.telefono);
                        $("#direccion").val(data.datos.direccion);
                        $("#pais").val(data.datos.pais);
                        $("#estado").val(data.datos.estado);
                        $("#ciudad").val(data.datos.ciudad);
                        $("#cpostal").val(data.datos.cpostal);
                        $("#foto").attr("src", resultado);

                        // Quitar el redoly luego de cargar los datos
                        $("#nempresa").attr("readonly", false);
                        $("#rif").attr("readonly", false);
                        $("#rsocial").attr("readonly", false);
                        $("#correo").attr("readonly", false);
                        $("#telefono").attr("readonly", false);
                        $("#direccion").attr("readonly", false);
                        $("#pais").attr("readonly", false);
                        $("#estado").attr("readonly", false);
                        $("#ciudad").attr("readonly", false);
                        $("#cpostal").attr("readonly", false);
                    } else {
                        Swal.fire({
                            title: "Falla en el sistema",
                            text: "Error al solicitar datos a la base de dato!!",
                            icon: "error"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: "Falla en el sistema",
                        text: "Error al solicitar datos a la base de dato!!",
                        icon: "error"
                    });
                }
            });
        }

        // token
        var token = $('meta[name="csrf-token"]').attr('content');

        // Guardar datos de la empresa
        $('#formulario').submit(function(e) {
            e.preventDefault(); // Previene el recargo de la página

            // Datos de los Formularios
            var formData = new FormData(this);
            formData.append('nempresa', $.trim($('#nempresa').val()));
            formData.append('rif', $.trim($('#rif').val()));
            formData.append('rsocial', $.trim($('#rsocial').val()));
            formData.append('correo', $.trim($('#correo').val()));
            formData.append('telefono', $.trim($('#telefono').val()));
            formData.append('direccion', $.trim($('#direccion').val()));
            formData.append('pais', $.trim($('#pais').val()));
            formData.append('estado', $('#estado').val());
            formData.append('ciudad', $('#ciudad').val());
            formData.append('cpostal', $('#cpostal').val());

            // Envio de datos
            $.ajax({
                url: "{{ route('empresa.Datos.subir') }}",
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
                        notificacion.fire({
                            icon: "success",
                            title: "Informacion Guardada!!",
                            text: "Registro guardado con exito."
                        });
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "Error en los Datos!!",
                            text: "Registro no cargado."
                        });
                    }
                },
                error: function(xhr, status, error) {
                    notificacion.fire({
                        icon: "error",
                        title: "Rellena los Datos Correctamente!!",
                        text: "Registro no Guardado."
                    });
                }
            });
        });

        // Guardar Foto de la empresa
        $('#formularioFoto').submit(function(e) {
            e.preventDefault(); // Previene el recargo de la página

            // foto del Formularios
            var formData = new FormData(this);
            formData.append('foto', $('#inputFoto')[0].files[0]);

            // Envio de datos
            $.ajax({
                url: "{{ route('empresa.Datos.foto') }}",
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
                        notificacion.fire({
                            icon: "success",
                            title: "Informacion Guardada!!",
                            text: "Registro guardado con exito."
                        });
                        cargarDatos();
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "Error en la subida de la foto",
                            text: "Registro no cargado."
                        });
                    }
                },
                error: function(xhr, status, error) {
                    notificacion.fire({
                        icon: "error",
                        title: "ELija un Formato Disponible.",
                        text: "Foto no cargada."
                    });
                }
            });
            $('#fotoModal').modal('hide');
        });

        // Reinical formulario de la img
        function subirF() {
            $("#inputFoto").val('');
            $("#preview").attr("src", "");
            $('#fotoModal').modal('show');
        }

        // Vista previa de las img
        function previewImage() {
            const file = document.getElementById('inputFoto').files[0];
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
    </script>
@endsection
