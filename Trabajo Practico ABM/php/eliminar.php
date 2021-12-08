<?php

include "fabrica.php";

$seEncontro = 0;
$legajo     = $_GET["legajo"];

$archivo = fopen("../archivos/empleados.txt", "r");

while(!feof($archivo))
	{
		$datos = explode(" ", fgets($archivo));

        if(count($datos)>1)
        {
            if($datos[16] == $legajo)
            {
                $seEncontro       = 1;
                $EmpleadoEliminar = new Empleado($datos[7],$datos[10],$datos[1],$datos[4],$datos[16],$datos[13],$datos[19]);
                $FabricaDatosGET  = new Fabrica("TP1",100);
                
                $EmpleadoEliminar->SetPathFoto($datos[22]);
                $FabricaDatosGET->TraerDeArchivo("empleados.txt");
                
                if($FabricaDatosGET->EliminarEmpleado($EmpleadoEliminar))
                {
                    echo "Se elimino al empleado<br><br>";
                }
                break;
            }
        }
	}

    if($seEncontro == 0)
    {
        echo "No se encontro el empleado con este legajo...<br><br>";
    }

    echo '<a href="../html/index.php"><br><br>Inicio</a>';
?>