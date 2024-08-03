<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProveedorProductoRequest;
use App\Models\ProveedorProducto;
use App\Service\ProveedorProductoClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProveedorProductoController extends Controller
{
    private $proveedoProductoClass;

    public function __construct(ProveedorProductoClass $proveedoProductoClass)
    {
        $this->proveedoProductoClass = $proveedoProductoClass;
    }

    public function index(): View
    {
        return view('SistemaComercio.page.proveedorProductos');
    }

    public function lista(Request $request)
    {
        if ($request->ajax()) {
            $datos = $this->proveedoProductoClass->lista();
            return datatables()->of($datos)->toJson();
        }
    }

    public function crear(ProveedorProductoRequest $datos): JsonResponse
    {
        try {
            $this->proveedoProductoClass->crear($datos);
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;

    }

    public function consulta(ProveedorProducto $id): JsonResponse
    {
        return response()->json($id);
    }

    public function editar(ProveedorProductoRequest $datos, ProveedorProducto $id): JsonResponse
    {
        try {
            $this->proveedoProductoClass->editar($datos, $id);
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function eliminar(ProveedorProducto $id): JsonResponse
    {
        try {
            $id->delete();
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }
}
