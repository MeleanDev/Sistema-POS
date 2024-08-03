<?php

namespace App\Service;

use App\Service\DBConsultas\DBClass;

class ProductoClass
{
    private $DBClass;

    public function __construct(DBClass $DBClass)
    {
        $this->DBClass = $DBClass;
    }

    public function lista(){
        $datos = $this->DBClass->productoLista();
        return $datos;
    }

    public function crear($datos, $foto){
        $this->DBClass->productoCrear($datos, $foto);
    }

    public function guardarImg($datos){
        $ruta = "Productos/img";
        $nombre = $this->DBClass->guardarImg($datos, $ruta);
        return $nombre;
    }

    public function borrarFt($ruta){
        $this->DBClass->eliminarFotoCarpt($ruta);
    }

    public function editar($datos, $foto ,$id){
        $this->DBClass->productoEditar($datos, $foto, $id);
    }

    public function categorias(){
        $datos = $this->DBClass->categoriaProductoLista();
        return $datos;
    }

    public function proveedor(){
        $datos = $this->DBClass->proveedorProductoLista();
        return $datos;
    }
}
