<?php

include "fabrica.php";

    if(isset($_POST["hdnModificar"]))
    {
        $FabricaModificar = new Fabrica("Modificar",100);
        $FabricaModificar->TraerDeArchivo("empleados.txt");

        for($i = 0; $i<count($FabricaModificar->GetEmpelados()); $i++)
        {
            if($FabricaModificar->GetEmpelados()[$i]->GetDni() == $_POST["txtDni"])
            {
                $FabricaModificar->EliminarEmpleado($FabricaModificar->GetEmpelados()[$i]);
            }
        }
    }

    $pathFoto     = $_FILES["imagenEmpleado"]["name"];
    $destino      = "../fotos/" . $_POST["txtDni"]."-".$_POST["txtApellido"];
    $tiposArchivo = pathinfo($pathFoto, PATHINFO_EXTENSION);
    $uploadOk     = TRUE;

    $destinoFake = $destino;

    if (file_exists($destinoFake.=".jpg") || file_exists($destinoFake.=".png") || file_exists($destinoFake.=".jpeg") || file_exists($destinoFake.=".gif") || file_exists($destinoFake.=".bmp")) 
    { 
		$uploadOk = FALSE;
	}

    $destino = $destino.=".".$tiposArchivo;

    if ($_FILES["imagenEmpleado"]["size"] > 1048576) 
    {
		echo "Archivo demasiado grande. Verifique!!!<br>";
		$uploadOk = FALSE;
    }

    $tmpsNames = $_FILES["imagenEmpleado"]["tmp_name"];

	$esImagen = getimagesize($tmpsNames);

	if($esImagen === true) 
    {
		if($tiposArchivo != "jpg" && $tiposArchivo != "jpeg" && $tiposArchivo != "gif" && $tiposArchivo[$i] != "png") 
        {
			echo "Solo son permitidas imagenes con extension JPG, JPEG, PNG o GIF.";
			$uploadOk = FALSE;
		}
	}
	
    if ($uploadOk === FALSE)
    {
        echo '<a href="../html/index.php">Error al agregar empleado, probablemente el id o legajo ya se encuentran en la base de datos...</a>';
    } 
    else 
    {
        $EmpleadoPost     = new Empleado($_POST["txtNombre"],$_POST["txtApellido"],$_POST["txtDni"],$_POST["sexo"],$_POST["txtLegajo"],$_POST["radioTurno"],$_POST["txtSueldo"]);
        $FabricaDatosPost = new Fabrica("TP1",100);

        $EmpleadoPost->SetPathFoto($destino);

        $FabricaDatosPost->TraerDeArchivo("empleados.txt");

        if($FabricaDatosPost->AgregarEmpleado($EmpleadoPost) && move_uploaded_file($tmpsNames, $destino))
        {
            //header("Location: ../html/ajax.php");
        }
        else
        {
            echo '<a href="../html/index.php">Error al agregar empleado, probablemente el id o legajo ya se encuentran en la base de datos...</a>';
        }
    }
?>
