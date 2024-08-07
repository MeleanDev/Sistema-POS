<?php

use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpresaDatoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ModoVentaController;
use App\Http\Controllers\PanelPrincipalController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorProductoController;
use App\Http\Controllers\PuntoVentaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('Administracion')->group(function () {

        // Panel Principal
        Route::controller(PanelPrincipalController::class)->group(function () {
            Route::get('Panel-Principal', 'index')->name('dashboard');
            Route::get('Panel-Principal/Datos/Cards', 'datos')->name('panelPrincipal.datos');
            Route::get('Panel-Principal/Datos/Grafica', 'grafica')->name('panelPrincipal.grafica');
            Route::get('Panel-Principal/Datos/Facturas', 'factura')->name('panelPrincipal.facturas');
            Route::get('Panel-Principal/Datos/Productos', 'productos')->name('panelPrincipal.productos');
        });

        // Empresa Datos
        Route::controller(EmpresaDatoController::class)->group(function () {
            Route::get('Empresa-Datos', 'index')->name('empresa.Datos');
            Route::get('Empresa-Datos/Datos', 'datos')->name('empresa.Datos.datos');
            Route::post('Empresa-Datos', 'guardar')->name('empresa.Datos.subir');
            Route::post('Empresa-Datos/foto', 'foto')->name('empresa.Datos.foto');
        });

        // Modo Ventas
        Route::controller(ModoVentaController::class)->group(function () {
            Route::get('ModoVentas', 'index')->name('modoVenta');
            Route::get('ModoVentas/Lista', 'lista')->name('modoVenta.lista');
            Route::post('ModoVentas', 'crear')->name('modoVenta.crear');
            Route::post('ModoVentas/Estado/{id?}', 'estado')->name('modoVenta.estado');
            Route::delete('ModoVentas/{id?}', 'eliminar')->name('modoVenta.eliminar');
        });

        // Punto de Venta
        Route::controller(PuntoVentaController::class)->group(function () {
            Route::get('PuntoVenta/CajaVentas/{codigo}', 'index')->name('puntoVenta');
            Route::get('PuntoVenta/Cedulas', 'cedula')->name('puntoVenta.cedula');
            Route::get('PuntoVenta/MontoPago', 'montoPagos')->name('puntoVenta.montoPago');
            Route::get('PuntoVenta/DatosCLiente/{cedula?}', 'datosCLiente')->name('puntoVenta.consultaDatoCliente');
            Route::post('PuntoVenta/ActualizarPago', 'actualizarPago')->name('puntoVenta.actualizarPago');
            Route::get('PuntoVenta/Productos', 'productosFactura')->name('puntoVenta.consultaProductosF');
            Route::post('PuntoVenta/Productos', 'agregarProducF')->name('puntoVenta.agregarProducF');
            Route::delete('PuntoVenta/Productos/{id?}', 'eliminarProducF')->name('puntoVenta.eliminarProducF');

        });

        // Analisis Comercio
        Route::get('Analisis-Comercio', function () {
            return view('SistemaComercio.page.analisisComercio');
        })->name('analisisComercio');

        // Facturas
        Route::controller(FacturaController::class)->group(function () {
            Route::get('Facturas', 'index')->name('facturas');
            Route::get('Facturas/Lista', 'lista')->name('facturas.lista');
            Route::delete('Facturas/{id?}', 'eliminar')->name('facturas.eliminar');
        });

        // Clientes
        Route::controller(ClienteController::class)->group(function () {
            Route::get('Clientes', 'index')->name('clientes');
            Route::get('Clientes/Lista', 'lista')->name('cliente.lista');
            Route::get('Clientes/Consulta/{id?}', 'consulta')->name('cliente.consulta');
            Route::post('Clientes', 'crear')->name('clientes.crear');
            Route::post('Clientes/{id?}', 'editar')->name('clientes.editar');
            Route::delete('Clientes/{id?}', 'eliminar')->name('clientes.eliminar');
        });

        // Productos
        Route::controller(ProductoController::class)->group(function () {
            Route::get('Productos', 'index')->name('productos');
            Route::get('Productos/Lista', 'lista')->name('productos.lista');
            Route::get('Productos/Lista/CategoriaList', 'categoriaList')->name('productos.CategoriaList');
            Route::get('Productos/Lista/ProveedorList', 'proveedorList')->name('productos.ProveedorList');
            Route::get('Productos/Consulta/{id?}', 'consulta')->name('productos.consulta');
            Route::post('Productos', 'crear')->name('productos.crear');
            Route::post('Productos/{id?}', 'editar')->name('productos.editar');
            Route::delete('Productos/{id?}', 'eliminar')->name('productos.eliminar');
        });

        // Reabatecimiento
        Route::get('Reabastecimiento', function () {
            return view('SistemaComercio.page.reabastecimiento');
        })->name('reabastecimiento');

        // Categoria Productos
        Route::controller(CategoriaProductoController::class)->group(function () {
            Route::get('Categoria-Productos', 'index')->name('categoriaProductos');
            Route::get('Categoria-Productos/Lista', 'lista')->name('categoriaProductos.lista');
            Route::get('Categoria-Productos/Consulta/{id?}', 'consulta')->name('categoriaProductos.consulta');
            Route::post('Categoria-Productos', 'crear')->name('categoriaProductos.crear');
            Route::post('Categoria-Productos/{id?}', 'editar')->name('categoriaProductos.editar');
            Route::delete('Categoria-Productos/{id?}', 'eliminar')->name('categoriaProductos.eliminar');
        });

        // Proveedor Productos
        Route::controller(ProveedorProductoController::class)->group(function () {
            Route::get('Proveedor-Productos', 'index')->name('proveedorProductos');
            Route::get('Proveedor-Productos/Lista', 'lista')->name('proveedorProductos.lista');
            Route::get('Proveedor-Productos/Consulta/{id?}', 'consulta')->name('proveedorProductos.consulta');
            Route::post('Proveedor-Productos', 'crear')->name('proveedorProductos.crear');
            Route::post('Proveedor-Productos/{id?}', 'editar')->name('proveedorProductos.editar');
            Route::delete('Proveedor-Productos/{id?}', 'eliminar')->name('proveedorProductos.eliminar');
        });

    });
});