<?php

namespace App\Service;

use App\Service\DBConsultas\DBClass;

class ProveedorProductoClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function lista(){
        $datos = $this->DBClass->proveedorProductoLista();
        return $datos;
    }

    public function crear($datos){
        $this->DBClass->proveedorProductoCrear($datos);
    }

    public function editar($datos, $id){
        $this->DBClass->proveedorProductoEditar($datos, $id);
    }
}
