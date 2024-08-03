<?php

namespace App\Service;

use App\Service\DBConsultas\DBClass;

class ModoVentaClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function verificarOtro(){
        $datos = $this->DBClass->cajaVerificarOtro();
        return $datos;
    }

    public function crear($datos){
        $this->DBClass->cajaCrear($datos);
    }

    public function lista(){
        $datos = $this->DBClass->cajaLista();
        return $datos;
    }

    public function productoCajaCount($codigo){
        $datos = $this->DBClass->cajaProductoCount($codigo);
        return $datos;
    }

    public function facturasCajaCount($codigo){
        $datos = $this->DBClass->cajaFacturasCount($codigo);
        return $datos;
    }
}
