<?php

namespace App\Service;

use App\Service\DBConsultas\DBClass;

class ClienteClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function lista(){
        $datos = $this->DBClass->clienteLista();
        return $datos;
    }

    public function crear($datos){
        if ($datos['correo'] == null) {
            $datos['correo'] = "";
        }
        $this->DBClass->clienteCrear($datos);
    }

    public function editar($datos, $id){
        $this->DBClass->clienteEditar($datos,$id);
    }

}
