<?php

namespace App\Service\DBConsultas;

use App\Models\CategoriaProducto;
use App\Models\Cliente;
use App\Models\EmpresaDato;
use App\Models\Factura;
use App\Models\MesCantidad;
use App\Models\ModoVenta;
use App\Models\Producto;
use App\Models\ProveedorProducto;

class DBClass
{   
    // App

        // Borrar archivo de la app
        public function eliminarFotoCarpt($foto){
            unlink(public_path('storage/'.$foto));
        }

        // Guardar img
        public function guardarImg($datos, $ruta){
            $extension = $datos->file('foto')->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $datos->file('foto')->storeAs('public/'.$ruta, $filename);

            $nombreActualizado = $ruta.'/'.$filename;
            return $nombreActualizado;
        }

    // Empresa Dato
    
        // Datos
        public function empresaDato(){
            $datos = EmpresaDato::first();
            return $datos;
        }

        // Guardar 
        public function empresaGuardar($datos){
            $empresa = $this->empresaDato();
            $empresa->nempresa = $datos['nempresa'];
            $empresa->rif = $datos['rif'];
            $empresa->rsocial = $datos['rsocial'];
            $empresa->correo = $datos['correo'];
            $empresa->telefono = $datos['telefono'];
            $empresa->direccion = $datos['direccion'];
            $empresa->pais = $datos['pais'];
            $empresa->estado = $datos['estado'];
            $empresa->ciudad = $datos['ciudad'];
            $empresa->cpostal = $datos['cpostal'];
            $empresa->save();
        }

        // Foto
        public function empresaFoto($nombre){
            $empresa = $this->empresaDato();
            $empresa->foto = $nombre;
            $empresa->save();
        }
        
    // Cliente

        // Lista
        public function clienteLista(){
            $datos = Cliente::all();
            return $datos;
        }

        // Crear
        public function clienteCrear($datos){
            $cliente = new Cliente();
            $cliente->nombre = $datos['nombre'];
            $cliente->apellido = $datos['apellido'];
            $cliente->cedula = $datos['cedula'];
            $cliente->correo = $datos['correo'];
            $cliente->save();
        }

        // Editar
        public function clienteEditar($datos, $id){
            $id->nombre = $datos['nombre'];
            $id->apellido = $datos['apellido'];
            $id->cedula = $datos['cedula'];
            $id->correo = $datos['correo'];
            $id->save();
        }

        // Cantidad
        public function clienteCantidad(){
            $datos = Cliente::count();
            return $datos;
        }

    // Producto

        // Lista
        public function productoLista(){
            $datos = Producto::all();
            return $datos;
        }

        // Crear
        public function productoCrear($datos, $foto){
            $producto = new Producto();
            $producto->foto = $foto;
            $producto->codigo = $datos['codigo'];
            $producto->nombre = $datos['nombre'];
            $producto->descripcion = $datos['descripcion'];
            $producto->categoria = $datos['categoria'];
            $producto->proveedor = $datos['proveedor'];
            $producto->cantidad = $datos['cantidad'];
            $producto->precio = $datos['precio'];
            $producto->save();
        }

        // Editar
        public function productoEditar($datos, $foto ,$id){
            $id->foto = $foto;
            $id->codigo = $datos['codigo'];
            $id->nombre = $datos['nombre'];
            $id->descripcion = $datos['descripcion'];
            $id->categoria = $datos['categoria'];
            $id->proveedor = $datos['proveedor'];
            $id->cantidad = $datos['cantidad'];
            $id->precio = $datos['precio'];
            $id->save();
        }
    
    // Categoria Producto
        // Lista
        public function categoriaProductoLista(){
            $datos = CategoriaProducto::all();
            return $datos;
        }

        // Crear
        public function categoriaProductoCrear($datos){
            $categoria = new CategoriaProducto();
            $categoria->nombre = $datos['nombre'];
            $categoria->save();
        }

        // Editar
        public function categoriaProductoEditar($datos, $id){
            $id->nombre = $datos['nombre'];
            $id->save();
        }
    // Proveedor Producto

        // Lista
        public function proveedorProductoLista(){
            $datos = ProveedorProducto::all();
            return $datos;
        }

        // Crear
        public function proveedorProductoCrear($datos){
            $proveedor = new ProveedorProducto();
            $proveedor->nombre = $datos['nombre'];
            $proveedor->telefono = $datos['telefono'];
            $proveedor->correo = $datos['correo'];
            $proveedor->direccion = $datos['direccion'];
            $proveedor->descripcion = $datos['descripcion'];
            $proveedor->save();
        }

        // Editar
        public function proveedorProductoEditar($datos, $id){
            $id->nombre = $datos['nombre'];
            $id->telefono = $datos['telefono'];
            $id->correo = $datos['correo'];
            $id->direccion = $datos['direccion'];
            $id->descripcion = $datos['descripcion'];
            $id->save();
        }
    
    // Factura

        // Crear
        public function facturaCrear($codigo, $cliente, $pagado, $metodoPago, $productos, $iva){
            $factura = new Factura();
            $factura->codigo = $codigo;
            $factura->cliente = $cliente;
            $factura->pagado = $pagado;
            $factura->metodoPago = $metodoPago;
            $factura->productos = $productos;
            $factura->iva = $iva;
            $factura->save();
        }

        // Lista
        public function facturaLista(){
            $datos = Factura::all();
            return $datos;
        }

        // Cantidad
        public function facturaCantidad(){
            $datos = Factura::count();
            return $datos;
        }

        // 5 Facturas con Montos mas Altos
        public function facturaMontoAlto(){
            $datos = Factura::orderBy('pagado', 'desc')->limit(5)->get();
            return $datos;
        }

        // 4 Productos mas Vendidos
        public function facturaProductoMasVendidos(){
            $datos = Producto::orderBy('vendidos', 'desc')->limit(4)->get();
            return $datos;
        }

    // Modo Venta "Cajas"

        // Verificar que haya otra caja activa
        public function cajaVerificarOtro(){
            $datos = ModoVenta::where('estado', 'Activa')->first();
            return $datos ? true : false;
        }
        
        // Crear
        public function cajaCrear($datos){
            $caja = new ModoVenta();
            $caja->codigo = $datos['codigo'];
            $caja->estado = "Activa";
            $caja->bs = $datos['bs'];
            $caja->dolar = $datos['dolar'];
            $caja->save();
        }

        // Lista
        public function cajaLista(){
            $datos = ModoVenta::all();
            return $datos;
        }

        // Cantidad Productos de una Caja
        public function cajaProductoCount($codigo){
            $datos = Producto::where("codigo", $codigo)->count();
            return $datos;
        }

        // Cantidad Facturas de una Caja
        public function cajaFacturasCount($codigo){
            $datos = Factura::where("codigoCaja", $codigo)->count();
            return $datos;
        }
    
    // MesCantidades Datos

        // Datos
        public function mesCantidades(){
            $datos = MesCantidad::all();
            return $datos;
        }

        // Datos del anio
        public function mesCantidadesAnio(){
            $datos = MesCantidad::sum('cantidadeTotal');
            return $datos;
        }

        // Datos del Mes
        public function mesCantidadesMes($mes){
            $datos = MesCantidad::where('mes', $mes)->first();
            return $datos;
        }
}
