<?php include("../template/cabecera.php"); ?>

<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtMarca = (isset($_POST['txtMarca'])) ? $_POST['txtMarca'] : "";
$txtPlacas = (isset($_POST['txtPlacas'])) ? $_POST['txtPlacas'] : "";
$txtEconomico = (isset($_POST['txtEconomico'])) ? $_POST['txtEconomico'] : "";
$txtCapacidadLts = (isset($_POST['txtCapacidadLts'])) ? $_POST['txtCapacidadLts'] : "";
$txtImg = (isset($_FILES['txtImg']['name'])) ? $_FILES['txtImg']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/bd.php");

switch ($accion) {

    case "Agregar":


        $sentenciaSQL = $conexion->prepare("INSERT INTO tractos (Marca, Placas, economico, capacidadLts) VALUES (:Marca, :Placas, :Economico, :CapacidadLts);");
        $sentenciaSQL->bindParam(':Marca', $txtMarca);
        $sentenciaSQL->bindParam(':Placas', $txtPlacas);
        $sentenciaSQL->bindParam(':Economico', $txtEconomico);
        $sentenciaSQL->bindParam(':CapacidadLts', $txtCapacidadLts);
        $sentenciaSQL->execute();

        $fecha = new DateTime();
        $nombreArchivo = ($txtImg != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImg"]["name"] : "imagen.jpg";
        $tmpImagen = $_FILES["txtImg"]["tmp_name"];

        if ($tmpImagen != "") {

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':Img', $nombreArchivo);
        $sentenciaSQL->execute();
        header("location:unidades.php");
        break;


        case "Modificar";

        $sentenciaSQL = $conexion->prepare("UPDATE tractos SET Marca=:Marca WHERE id_tractos=:ID");
        $sentenciaSQL->bindParam(':Marca', $txtMarca);
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE tractos SET Placas=:Placas WHERE id_tractos=:ID");
        $sentenciaSQL->bindParam(':Placas', $txtPlacas);
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE tractos SET economico=:Economico WHERE id_tractos=:ID");
        $sentenciaSQL->bindParam(':Economico', $txtEconomico);
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE tractos SET capacidadLts=:CapacidadLts WHERE id_tractos=:ID");
        $sentenciaSQL->bindParam(':CapacidadLts', $txtCapacidadLts);
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();

        if ($txtImg != "") {

            $fecha = new DateTime();
            $nombreArchivo = ($txtImg != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImg"]["name"] : "imagen.jpg";

            $tmpImagen = $_FILES["txtImg"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT img FROM tractos WHERE id_tractos=:ID");
            $sentenciaSQL->bindParam(':ID', $txtID);
            $sentenciaSQL->execute();
            $Unidad = $sentenciaSQL->fetch(PDO::FETCH_LAZY);


            


            if (isset($Unidad["img"]) && ($Unidad["img"] != "imagen.jpg")) {

                if (file_exists("../../img/" . $Unidad["img"])) {

                    unlink("../../img/" . $Unidad["img"]);
                }
            }


            $sentenciaSQL = $conexion->prepare("UPDATE tractos SET img=:Img WHERE id_tractos=:ID");
            $sentenciaSQL->bindParam(':Img', $nombreArchivo);
            $sentenciaSQL->bindParam(':ID', $txtID);
            $sentenciaSQL->execute();
        }
        break;

    case "Cancelar":
        header("location:unidades.php");
        break;

    case "Seleccionar":
            $sentenciaSQL = $conexion->prepare("SELECT * FROM tractos WHERE id_tractos=:ID");
            $sentenciaSQL->bindParam(':ID', $txtID);
            $sentenciaSQL->execute();
            $Unidad = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtMarca = $Unidad['Marca'];
            $txtPlacas = $Unidad['Placas'];
            $txtEconomico = $Unidad['economico'];
            $txtCapacidadLts = $Unidad['capacidadLts'];
            $txtImg = $Unidad['img'];
            

        break;
    
    case "Borrar":
            $sentenciaSQL = $conexion->prepare("DELETE FROM tractos WHERE id_tractos=:ID");
            $sentenciaSQL->bindParam(':ID', $txtID);
            $sentenciaSQL->execute();
            $Unidad = $sentenciaSQL->fetch(PDO::FETCH_LAZY);



            if (isset($Unidad["img"]) && ($Unidad["img"] != "imagen.jpg")) {
    
                if (file_exists("../../img/" . $Unidad["img"])) {
    
                    unlink("../../img/" . $Unidad["img"]);
                }
            }
    
    
            $sentenciaSQL = $conexion->prepare("DELETE FROM tractos WHERE id_tractos=:ID");
            $sentenciaSQL->bindParam(':ID', $txtID);
            $sentenciaSQL->execute();
            header("location:unidades.php");

            break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM tractos");
$sentenciaSQL->execute();
$listaUnidades = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-4">
    Agregar unidades
    <div class="card">
        <div class="card-header">
            Descripcion de las unidades
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">


                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="id_tractos">
                </div>


                <div class="form-group">
                    <label for="txtMarca">Marca:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtMarca; ?>" name="txtMarca" id="txtMarca" placeholder="Marca">
                </div>

                <div class="form-group">
                    <label for="txtPlacas">Placas:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtPlacas; ?>" name="txtPlacas" id="txtPlacas" placeholder="Placas">
                </div>

                <div class="form-group">
                    <label for="txtEconomico">Economico:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtEconomico; ?>" name="txtEconomico" id="txtEconomico" placeholder="economico">
                </div>

                <div class="form-group">
                    <label for="txtCapacidadLts">CapacidadLts:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtCapacidadLts; ?>" name="txtCapacidadLts" id="txtCapacidadLts"
                        placeholder="capacidadLts">
                </div>
                <div class="form-group">
                    <label for="txtImg">Imagen:</label>
                <br/>
                <?php if ($txtImg != "") { ?>
                    <img class="img-thumbail rounded" src="../../img/<?php echo $txtImg;?>" width="170" alt="" srcset="">
                    <?php } ?>


                    <input type="file" required class="form-control" value="<?php echo $txtImg; ?>" name="txtImg" id="txtImg" placeholder="img">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                    
                </div>
            </form> 
        </div>

    </div>

</div>
<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Placas</th>
                <th>Economico</th>
                <th>CapacidadLts</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($listaUnidades as $Unidad) { ?>


            <tr>
                <td><?php echo $Unidad['id_tractos']; ?></td>
                <td><?php echo $Unidad['Marca']; ?></td>
                <td><?php echo $Unidad['Placas']; ?></td>
                <td><?php echo $Unidad['economico']; ?></td>
                <td><?php echo $Unidad['capacidadLts']; ?></td>
                
                <td>
                        <img class="img-thumbail rounded" src="../../img/<?php echo $Unidad['img']; ?>" width="170" alt="" srcset="">
                    </td>
                <td>
                <form method="post">

                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $Unidad['id_tractos']; ?>" />
                    <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />
                    <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                 </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>




<?php include("../template/pie.php"); ?>