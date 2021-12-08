<?php
    include "validarSesion.php";
    include "../php/fabrica.php";
    require '../archivos/vendor/autoload.php';

    header('content-type:application/pdf');

    $mifabrica = new Fabrica("PDF", 100);
    $mifabrica -> TraerDeArchivo("empleados.txt");

    $mpdf = new \Mpdf\Mpdf(['orientation' => 'P']);
    
    ob_start();

    $tabla = '<table style="width:100%;text-align:center;border: 1px solid black; border-collapse: collapse;" border="1" cellspacing="0" cellpadding="4">';
    $tabla .= '<thead>';
    $tabla .= '<tr>'."<th>Listado de Empleados<br>Info</th>".'</tr>';
    $tabla .= '</thead>';

    foreach($mifabrica->GetEmpelados() as $misEmpleados)
    {
        $tabla .= '<tr>';
            $tabla .= "<td>".$misEmpleados->__toString();
            $tabla .= '<td style="margin: 0 auto; width: 130px"><img src="'.$misEmpleados->GetPathFoto().'" width="90" height="90"></td>';
        $tabla .= '</tr>';
    }
    $tabla .= '</table>';

    ob_end_clean();

    $mpdf->SetProtection(array(), $_SESSION["txtDni"], '004');

    $mpdf->SetHeader('Rocha Francisco PAGINA {PAGENO} DE {nbpg}');

    $mpdf->WriteHTML($tabla);

    $mpdf->SetFooter('https://www.cariverplate.com.ar/');
    
    $mpdf->Output();
?>