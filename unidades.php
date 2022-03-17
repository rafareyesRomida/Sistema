<?php include("template/cabecera.php"); ?>
<h1>UNIDADES</h1>
<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
</div>

<?php


include("administrador/config/bd.php");
//$sentenciaSQL = $conexion->prepare("SELECT refacciones.id, refacciones.refaccion, refacciones.codigo, refacciones.existencia, refacciones.id_tractos, refacciones.img  FROM refacciones  WHERE id_tractos='$txtId_Tractos'");


$sentenciaSQL = $conexion->prepare("SELECT * FROM tractos");
$sentenciaSQL->execute();
$listaUnidades = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($listaUnidades as $Unidad) { ?>


  <div class="col-md-4">
    <div class="card">
      <img class="card-img-top" src="./img/<?php echo $Unidad['img']; ?>" alt="">
      <div class="card-body">
        <h3 class="card-title"><?php echo $Unidad['Marca']; ?></h3>
        <td> <?php echo $Unidad['Placas']; ?></td>
        <div class="form-group">
          <label for=""></label>
          <input type="text" class="form-control" name="" id="" value="<?php echo $Unidad['economico']; ?>" aria-describedby="helpId" placeholder="">
        </div>
      </div>
    </div>
  </div>



<?php } ?>
<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
</div>
<?php include("template/pie.php"); ?>
