<!DOCTYPE html>
<?php
session_start();
    if(!isset($_SESSION['usuario'])){
        header("Location:../index.php");
    }else{

        if($_SESSION['usuario']=="ok"){
            $nombreUsuario=$_SESSION["nombreUsuario"];
        }
    }

?>
<html lang="en">

<head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php $url = "http://" . $_SERVER['HTTP_HOST'] . "/RMDmecanicos" ?>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador del sitio web <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/inicio.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/unidades.php">Administrador de unidades</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/refacciones.php">Administrador de refacciones</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>">Ir a sitio web</a>
            <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/cerrar.php">Cerrar</a>
        </div>
    </nav>
    </br>
    <div class="container">
        <div class="row">