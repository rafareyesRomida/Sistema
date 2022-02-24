<?php include("template/cabecera.php"); ?>

<h1>REPARACIONES</h1>
<div class="alert alert-dismissible alert-info">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Reparaciones</h4>
  <p class="mb-1">Aqui se mostraran las reparaciones necesarias para cada una de las unidades. <a href="#" class="alert-link"></a></p>
</div>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#home">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#profile">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#">Disabled</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <a class="dropdown-item" href="#">Something else here</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Separated link</a>
    </div>
  </li>
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade" id="home">
    <p>Primer texto.</p>
  </div>
  <div class="tab-pane fade active show" id="profile">
    <p>Segundo texto.</p>
  </div>
  <div class="tab-pane fade" id="dropdown1">
    <p>Tercer texto.</p>
  </div>
  <div class="tab-pane fade" id="dropdown2">
    <p>Tercer pago.</p>
  </div>
</div>








<?php include("template/pie.php"); ?>