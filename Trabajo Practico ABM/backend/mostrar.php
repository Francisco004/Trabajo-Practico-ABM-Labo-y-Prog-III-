<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HTML 5 - Formulario Modificar Empleado</title>
        <style>
            .mostrar
            {
                padding        : 1em                                ;
                height         : 560px                              ;
                width          : 1200px                             ;
                margin         : 0 auto                             ;
                border-radius  : 1em                                ;
                border         : 1px solid rgb(0, 128, 255)         ;
                position       : relative                           ;
                top :20%;
               
            }
            .tablaListar
            {
                overflow-y: scroll  ;
                height    : 400px   ;
                display   : block   ;
            }
        </style>
        <script src="../javascript/ajax.js"></script>
        <script src="../javascript/app.js"></script>
        <script src="../javascript/funciones.js"></script>
    </head>

    <body>
        <form class="mostrar"> 
            <h2>Lista de empleados</h2>
                <tr>
                    <td>
                        <h4>Info</h4>
                    </td>
                </tr>

                <tr>
                    <td colspan="4">
                        <hr/>
                    </td>
                </tr>

                <table align="right" class="tablaListar">
                    <tr>
                        <?php
                        include "../backend/validarSesion.php";
                        include "../php/fabrica.php";
                            $FabricaDeEmpleados = new Fabrica("Mostrar",100);
                            $FabricaDeEmpleados->TraerDeArchivo("empleados.txt");

                            for($i = 0; $i < count($FabricaDeEmpleados->GetEmpelados()); $i++)
                            {
                                echo "<tr>";
                                echo "<td>".$FabricaDeEmpleados->GetEmpelados()[$i] . " " . "</td>";
                                echo '<td><img src="'.$FabricaDeEmpleados->GetEmpelados()[$i]->GetPathFoto().'"width="90" height="90"</td>';
                                echo '<td><a href="javascript:DeleteEmployee('.$FabricaDeEmpleados->GetEmpelados()[$i]->GetLegajo().')">Eliminar</a></td>';
                                echo '<td><input onclick="Main.ModificarEmpleado('.$FabricaDeEmpleados->GetEmpelados()[$i]->GetDni().')" type="button" value="Modificar" /></td>';
                                echo "</tr>";
                            }
                        ?>
                    </tr>
                </table>
        </form>
        <form  action="../html/index.php" method="POST" id="modificarForm">
            <input type="hidden" id="dniHidden" name="dniHidden"/>
        </form>
    </body>
</html>