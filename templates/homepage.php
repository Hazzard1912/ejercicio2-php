<?php
require './model/informacion.php';
$informacion = new Informacion();
?>


<h1 class="text-center p-4">Prueba Tecnica PHP</h1>
<?php include './formularios/cargar_archivo.php'; ?>

<hr>

<div class="col-sm-10 mx-auto my-4">

  <div class="table-responsive">
    <table id="registros" class="table table-striped table-bordered">
      <thead>
        <th>
          <div class="text-center">Código</div>
        </th>
        <th>
          <div class="text-center">Nombre Archivo</div>
        </th>
        <th>
          <div class="text-center">Número de Lineas</div>
        </th>
        <th>
          <div class="text-center">Número de Palabras</div>
        </th>
        <th>
          <div class="text-center">Número de caracteres</div>
        </th>
        <th>
          <div class="text-center">Fecha de Registro</div>
        </th>
      </thead>
      <tbody>
        <?php
        $datos_informacion = $informacion->viewRegistros();
        foreach ($datos_informacion as $dato) {
        ?>
          <tr>
            <td>
              <div class="text-center">
                <?php echo $dato['codigo']; ?></div>
            </td>
            <td>
              <div class="text-center">
                <?php echo $dato['nombrearchivo']; ?>
              </div>
            </td>
            <td>
              <div class="text-center">
                <?php echo $dato['cantlineas']; ?>
              </div>
            </td>
            <td>
              <div class="text-center">
                <?php echo $dato['cantpalabras']; ?>
              </div>
            </td>
            <td>
              <div class="text-center">
                <?php echo $dato['cantcaracteres']; ?>
              </div>
            </td>
            <td>
              <div class="text-center">
                <?php echo $dato['fecharegistro']; ?>
              </div>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="container-fluid">
    <div class="row text-center mt-4 justify-content-center align-items-center">
      <div class="form-group text-center col-md-2">
        <form action="generar_pdf.php" method="post">
          <label for="primer_registro" class="">Primer registro:</label><br>
          <input type="number" id="primer_registro" class="form-control mt-2" name="primer_registro" required><br>
          <label for="ultimo_registro">Último registro:</label><br>
          <input type="number" id="ultimo_registro" class="form-control mt-2" name="ultimo_registro" required><br>
          <input type="submit" value="Generar PDF" class="btn btn-warning">
        </form>
      </div>
    </div>
  </div>
</div>