<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Service\FacturaClass;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacturaController extends Controller
{

    private $FacturaClass;

    public function __construct(FacturaClass $FacturaClass)
    {
        $this->FacturaClass = $FacturaClass;
    }

    public function index(): View
    {
        return view('SistemaComercio.page.facturas');
    }

    public function lista(Request $request)
    {
        if ($request->ajax()) {
            $datos = $this->FacturaClass->lista();
            return datatables()->of($datos)->toJson();
        }
    }

    public function eliminar(Factura $id): JsonResponse
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
