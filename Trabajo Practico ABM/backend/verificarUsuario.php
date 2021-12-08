<?php

include "../php/fabrica.php";

    $FabricaVerificacion = new Fabrica("Validacion",100);

    $FabricaVerificacion->TraerDeArchivo("empleados.txt");

    for($i = 0; $i<count($FabricaVerificacion->GetEmpelados()); $i++)
    {
        if($FabricaVerificacion->GetEmpelados()[$i]->GetDni() == $_POST["txtDni"] && $FabricaVerificacion->GetEmpelados()[$i]->GetApellido() == $_POST["txtApellido"])
        {
            $FabricaVerificacion->Sesion($_POST["txtApellido"], $_POST["txtDni"]);
            header("Location: ../html/ajax.php");
            break;
        }
        else if($i == (count($FabricaVerificacion->GetEmpelados())-1))
        {
            header("Location: ../html/login.html");
            exit();
        }
    }
?>