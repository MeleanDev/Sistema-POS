<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ModoVenta;
use App\Models\PosFacturaProducto;
use App\Models\Producto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PuntoVentaController extends Controller
{
    public function index($codigo)
    {
        $permiso = ModoVenta::where("codigo", $codigo)->first();
        if ($permiso == false and $permiso->estado === "Cerrado") {
            return redirect()->route('dashboard');
        }

        return view('SistemaComercio.page.puntoVenta');
    }

    public function cedula(Request $request): JsonResponse
    {
        $cliente = Cliente::all();
        $term = $request->get('term');
        $results = [];
        foreach ($cliente as $item) {
            if (stristr($item->cedula, $term)) {
                $results[] = [
                    'cedula' => $item->cedula,
                    'cedulaText' => $item->cedula
                ];
            }
        }
        return response()->json($results);
    }

    public function datosCLiente($cedula)
    {
        if ($cedula == 0) {
            return response()->json([
                'nombre' => " ",
                'apellido' => " ",
                'correo' => " ",
            ]);
        }
        $cliente = cliente::where("cedula", $cedula)->first();
        return response()->json([
            'nombre' => $cliente->nombre,
            'apellido' => $cliente->apellido,
            'correo' => $cliente->correo,
        ]);
    }

    public function productosFactura(Request $request)
    {
        if ($request->ajax()) {
            $datos = PosFacturaProducto::all();
            foreach ($datos as $item) {
                $producto = Producto::where('codigo', $item->idProduct)->first();
                $item->foto = asset('storage/' . $producto->foto);
                $item->nombre = $producto->nombre;
                $item->precio = $producto->precio;
                $item->precioTotal = $item->cantidad * $producto->precio;
                $item->cantidadMaxima = $producto->cantidad;
                $item->precioTotal = number_format($item->precioTotal, 2, '.', '');
            }
            return datatables()->of($datos)->toJson();
        }
    }

    public function agregarProducF(Request $request): JsonResponse
    {

        try {
            $prod = $request['idProduct'];
            $producto = Producto::find($prod);
            $agregar = new PosFacturaProducto();
            $agregar->idProduct = $producto->codigo;
            $agregar->cantidad = 1;
            $agregar->save();

            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function actualizarPago(Request $request): JsonResponse
    {
        try {
            $producto = $request['id'];
            $cantidad = $request['cantidad'];

            $actualizar = PosFacturaProducto::find($producto);
            $precio = Producto::where("codigo", $actualizar->idProduct)->first();

            // Por si es mayor a una cantidad disponible en el stock
            if ($cantidad > $precio->cantidad) {
                $respuesta = response()->json([
                    'noDisponible' => true,
                    'maximo' => $precio->cantidad,
                    'pagoTotal' => "No Calculable"
                ]);
                return $respuesta;
            }

            $actualizar->cantidad = $cantidad;
            $actualizar->save();

            $precioTnuevod = $cantidad * $precio->precio;
            $precioTnuevodFormateado = number_format($precioTnuevod, 2, '.', '');

            $respuesta = response()->json([
                'success' => true,
                'precioTnuevo' => $precioTnuevodFormateado
            ]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function eliminarProducF(PosFacturaProducto $id): JsonResponse
    {
        try {
            $id->delete();
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function montoPagos(): JsonResponse
    {
        try {
            $productosFactura = PosFacturaProducto::all();

            $pagoTotal = 0;
            $porcentajeImpuesto = 0;
            $pagoNeto = 0;

            foreach ($productosFactura as $item) {
                $producto = Producto::where('codigo', $item->idProduct)->first();
                $pagoTotal += $item->cantidad * $producto->precio;
            }

            $pagoTotal = number_format($pagoTotal, 2, '.', '');

            $pagoImpuesto = ($pagoTotal * $porcentajeImpuesto) / 100;
            $pagoImpuesto = number_format($pagoImpuesto, 2, '.', '');

            $pagoNeto = $pagoTotal + $pagoImpuesto;
            $pagoNeto = number_format($pagoNeto, 2, '.', '');

            // Calcular valores en la segunda moneda
            $tipoCambio = 40.2;

            $pagoTotalSegundaMoneda = $pagoTotal / $tipoCambio;
            $pagoImpuestoSegundaMoneda = $pagoImpuesto / $tipoCambio;
            $pagoNetoSegundaMoneda = $pagoNeto / $tipoCambio;

            $pagoTotalSegundaMoneda = number_format($pagoTotalSegundaMoneda, 2, '.', '');
            $pagoImpuestoSegundaMoneda = number_format($pagoImpuestoSegundaMoneda, 2, '.', '');
            $pagoNetoSegundaMoneda = number_format($pagoNetoSegundaMoneda, 2, '.', '');

            $repuesta = response()->json([
                'success' => true,
                'pagoTotal' => $pagoTotal,
                'pagoImpuesto' => $pagoImpuesto,
                'pagoNeto' => $pagoNeto,
                'pagoTotalSegundaMoneda' => $pagoTotalSegundaMoneda,
                'pagoImpuestoSegundaMoneda' => $pagoImpuestoSegundaMoneda,
                'pagoNetoSegundaMoneda' => $pagoNetoSegundaMoneda,
            ]);
        } catch (\Throwable $th) {
            $repuesta = response()->json(['error' => true]);
        }
        return $repuesta;
    }
}
