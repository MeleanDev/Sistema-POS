<?php

namespace App\Http\Controllers;

use App\Models\MesCantidad;
use App\Service\PanelPrincipalClass;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Carbon\Carbon;

class PanelPrincipalController extends Controller
{
    private $PanelPrincipalClass;

    public function __construct(PanelPrincipalClass $PanelPrincipalClass)
    {
        $this->PanelPrincipalClass = $PanelPrincipalClass;
    }

    public function index(): View
    {
        return view('SistemaComercio.page.panelPrincipal');
    }

    public function datos(): JsonResponse
    {
        return response()->json([
            'cliente' => $this->PanelPrincipalClass->datosCardCliente(),
            'factura' => $this->PanelPrincipalClass->datosCardFactura(),
            'ventaMes' => $this->PanelPrincipalClass->datosCardVentaMes(),
            'ventasAnio' => $this->PanelPrincipalClass->datosCardVentaAnio()
        ]);
    }

    public function factura(): JsonResponse
    {
        $facturas = $this->PanelPrincipalClass->factura();
        foreach ($facturas as $item) {
            // Asegúrate de que $item->created_at sea una cadena de texto válida
            $fecha = Carbon::parse($item->created_at);

            // Formatea la fecha como deseas
            $item->create_at = $fecha->format('d-m-Y');
        }
        return response()->json($facturas);
    }

    public function productos(): JsonResponse
    {
        $facturas = $this->PanelPrincipalClass->productos();
        foreach ($facturas as $item) {
            $item->foto = asset('storage/'.$item->foto);
        }
        return response()->json($facturas);
    }

    public function grafica(): JsonResponse
    {
        $Bd = $this->PanelPrincipalClass->mesCantidades();
        $data = [];
        foreach ($Bd as $item) {
            $data['label'][] = $item->mes; 
            $data['data'][] = $item->cantidadeTotal;
        }
        return response()->json($data);
    }
}
