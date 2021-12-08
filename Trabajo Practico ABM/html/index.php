<?php
    include "../backend/validarSesion.php";
    include "../php/fabrica.php";

    $modificar = 0;
    $dni       = null;
    $foto      = null;
    $nombre    = null;
    $sueldo    = null;
    $legajo    = null;
    $apellido  = null;
    $sexo      = "---";
    $btn       = "Enviar";
    $turno     = "mañana";
    $subtitulo = "Alta de empleado";
    $titulo    = "HTML 5 – Formulario Alta Empleado";

    if(isset($_POST["dniHidden"]))
    {
        $FabricaModificar = new Fabrica("Modificar",100);
        
        $FabricaModificar->TraerDeArchivo("empleados.txt");

        for($i = 0; $i<count($FabricaModificar->GetEmpelados()); $i++)
        {
            if($FabricaModificar->GetEmpelados()[$i]->GetDni() == $_POST["dniHidden"])
            {
                $modificar = 1;
                $btn       = "Modificar";
                $subtitulo = "Modificar empleado";
                $titulo    = "HTML 5 - Formulario Modificar Empleado";
                $dni       = $FabricaModificar->GetEmpelados()[$i]->GetDni();
                $sexo      = $FabricaModificar->GetEmpelados()[$i]->GetSexo();
                $turno     = $FabricaModificar->GetEmpelados()[$i]->GetTurno();
                $nombre    = $FabricaModificar->GetEmpelados()[$i]->GetNombre();
                $sueldo    = $FabricaModificar->GetEmpelados()[$i]->GetSueldo();
                $legajo    = $FabricaModificar->GetEmpelados()[$i]->GetLegajo();
                $foto      = $FabricaModificar->GetEmpelados()[$i]->GetPathFoto();
                $apellido  = $FabricaModificar->GetEmpelados()[$i]->GetApellido();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $titulo; ?></title>
    
        <style>
            .alta
            {
                overflow-y: scroll  ;
                height    : 560px   ;
                padding         : 1em                                ;
                width           : 260px                              ;
                margin          : 0 auto                             ;
                border-radius   : 1em                                ;
                border          : 1px solid rgb(0, 128, 255)         ;
                position        : relative                           ;
                top             : 100px                              ;
            }
            .alta h2
            {
                text-align:center;
            }
        </style>
        <script src="../javascript/ajax.js"></script>
        <script src="../javascript/app.js"></script>
        <script src="../javascript/funciones.js"></script>

    </head>

    <body>
        <div>
        <form class="alta" id="frmIngreso" enctype="multipart/form-data">
        <!--<form class="alta" action="../php/administracion.php" method="POST" enctype="multipart/form-data">!-->
            <h2><?php echo $subtitulo; ?></h2>

                <h4>Datos personales</h4>

                    <table>

                        <hr>

                        <table align="left" class="tablaPersonal">

                            <tr>
                                <td><input id="hdnModificar" name="hdnModificar" type="hidden" value="<?php echo $dni; ?>"></td> 
                            </tr>

                            <tr>
                                <td>DNI:</td>
                                <td><input id="txtDni" name="txtDni" type="number" min="1000000" max="55000000" value="<?php echo $dni; ?>" <?php if($modificar == 1){echo "readonly";} ?> required><span style="display:none" id="spanDNI">*</span></td>                     
                            </tr>

                            <tr>
                                <td>Apellido:</td>
                                <td><input id="txtApellido" name="txtApellido" type="text" value="<?php echo $apellido; ?>" required><span style="display:none" id="spanApellido">*</span></td>                      
                            </tr>

                            <tr>
                                <td>Nombre:</td>
                                <td><input id="txtNombre" name="txtNombre" type="text" value="<?php echo $nombre; ?>" required><span style="display:none" id="spanNombre">*</span></td>                    
                            </tr>

                            <tr>
                                <td>Sexo:</td>
                                <td>
                                    <select name="sexo" id="sexo" required>
                                    <option value="<?php echo $sexo; ?>" selected hidden><?php echo $sexo; ?></option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    </select> 
                                    <span style="display:none" id="spanSexo">*</span>
                                </td> 
                            </tr>
                            <tr>
                                <td>ㅤ

                                </td>
                            </tr>
                        </table>

                        <h4>Datos laborales</h4>
     
                            <hr>

                            <table align="left" class="tablaLaboral">
                                <tr>
                                    <td>Legajo:</td>
                                    <td><input id="txtLegajo" name="txtLegajo" type="number" size="6" maxlength="3" min="100" max="550" value="<?php echo $legajo; ?>" <?php if($modificar == 1){echo "readonly";} ?> required><span style="display:none" id="spanLegajo">*</span></td>                    
                                </tr>

                                <tr>
                                    <td><label for="txtSueldo">Sueldo:</label></td>
                                    <td><input id="txtSueldo" name="txtSueldo" type="number" min="8000" step="500" max="25000" value="<?php echo $sueldo; ?>" required style="width: 155px;"><span style="display:none" id="spanSueldo">*</span></td>                    
                                </tr>

                                <tr>
                                 <td>Turno:</td>                
                                </tr>

                                <tr>		
                                    <td style="text-align:left;padding-left:40px">
                                    <input type="radio" name="radioTurno" value="mañana" id="radioM" <?php if($turno == "mañana"){echo 'checked="checked"';}?>/>						
                                    </td>
                                    <td>Mañana</td>
                                </tr>

                                <tr>				
                                    <td style="text-align:left;padding-left:40px">
                                    <input type="radio" name="radioTurno" value="tarde" id="radioT" <?php if($turno == "tarde"){echo 'checked="checked"';}?>/>						
                                    </td>
                                    <td>Tarde</td>
                                </tr>

                                <tr>					
                                    <td style="text-align:left;padding-left:40px">
                                    <input type="radio" name="radioTurno" value="noche" id="radioN" <?php if($turno == "noche"){echo 'checked="checked"';}?>/>				
                                    </td>
                                    <td>Noche</td>
                                </tr>

                                <table>
                                    <tr>
                                        <td>Foto:</td>
                                            <tr>
                                                <td><input name="imagenEmpleado" id="imagenEmpleado" type="file" required/><span style="display:none" id="spanFoto">*</span></td>
                                            </tr>
                                    </tr>
                                </table>				
                    

                                <hr>

                                <table>
                                    <tr>
                                        <td style="position: inherit;padding-left: 250%;"><input type="reset" id="btnLimpiar" value="Limpiar" /></td>
                                    </tr>

                                    <tr>
                                        <!--<td style="padding-left: 250%"><input onclick="AdministrarValidaciones()" type="submit" id="btnEnviar" value="<?php echo $btn; ?>"/></td>!-->
                                        <td style="padding-left: 250%"><input onclick="Main.CargarDatos()" type="button" id="btnEnviar" value="<?php echo $btn; ?>"/></td>
                                    </tr>
                                </table>

                            </table>
                    </table>
        </form>
    </body>
</html>