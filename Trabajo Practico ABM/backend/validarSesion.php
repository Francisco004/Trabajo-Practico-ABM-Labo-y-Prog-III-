<?php

session_start();

if (empty($_SESSION["txtDni"]))
{
    header("Location: ../html/login.html");
    exit();
}

?>