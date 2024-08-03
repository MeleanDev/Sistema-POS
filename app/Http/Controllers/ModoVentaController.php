<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModoVentaRequest;
use App\Models\ModoVenta;
use App\Service\ModoVentaClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModoVentaController extends Controller
{

    private $ModoVentaClass;

    public function __construct(ModoVentaClass $ModoVentaClass)
    {
        $this->ModoVentaClass = $ModoVentaClass;
    }

    public function index(): View
    {
        return view('SistemaComercio.page.ModoVentas');
    }

    public function lista(Request $request)
    {
        if ($request->ajax()) {
            $datos = $this->ModoVentaClass->lista();
            foreach ($datos as $item) {
                if ($item->estado == "Activa") {
                    $item->ruta = route('puntoVenta', $item->codigo);
                }
                $item->pvendidos = $this->ModoVentaClass->productoCajaCount($item->codigo);
                $item->frealizadas = $this->ModoVentaClass->facturasCajaCount($item->codigo);
            }
            return datatables()->of($datos)->toJson();
        }
    }

    public function crear(ModoVentaRequest $datos): JsonResponse
    {
        try {
            $estadoOTRA = $this->ModoVentaClass->verificarOtro();
            if ($estadoOTRA == false) {
                $this->ModoVentaClass->crear($datos);
                $respuesta = response()->json(['success' => true]);
            } else {
                $respuesta = response()->json(['error' => true]);
            }
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function estado(Request $dato, ModoVenta $id): JsonResponse
    {
        try {
            $id->estado = "Cerrado";
            $id->save();
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function eliminar(ModoVenta $id): JsonResponse
    {
        try {
            $borrar = $this->ModoVentaClass->facturasCajaCount($id);
            if ($borrar == 0) {
                $id->delete();
                $respuesta = response()->json(['success' => true]);
            } else {
                $respuesta = response()->json(['error' => true]);
            }
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }
}
