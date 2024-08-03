<?php

namespace App\Service;

use App\Service\DBConsultas\DBClass;

class EmpresaDatoClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function ingresarDatos($datos){
        $this->DBClass->empresaGuardar($datos);
    }

    public function datos(){
        $datos = $this->DBClass->empresaDato();
        return $datos;
    }

    public function foto($foto){
        $ruta = "Empresa/img";
        $nombreNuevo = $this->DBClass->guardarImg($foto, $ruta);
        return $nombreNuevo;
    }

    public function cambiarDB($nombre){
        $this->DBClass->empresaFoto($nombre);
    }

    public function eliminarFotoCarpt($foto){
        $this->DBClass->eliminarFotoCarpt($foto);
    }
}
