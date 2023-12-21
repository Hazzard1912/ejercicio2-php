<?php
include './utils.php';
include_once './database.php';
?>

<h2 class="text-center">Subir Archivo de Texto</h2>

<form action="" method="post" enctype="multipart/form-data" class="d-flex justify-content-center">
  <div class="form-group text-center">
    <label class="mt-2" for="archivo">Seleccione un archivo de texto</label>
    <input type="file" class="form-control mt-2" name="archivo" id="archivo" accept=".txt" required>

    <button type="submit" name="submit" class="btn btn-primary mt-2">Subir Archivo</button>
  </div>
</form>

<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

  $archivoCargado = $_FILES['archivo'];

  $datos = procesar_archivo($archivoCargado);

  $pdo = get_pdo();
  insertar_datos_informacion($pdo, $datos);
}
