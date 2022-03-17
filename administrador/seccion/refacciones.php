<?php include("../template/cabecera.php"); ?>

<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtRefaccion = (isset($_POST['txtRefaccion'])) ? $_POST['txtRefaccion'] : "";
$txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
$txtExistencia = (isset($_POST['txtExistencia'])) ? $_POST['txtExistencia'] : "";
$txteconomico = (isset($_POST['txteconomico'])) ? $_POST['txteconomico'] : "";
$txtImg = (isset($_FILES['txtImg']['name'])) ? $_FILES['txtImg']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/bd.php");

switch ($accion) {

    case "Agregar":


        $sentenciaSQL = $conexion->prepare("INSERT INTO refacciones (refaccion, codigo, existencia, economico, img) VALUES (:Refaccion, :Codigo, :Existencia, :ecnonomico, :Img);");
        $sentenciaSQL->bindParam(':Refaccion', $txtRefaccion);
        $sentenciaSQL->bindParam(':Codigo', $txtCodigo);
        $sentenciaSQL->bindParam(':Existencia', $txtExistencia);
        $sentenciaSQL->bindParam(':economico', $txteconomico);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImg != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImg"]["name"] : "imagen.jpg";
        $tmpImagen = $_FILES["txtImg"]["tmp_name"];

        if ($tmpImagen != "") {

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }

        $sentenciaSQL->bindParam(':Img', $nombreArchivo);
        $sentenciaSQL->execute();
        header("location:refacciones.php");
        break;

    case "Modificar";

        $sentenciaSQL = $conexion->prepare("UPDATE refacciones SET refaccion=:Refaccion WHERE id=:ID");
        $sentenciaSQL->bindParam(':Refaccion', $txtRefaccion);
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE refacciones SET codigo=:Codigo WHERE id=:ID");
        $sentenciaSQL->bindParam(':Codigo', $txtCodigo);
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE refacciones SET existencia=:Existencia WHERE id=:ID");
        $sentenciaSQL->bindParam(':Existencia', $txtExistencia);
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();

        $sentenciaSQL = $conexion->prepare("UPDATE refacciones SET economico=:economico WHERE id=:ID");
        $sentenciaSQL->bindParam(':economico', $txteconomico);
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();

        if ($txtImg != "") {

            $fecha = new DateTime();
            $nombreArchivo = ($txtImg != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImg"]["name"] : "imagen.jpg";

            $tmpImagen = $_FILES["txtImg"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT img FROM refacciones WHERE id=:ID");
            $sentenciaSQL->bindParam(':ID', $txtID);
            $sentenciaSQL->execute();
            $Refaccion = $sentenciaSQL->fetch(PDO::FETCH_LAZY);



            if (isset($Refaccion["img"]) && ($Refaccion["img"] != "imagen.jpg")) {

                if (file_exists("../img/" . $Refaccion["img"])) {

                    unlink("../img/" . $Refaccion["img"]);
                }
            }


            $sentenciaSQL = $conexion->prepare("UPDATE refacciones SET img=:Img WHERE id=:ID");
            $sentenciaSQL->bindParam(':Img', $nombreArchivo);
            $sentenciaSQL->bindParam(':ID', $txtID);
            $sentenciaSQL->execute();
        }
        break;

    case "Cancelar":
        header("location:refacciones.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM refacciones WHERE id=:ID");
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();
        $Refaccion = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtRefaccion = $Refaccion['refaccion'];
        $txtCodigo = $Refaccion['codigo'];
        $txtExistencia = $Refaccion['existencia'];
        $txtId_Tractos = $Refaccion['economico'];
        $txtImg = $Refaccion['img'];


        break;

    case "Borrar":

        $sentenciaSQL = $conexion->prepare("SELECT img FROM refacciones WHERE id=:ID");
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();
        $Refaccion = $sentenciaSQL->fetch(PDO::FETCH_LAZY);



        if (isset($Refaccion["img"]) && ($Refaccion["img"] != "imagen.jpg")) {

            if (file_exists("../../img/" . $Refaccion["img"])) {

                unlink("../../img/" . $Refaccion["img"]);
            }
        }


        $sentenciaSQL = $conexion->prepare("DELETE FROM refacciones WHERE id=:ID");
        $sentenciaSQL->bindParam(':ID', $txtID);
        $sentenciaSQL->execute();
        header("location:refacciones.php");

        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM refacciones");
$sentenciaSQL->execute();
$listaRefacciones = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-4">
    Agregar Refacciones
    <div class="card">
        <div class="card-header">
            Descripcion de las refacciones
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">


                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="id">
                </div>


                <div class="form-group">
                    <label for="txtRefaccion">Refaccion:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtRefaccion; ?>" name="txtRefaccion" id="txtRefaccion" placeholder="refaccion">
                </div>

                <div class="form-group">
                    <label for="txtCodigo">Codigo:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtCodigo; ?>" name="txtCodigo" id="txtCodigo" placeholder="codigo">
                </div>

                <div class="form-group">
                    <label for="txtExistencia">Existencia:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtExistencia; ?>" name="txtExistencia" id="txtExistencia" placeholder="existencia">
                </div>

                <div class="form-group">
                    <label for="txteconomico">Economico:</label>
                    <input type="text" required class="form-control" value="<?php echo $txteconomico; ?>" name="txteconomico" id="txteconomico" placeholder="economico">
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
                <th>Refaccion</th>
                <th>Codigo</th>
                <th>Existencia</th>
                <th>economico</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($listaRefacciones as $Refaccion) { ?>


                <tr>
                    <td><?php echo $Refaccion['id']; ?></td>
                    <td><?php echo $Refaccion['refaccion']; ?></td>
                    <td><?php echo $Refaccion['codigo']; ?></td>
                    <td><?php echo $Refaccion['existencia']; ?></td>
                    <td><?php echo $Refaccion['economico']; ?></td>
                    <td>
                        <img class="img-thumbail rounded" src="../../img/<?php echo $Refaccion['img']; ?>" width="170" alt="" srcset="">
                    </td>
                    <td>
                        <form method="post">

                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $Refaccion['id']; ?>" />
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
