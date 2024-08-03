<?php

namespace App\Service;

use App\Service\DBConsultas\DBClass;
use Carbon\Carbon;

class PanelPrincipalClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function datosCardCliente(){
        $datos = $this->DBClass->clienteCantidad();
        return $datos;
    }

    public function datosCardfactura(){
        $datos = $this->DBClass->facturaCantidad();
        return $datos;
    }

    public function factura(){
        $datos = $this->DBClass->facturaMontoAlto();
        return $datos;
    }

    public function productos(){
        $datos = $this->DBClass->facturaProductoMasVendidos();
        return $datos;
    }

    public function mesCantidades(){
        $datos = $this->DBClass->mesCantidades();
        return $datos;
    }

    public function datosCardVentaAnio(){
        $datos = $this->DBClass->mesCantidadesAnio();
        return $datos;
    }

    public function datosCardVentaMes(){
        $mes = $this->obtenerMesActual();
        $datos = $this->DBClass->mesCantidadesMes($mes);
        return $datos->cantidadesBS;
    }
    
    public function obtenerMesActual(){
        $mesEngli = Carbon::now()->format('F');
        $mesSpanish = match ($mesEngli) {
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Obtubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        };
        return $mesSpanish;   
    }
}
