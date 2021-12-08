<?php

include "persona.php";

class Empleado extends Persona
{
    protected $_turno;
    protected $_legajo;
    protected $_sueldo;
    protected $_pathFoto;

    public function __construct($nombre, $apellido, $dni, $sexo, $legajo, $turno, $sueldo)
    {
        parent::__construct($nombre, $apellido, $dni, $sexo);
        
        $this->_turno  = $turno ;
        $this->_sueldo = $sueldo;
        $this->_legajo = $legajo;
    }
    
    public function GetTurno()
    {
        return $this->_turno;
    }

    public function GetLegajo()
    {
        return $this->_legajo;
    }

    public function GetSueldo()
    {
        return $this->_sueldo;
    }

    public function GetPathFoto()
    {
        return $this->_pathFoto;
    }

    public function SetPathFoto($path)
    {
        $this->_pathFoto = $path;
    }
   
    public function Hablar($idioma)
    {
        $retorno = "El empleado habla ";

        for($i = 0; $i < count($idioma); $i++)
        {
            if($i == (count($idioma) -1))
            {
                $retorno .= $idioma[$i] . ".";
            }
            else
            {
                $retorno .= $idioma[$i] . ", ";
            }
        }

        return $retorno;
    }

    public function __toString()
    {
        return parent::__toString() . " - Turno: " . $this->GetTurno() . " - Legajo: " . $this->GetLegajo() . " - Sueldo: " . $this->GetSueldo() . " - Path: " . $this->GetPathFoto();
    }
}

?>
