<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Producto;
use App\Service\ProductoClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductoController extends Controller
{
    private $producto;

    public function __construct(ProductoClass $producto)
    {
        $this->producto = $producto;
    }

    public function index(): View
    {
        return view('SistemaComercio.page.productos');
    }

    public function lista(Request $request)
    {
        if ($request->ajax()) {
            $datos = $this->producto->lista();
            $fotoReserva = asset('SystemComercio/assets/img/StockGoCompleto.png'); 
            foreach ($datos as $item) {
                $fotoOriginal = asset('storage/' . $item->foto);
                $item->foto = ($item->foto == null) ?  $fotoReserva : $fotoOriginal;
            }
            return datatables()->of($datos)->toJson();
        }
    }

    public function categoriaList(Request $request): JsonResponse
    {
        $categorias = $this->producto->categorias();

        $term = $request->get('term');

        $results = [];

        foreach ($categorias as $item) {
            if (stristr($item->nombre, $term)) {
                $results[] = [
                    'categoriaId' => $item->id,
                    'categoriaText' => $item->nombre
                ];
            }
        }
        return response()->json($results);
    }

    public function proveedorList(Request $request): JsonResponse
    {
        $proveedor = $this->producto->proveedor();

        $term = $request->get('term');

        $results = [];

        foreach ($proveedor as $item) {
            if (stristr($item->nombre, $term)) {
                $results[] = [
                    'proveedorId' => $item->id,
                    'proveedorText' => $item->nombre
                ];
            }
        }

        return response()->json($results);
    }

    public function consulta(Producto $id): JsonResponse
    {
        $fotoReserva = asset('SystemComercio/assets/img/StockGoCompleto.png'); 
        $fotoOriginal = asset('storage/' . $id->foto);
        $id->foto = ($id->foto == null) ?  $fotoReserva : $fotoOriginal; 
        return response()->json($id);
    }

    public function crear(ProductoRequest $datos): JsonResponse
    {
        try {
            $nombreFoto = $this->producto->guardarImg($datos);
            $this->producto->crear($datos, $nombreFoto);
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $this->producto->borrarFt($nombreFoto);
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function editar(Request $datos, Producto $id): JsonResponse
    {
        try {
            if ($datos->file('foto') == null) {
                $nombreFoto = $id->foto;
            } else {
                $this->producto->borrarFt($id->foto);
                $nombreFoto = $this->producto->guardarImg($datos);
            }
            $this->producto->editar($datos, $nombreFoto, $id);
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function eliminar(Producto $id): JsonResponse
    {
        try {
            $this->producto->borrarFt($id->foto);
            $id->delete();
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }
}
