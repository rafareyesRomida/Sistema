<?php include("template/cabecera.php"); ?>
<h1>REFACCIONES</h1>

<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
</div>

<?php 
include("administrador/config/bd.php");
$sentenciaSQL = $conexion->prepare("SELECT * FROM refacciones");
$sentenciaSQL->execute();
$listaRefacciones =$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>


<?php foreach($listaRefacciones as $Refaccion) {?>
    

<div class="col-md-4">
    <div class="card">
        <img class="card-img-top" src="./img/<?php echo $Refaccion['img']; ?>" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $Refaccion['refaccion']; ?></h4>
            <td> <?php echo $Refaccion['codigo']; ?></td>
            <h6 class="card-title">Existencias: <?php echo $Refaccion['existencia']; ?></h6>

            
        </div>
    </div> 
</div>

<?php } ?>
<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
</div>

<?php include("template/pie.php"); ?>