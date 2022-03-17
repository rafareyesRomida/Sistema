<?php include("template/cabecera.php"); ?>
<h1>SERVICIOS</h1>
  </div>

<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtMarca = (isset($_POST['txtMarca'])) ? $_POST['txtMarca'] : "";
$txtPlacas = (isset($_POST['txtPlacas'])) ? $_POST['txtPlacas'] : "";
$txtid_tractos=(isset($_POST['id_tractos'])) ? $_POST['id_tractos'] : "";
include("administrador/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT tractos.id_tractos, tractos.Marca, tractos.Placas, tractos.economico, MAX(diesel.km), viajes.id_tractos, viajes.id_Viajes FROM viajes INNER JOIN diesel ON diesel.id_Viajes=viajes.id_Viajes INNER JOIN tractos ON viajes.id_tractos=tractos.id_tractos WHERE tractos.id_tractos='2'");
$sentenciaSQL->execute();
$listaKm = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>
<table class="table table-hover">
  <thead>
    <tr>
    <th scope="col">Id</th>
      <th scope="col">Unidad</th>
      <th scope="col">Economico</th>
      <th scope="col">Placas</th>
      <th scope="col">Kilometros por servicio</th>
    </tr>
  </thead>
  
  <tbody>
  <?php foreach ($listaKm as $km) { ?>
    <tr>
    <td><?php echo $km['id_tractos']; ?></td>
    <td><?php echo $km['Marca']; ?></td>
    <td><?php echo $km['Placas']?></td>
    <td><?php echo $km['economico']; ?></td>
    <td><?php echo $km['MAX(diesel.km)']; ?></td>
    

  
    <td>
        <form method="post">

            <input type="text" name="txtID" id="txtID" value="<?php echo $Servicio['id_tractos']; ?>" />

        </form>
    </td>
</tr>
<?php } ?>


  </tbody>
</table>




<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
</div>

<?php include("template/pie.php"); ?>
