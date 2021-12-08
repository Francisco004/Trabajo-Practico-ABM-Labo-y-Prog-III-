<?php

include "../backend/validarSesion.php";
include "fabrica.php";

$sad = array("Ingles", "Español");

///////////////////////////////////////////////////////////////////////////////////////////////////////
$pruebaTP1Elmpleado = new Empleado("Francisco","Rocha","41766450","M","108100","Mañana","100000");
print($pruebaTP1Elmpleado->__toString());
print($pruebaTP1Elmpleado->Hablar($sad));

///////////////////////////////////////////////////////////////////////////////////////////////////////
print("<br><br><font color='red'> Muestro los datos de la fabrica por defecto<br>" . "<font color='black'>");

$pruebaTP1Fabrica = new Fabrica("S.R.L");
print($pruebaTP1Fabrica->__toString());
print("<br>La cantidad total de la suma de los sueldos es de: " . $pruebaTP1Fabrica->CalcularSueldos());

///////////////////////////////////////////////////////////////////////////////////////////////////////
print("<br><br><font color='red'> Agrego un empleado <br>" . "<font color='black'>");
$pruebaAddEmpleado = new Empleado("Empleado","Agregado","11111111","F","222222","Noche","456456");
$pruebaTP1Fabrica->AgregarEmpleado($pruebaAddEmpleado);
print($pruebaTP1Fabrica->__toString());

///////////////////////////////////////////////////////////////////////////////////////////////////////
print("<br><br><font color='red'> Pruebo agregar un empleado repetido<br>" . "<font color='black'>");
$pruebaAddEmpleadoRepetido = new Empleado("Empleado","Agregado","11111111","F","222222","Noche","456456");
$pruebaTP1Fabrica->AgregarEmpleado($pruebaAddEmpleadoRepetido);
print($pruebaTP1Fabrica->__toString());

///////////////////////////////////////////////////////////////////////////////////////////////////////
print("<br><br><font color='red'> Elimino el empleado machacaxd <br>" . "<font color='black'>");
$pruebaRemoveEmpleado = new Empleado("Gaston","Machacaxd","45789654","M","100550","Noche","40000");
$pruebaTP1Fabrica->EliminarEmpleado($pruebaRemoveEmpleado);
print($pruebaTP1Fabrica->__toString());

echo '<a href="../backend/cerrarSesion.php"><br><br>Cerrar sesion</a>';

?>