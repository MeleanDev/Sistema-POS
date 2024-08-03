<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaDatoRequest;
use App\Http\Requests\FotosRequest;
use App\Service\EmpresaDatoClass;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class EmpresaDatoController extends Controller
{
    private $EmpresaClass; 

    public function __construct(EmpresaDatoClass $EmpresaClass){
        $this->EmpresaClass = $EmpresaClass;
    }

    public function index(): View
    {
        return view('SistemaComercio.page.empresaDatos');
    }

    public function guardar(EmpresaDatoRequest $datos): JsonResponse
    {
        try {
            $this->EmpresaClass->ingresarDatos($datos);
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }

    public function datos(): JsonResponse
    {
        $datos = $this->EmpresaClass->datos();
        $datos->fotoURL = $datos->foto == null ? null : asset('storage/'.$datos->foto);
        return response()->json([
            "success" => true,
            "datos" => $datos 
          ]);
    }

    public function foto(FotosRequest $foto): JsonResponse
    {
        try {
            $empresa = $this->EmpresaClass->datos();
            if ($empresa->foto ?? null) {
                $this->EmpresaClass->eliminarFotoCarpt($empresa->foto);
            }
            $nombreFoto = $this->EmpresaClass->foto($foto);
            $this->EmpresaClass->cambiarDB($nombreFoto);
            $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
            $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
    }
}
