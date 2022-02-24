<?php
$host = "cpl30.main-hosting.eu";
$bd = "rmdterre_rmdPrueba";
$usuario = "rmdterre_foraneo";
$contrasenia = "rmdterrestre.1234";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd", $usuario, $contrasenia);
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>