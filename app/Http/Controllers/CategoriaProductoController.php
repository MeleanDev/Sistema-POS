<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaProductoRequest;
use App\Models\CategoriaProducto;
use App\Service\CategoriaProductoClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriaProductoController extends Controller
{
    private $categoriaProductoClass;

    public function __construct(CategoriaProductoClass $categoriaProductoClass)
    {
        $this->categoriaProductoClass = $categoriaProductoClass;
    }

    public function index(): View
    {
        return view('SistemaComercio.page.categoriaProductos');
    }

    public function lista(Request $request)
    {
        if ($request->ajax()) {
            $datos = $this->categoriaProductoClass->lista();
            return datatables()->of($datos)->toJson();
        }
    }

    public function crear(CategoriaProductoRequest $datos): JsonResponse
    {
        try {
            $this->categoriaProductoClass->crear($datos);
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;

    }

    public function consulta(CategoriaProducto $id): JsonResponse
    {
        return response()->json($id);
    }

    public function editar(CategoriaProductoRequest $datos, CategoriaProducto $id): JsonResponse
    {
        try {
            $this->categoriaProductoClass->editar($datos, $id);
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function eliminar(CategoriaProducto $id): JsonResponse
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
