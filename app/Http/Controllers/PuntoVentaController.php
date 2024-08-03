<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ModoVenta;
use App\Models\PuntoVenta;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PuntoVentaController extends Controller
{
    public function index($codigo): View
    {
        $permiso = ModoVenta::where("codigo", $codigo)->first();
        if ($permiso == true and $permiso->estado == "Activa") {
            return view('SistemaComercio.page.puntoVenta');
        }
        return redirect()->route('dashboard');
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

    public function datosCLiente($cedula){
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
}
