<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Service\ClienteClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClienteController extends Controller
{

    private $ClienteClass;

    public function __construct(ClienteClass $ClienteClass)
    {
        $this->ClienteClass = $ClienteClass;
    }

    public function index(): View
    {
        return view('SistemaComercio.page.clientes');
    }

    public function lista(Request $request)
    {
        if ($request->ajax()) {
            $datos = $this->ClienteClass->lista();
            return datatables()->of($datos)->toJson();
        }
    }

    public function crear(ClienteRequest $datos): JsonResponse
    {
        try {
            $this->ClienteClass->crear($datos);
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;

    }

    public function consulta(Cliente $id): JsonResponse
    {
        return response()->json($id);
    }

    public function editar(ClienteRequest $datos, Cliente $id): JsonResponse
    {
        try {
            $this->ClienteClass->editar($datos, $id);
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function eliminar(Cliente $id): JsonResponse
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
