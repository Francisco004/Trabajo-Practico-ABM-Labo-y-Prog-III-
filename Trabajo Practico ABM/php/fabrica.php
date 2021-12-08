<?php

include "interfaces.php";
include "empleado.php";

class Fabrica implements IArchivo
{
    private $_empleados;
    private $_razonSocial;
    private $_cantidadMaxima;

    public function __construct($razonSocial, $CantidadMaxima = 5)
    {
        $this->_cantidadMaxima = $CantidadMaxima  ;
        $this->_razonSocial    = $razonSocial     ;
        $this->_empleados      = array          ();
    }

    public function GetEmpelados()
    {
        return $this->_empleados;
    }

    public function AgregarEmpleado($empleado)
    {
        $retorno = false;

        if(count($this->_empleados) < $this->_cantidadMaxima && !$this->LegajoRepetido($empleado))
        {
            array_push($this->_empleados,$empleado)      ;
            $this     ->EliminarEmpleadosRepetidos()     ;
            $this     ->GuardarEnArchivo("empleados.txt");
            $retorno   = true                            ;
        }

        return $retorno;
    }

    public function CalcularSueldos()
    {
        $total = 0;

        for($i = 0; $i < count($this->_empleados); $i++)
        {
           $total = $total + $this->_empleados[$i]->GetSueldo();
        }
        
        return $total;
    }

    public function EliminarEmpleado($empleado)
    {
        $retorno = false                         ;
        $Foto    = trim($empleado->GetPathFoto());

        for($i = 0; $i < count($this->_empleados); $i++)
        {
           if($this->_empleados[$i]->GetLegajo() == $empleado->GetLegajo())
           {
                if(file_exists($Foto))
                {
                    unlink($Foto);
                }

                unset   ($this->_empleados[$i])                           ;
                sort    ($this->_empleados)                               ;
                $this   ->GuardarEnArchivo("empleados.txt")               ;
                $retorno = true                                           ;
                break;
           }
        }

        return $retorno;
    }

    private function EliminarEmpleadosRepetidos()
    {
        $this->_empleados = array_unique($this->_empleados);
    }

    public function __toString()
    {
        $stringBuilder = "<br> Cantidad maxima de empleados: " . $this->_cantidadMaxima . "<br>";

        for($i = 0; $i < count($this->_empleados); $i++)
        {
            if($this->_empleados[$i] != null)
            {
                $stringBuilder .= $this->_empleados[$i]->__toString();
            }
        }

        $stringBuilder .= "Razon social: " . $this->_razonSocial;

        return $stringBuilder;
    }

    public function LegajoRepetido($empleado)
    {
        $retorno = false;

        for($i = 0; $i < count($this->_empleados); $i++)
        {
           if($this->_empleados[$i]->GetLegajo() == $empleado->GetLegajo())
           {
                $retorno = true;
           }
        }

        return $retorno;
    }

    public function TraerDeArchivo($nombre)
    {
        $ar = fopen("../archivos/".$nombre, "r");

        while(!feof($ar))
        {
            $datos = explode(" ", fgets($ar));
    
            if(count($datos)>1)
            {
                $EmpleadoDesdeTexto = new Empleado($datos[7],$datos[10],$datos[1],$datos[4],$datos[16],$datos[13],$datos[19]);

                $EmpleadoDesdeTexto->SetPathFoto($datos[22]);
              
                $this->AgregarEmpleado($EmpleadoDesdeTexto);
            }
        }
        fclose($ar);
    }

    public function GuardarEnArchivo($nombre)
    {
        $ar = fopen("../archivos/".$nombre, "w+");
		
        for($i = 0; $i < count($this->_empleados); $i++)
        {
            fwrite($ar, $this->_empleados[$i]->__toString()."\r\n");
        }
        
        fclose($ar);
    }

    public function Sesion($apellido, $dni)
    {
        for($i = 0; $i < count($this->_empleados); $i++)
        {
            if($this->_empleados[$i]->GetApellido() == $apellido && $this->_empleados[$i]->GetDni() == $dni)
            {
                session_start()                                  ;
                $_SESSION    ["txtDni"] = $dni                   ;
                header       ("Location: ../html/index.php");
            }
            else if($i == (count($this->_empleados)-1))
            {
                echo "Error no existe el usuario indicado...";
                echo '<a href="../html/login.html"><br><br>Volver al login</a>';
            }
        }
    }
}
?>