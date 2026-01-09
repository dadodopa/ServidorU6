<?php


class Persona
{


    private $dni;


    private $nombre;



    function getDni()
    {


        return $this->dni;
    }


    function getNombre()
    {


        return $this->nombre;
    }


    function setDni($dni): void
    {


        $this->dni = $dni;
    }


    function setNombre($nombre): void
    {


        $this->nombre = $nombre;
    }
}
