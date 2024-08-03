<?php

namespace App\Service;

use App\Service\DBConsultas\DBClass;

class FacturaClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function lista(){
        $datos = $this->DBClass->facturaLista();
        return $datos;
    }
}
