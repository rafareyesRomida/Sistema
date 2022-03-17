<?php include("template/cabecera.php"); ?>

<?php

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtRefaccion = (isset($_POST['txtRefaccion'])) ? $_POST['txtRefaccion'] : "";
$txtcodigo = (isset($_POST['txtcodigo'])) ? $_POST['txtcodigo'] : "";
$txtExistencia = (isset($_POST['txtExistencia'])) ? $_POST['txtExistencia'] : "";
$txteconomico = (isset($_POST['txteconomico'])) ? $_POST['txteconomico'] : "";
$txtImg = (isset($_FILES['txtImg']['name'])) ? $_FILES['txtImg']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
?>



      <?php
      include("administrador/config/bd.php");
      $sentenciaSQL = $conexion->prepare("SELECT * FROM refacciones WHERE economico=:economico");
      $sentenciaSQL->bindParam(':economico', $txteconomico);
      $sentenciaSQL->execute();
      $listaRefacciones =$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

      


      ?>
        <?php
       /* header("location:refaccionesid.php");
        break;

}*/?>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="txteconomico">Numero economico de la unidad:</label>
                    <input type="text" required class="form-control" value="0" name="txteconomico" id="txteconomico" placeholder="economico">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion"  value="Buscar" class="btn btn-info">Buscar</button>
                </div>

            </form>
        </div>

    </div>

</div>

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
           
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="txtcodigo">Codigo de refaccion:</label>
                    <input type="text" required class="form-control" value="0" name="txtcodigo" id="txtcodigo" placeholder="codigo">
                </div>
                
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion"  value="Buscar" class="btn btn-info">Buscar</button>
                </div>

            </form>
        </div>

    </div>

</div>

<div class="col-md-12">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Refaccion</th>
                <th>Codigo</th>
                <th>Existencia</th>
                <th>Economico</th>
                <th>Equivalencias</th>
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
                    <td><?php echo $Refaccion['Equivalencia']; ?></td>
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
