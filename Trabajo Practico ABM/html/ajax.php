<?php
    include "../backend/validarSesion.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parte 6 TP 1</title>

    <style>
        #LinkDiv
            {
                position       : absolute                             ;
                height         : 20px                                 ;
                left           : 190px                                ;
                top            : 780px                                ;
                width          : 250px                                ;
                padding        : 1em                                  ;
                border-radius  : 1em                                  ;
                border         : 1px solid rgb(255, 102, 102)         ;
            }
            #LinkDiv p
            {
                text-decoration  : underline   ;
                text-align       : center      ;
                color            : black       ;
                font-size        : 20px        ;
                margin           : 0% auto     ;
            }
        #AlertDiv 
            {
                position       : absolute                          ;
                height         : 20px                              ;
                left           : 350px                             ;
                top            : 75px                              ;
                width          : 230px                             ;
                padding        : 1em                               ;
                border-radius  : 1em                               ;
                border         : 1px solid rgb(0, 128, 255)        ;
            }

            #AlertDiv h1
            {
                margin:-4% auto;
            }

        #pdf
            {
                position       : absolute                             ;
                height         : 20px                                 ;
                left           : 190px                                ;
                top            : 840px                                ;
                width          : 250px                                ;
                padding        : 1em                                  ;
            }
    </style>
    <script type="text/javascript" src="../javascript/app.js"></script>
    <script type="text/javascript" src="../javascript/ajax.js"></script>
    <script type="text/javascript" src="../javascript/funciones.js"></script>
</head>
<body>

    <div class="container" style="width:auto; height:auto" align="center">
        <div class="page-header">     
            <div id="AlertDiv">
                <h1>Francisco Rocha</h1>
            </div> 

            <table>
                <tbody>
                    <tr>
                        <td>                                
                            <div id="divAlta" style="top: 50px;height:700px;width:300px;">                           
                            </div>
                        </td>
                        <td>
                            <div id="divMostrar"style="height:825px;width:1250px;">                                
                            </div>  
                        </td>
                    </tr>
                </tbody>
            </table> 
            <div id="LinkDiv">
                <a href="../backend/cerrarSesion.php"><p><b>Cerrar Sesion</b></p></a>
            </div>  

            <a href="../backend/partePDF.php" id="pdf">
                <button>PDF</button>
            </a>    
        </div>
    </div>
</body>
</html>