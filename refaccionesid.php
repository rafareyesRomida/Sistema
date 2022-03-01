<?php include("template/cabecera.php"); ?>

<?php

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtRefaccion = (isset($_POST['txtRefaccion'])) ? $_POST['txtRefaccion'] : "";
$txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
$txtExistencia = (isset($_POST['txtExistencia'])) ? $_POST['txtExistencia'] : "";
$txtId_Tractos = (isset($_POST['txtId_Tractos'])) ? $_POST['txtId_Tractos'] : "";
$txtImg = (isset($_FILES['txtImg']['name'])) ? $_FILES['txtImg']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
?>




      <?php
      include("administrador/config/bd.php");
      $sentenciaSQL = $conexion->prepare("SELECT * FROM refacciones WHERE id_tractos=:Id_Tractos");
      $sentenciaSQL->bindParam(':Id_Tractos', $txtId_Tractos);
      $sentenciaSQL->execute();
      $listaRefacciones =$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
      ?>
      

        <?php
       /* header("location:refaccionesid.php");
        break;
        

}*/?>






<div class="col-md-4">
    Agregar Refacciones
    <div class="card">
        <div class="card-header">
            Descripcion de las refacciones
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">


                

                <div class="form-group">
                    <label for="txtId_Tractos">Id_Tracto:</label>
                    <input type="text" required class="form-control" value="1" name="txtId_Tractos" id="txtId_Tractos" placeholder="id_tractos">
                </div>
                

                
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion"  value="Buscar" class="btn btn-info">Buscar</button>
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
                <th>Id_Tractos</th>
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
                    <td><?php echo $Refaccion['id_tractos']; ?></td>
                    <td>
                        <img class="img-thumbail rounded" src="img/<?php echo $Refaccion['img']; ?>" width="170" alt="" srcset="">
                    </td>
                        <form method="post">

                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>




<?php include("template/pie.php"); ?>
