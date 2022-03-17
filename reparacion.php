<?php include("template/cabecera.php"); ?>
<?php
include("administrador/config/bd.php");

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
//datos para transferir
$txtMarca = (isset($_POST['txtMarca'])) ? $_POST['txtMarca'] : "";
$txtTipo_Servicio = (isset($_POST['txtTipo_Servicio'])) ? $_POST['txtTipo_Servicio'] : "";
$txtFecha_Servicio = (isset($_POST['txtFecha_Servicio'])) ? $_POST['txtFecha_Servicio'] : "";
$txtEncargado = (isset($_POST['txtEncargado'])) ? $_POST['txtEncargado'] : "";
$txtPuesto = (isset($_POST['txtPuesto'])) ? $_POST['txtPuesto'] : "";
$txtArea = (isset($_POST['txtArea'])) ? $_POST['txtArea'] : "";
$txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";

switch ($accion) {
 
    case "Guardar":

      $sentenciaSQL = $conexion->prepare("INSERT INTO servicios (Marca,tipo_Servicio, fecha_Servicio, encargado, puesto, area, descripcion) VALUES (:Marca, :tipo_Servicio, :fecha_Servicio, :encargado, :puesto, :area, :descripcion);");
        $sentenciaSQL->bindParam(':Marca', $txtMarca);
        $sentenciaSQL->bindParam(':tipo_Servicio', $txtTipo_Servicio);
        $sentenciaSQL->bindParam(':fecha_Servicio', $txtFecha_Servicio);
        $sentenciaSQL->bindParam(':encargado', $txtEncargado);
        $sentenciaSQL->bindParam(':puesto', $txtPuesto);
        $sentenciaSQL->bindParam(':area', $txtArea);
        $sentenciaSQL->bindParam(':descripcion', $txtDescripcion);
        $sentenciaSQL->execute();
        break;
    
}
$sentenciaSQL = $conexion->prepare("SELECT * FROM `tractos` ORDER BY Marca ASC");
$sentenciaSQL->execute();
$listaTractos = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<CEnter>
    <h2>Reparacion de unidades</h2>
</CEnter>

<div class="col-md-12">
    <br>
    <div class="card text-black alert-primarys mb-3">
        <div class="card-header">Informacion Completa</div>
        <div ALIGN=RIGHT>
            <h6 id="fecha_Servicio" type="hidden">
                <script>
     
                </script>
            </h6>
        </div>

        <form action="" method="post" enctype="multipart/form-data">

            <div align="left">
                
                    <div class="col-xs-12 col-sm-2">
                        <small id="helpId" class="form-text text-black">Unidad</small>
                        <select name="concepNombre" id="concep-select1">
                                <?php foreach ($listaTractos as $tractos) { ?>
                                    <option value="<?php echo $tractos['Marca'] ?>"><?php echo $tractos['Marca'] ?></option>
                                <?php } ?>
                            </select> 
                            </div>
            
            </div>

            <br>

            

                <div class="row ">
                    <div class="col-xs-12 col-sm-6">
                    <small id="helpId" class="form-text text-black">Fecha del servicio</small>
                        <?php $fecha = date("Y-m-d"); ?>
                        <input type="date" class="form-control" value="" name="txtFecha_Servicio" id="txtFecha_Servicio">
                        <small id="helpId" class="form-text text-black">Encargado</small>
                        <input type="text" class="form-control" name="txtEncargado" id="txtEncargado" value="" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-black">Area</small>
                        <input type="text" class="form-control" name="txtArea" id="txtArea" value="" aria-describedby="helpId" placeholder="">
                        

                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <small id="helpId" class="form-text text-black">Tipo de Servicio</small>
                        <input type="text" class="form-control" name="txtTipo_Servicio" id="txtTipo_Servicio" value="" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-black">Puesto</small>
                        <input type="text" class="form-control" name="txtPuesto" id="txtPuesto" value="" aria-describedby="helpId" placeholder="">
                    </div>
                    <br>
                    <br>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                    </div>
                    <br>
                    <div class="col-xs-12 col-sm-12">
                        <small id="helpId" class="form-text text-black">Descripcion del servicio</small>
                        <input type="text" class="form-control" name="txtDescripcion" id="txtDescripcion" value="" aria-describedby="helpId" placeholder="">
                    </div>
                    
                    
                    
        


            
            <BR></BR>

    </div>
    <br>


    <center>
        <div class="btn-group" role="group" aria-label="">
            <input type="text" name="txtID" id="txtID" value="" />
            </div>
    </center>


    <center>
        <div class="btn-group" role="group" aria-label="">
        <input type="submit" name="accion" value="Guardar" class="btn btn-success" />
        <input type="submit" name="accion" value="Cancelado" class="btn btn-danger" />
        </div>
    </center>

    </form>
    <BR></BR>

</div>
</div>
<br>
<?php include("template/pie.php"); ?>
