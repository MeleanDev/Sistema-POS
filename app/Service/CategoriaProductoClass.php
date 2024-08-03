<?php

namespace App\Service;

use App\Service\DBConsultas\DBClass;

class CategoriaProductoClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function lista(){
        $datos = $this->DBClass->categoriaProductoLista();
        return $datos;
    }

    public function crear($datos){
        $this->DBClass->categoriaProductoCrear($datos);
    }

    public function editar($datos, $id){
        $this->DBClass->categoriaProductoEditar($datos, $id);
    }
}
