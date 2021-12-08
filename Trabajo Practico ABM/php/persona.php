<?php

abstract class Persona
{
    private $_dni;
    private $_sexo;
    private $_nombre;
    private $_apellido;

    public function __construct($nombre, $apellido, $dni, $sexo)
    {
        $this->_dni      = $dni     ;
        $this->_sexo     = $sexo    ;
        $this->_nombre   = $nombre  ;
        $this->_apellido = $apellido;
    }

    public function GetDni()
    {
        return $this->_dni;
    }

    public function GetSexo()
    {
        return $this->_sexo;
    }

    public function GetNombre()
    {
        return $this->_nombre;
    }

    public function GetApellido()
    {
        return $this->_apellido;
    } 
   
    public abstract function Hablar($idioma);

    public function __toString()
    {
        return "DNI: " . $this->GetDni() . " - Sexo: " . $this->GetSexo() . " - Nombre: " . $this->GetNombre() . " - Apellido: " . $this->GetApellido();
    }
}

?>