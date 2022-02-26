<?php include("template/cabecera.php"); ?>
<h1>SERVICIOS</h1>
<div class="alert alert-dismissible alert-info">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">SERVICIOS</h4>
  <p class="mb-2">Aqui se mostraran los ultimos servicios de cada una de las unidades asi como en que fecha se tienen que realizar los proximos servicios<a href="#" class="alert-link"></a>.</p>
</div>

<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtMarca = (isset($_POST['txtMarca'])) ? $_POST['txtMarca'] : "";
$txtPlacas = (isset($_POST['txtPlacas'])) ? $_POST['txtPlacas'] : "";
include("administrador/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT id_tractos, Marca, Placas FROM tractos");
$sentenciaSQL->execute();
$listaServicios = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>



<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Unidad</th>
      <th scope="col">Placas</th>
      <th scope="col">Ultimo servicio</th>
      <th scope="col">Proximo servicio</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($listaServicios as $Servicio) { ?>


<tr>
    <td><?php echo $Servicio['id_tractos']; ?></td>
    <td><?php echo $Servicio['Marca']; ?></td>
    <td><?php echo $Servicio['Placas']; ?></td>
  
    <td>
        <form method="post">

            <input type="hidden" name="txtID" id="txtID" value="<?php echo $Servicio['id_tractos']; ?>" />

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