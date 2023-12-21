<?php

function insertar_datos_informacion($db, $datos)
{
  $query = "INSERT INTO informacion (nombrearchivo, cantlineas, cantpalabras, cantcaracteres, fecharegistro) VALUES (?,?,?,?,?) ";

  try {

    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $datos['nombrearchivo']);
    $stmt->bindParam(2, $datos['cantlineas']);
    $stmt->bindParam(3, $datos['cantpalabras']);
    $stmt->bindParam(4, $datos['cantcaracteres']);
    $stmt->bindParam(5, $datos['fecharegistro']);

    if ($stmt->execute()) {
      echo "<script>alert('Archivo cargado correctamente');</script>";
    } else {
      $error = $stmt->errorInfo();
      echo "Error SQLSTATE: " . $error[0] . "<br>";
      echo "Código de error: " . $error[1] . "<br>";
      echo "Mensaje de error: " . $error[2] . "<br>";
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
  }
}


function obtener_datos_informacion($db)
{
  $query = "SELECT * FROM informacion";

  try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
  }
}


function obtener_datos_paginacion($db, $pagina_actual)
{
  try {
    $filas_por_pagina = 10;

    $stmt = $db->query("SELECT COUNT(*) FROM informacion");
    $total_filas = $stmt->fetchColumn();

    $total_paginas = ceil($total_filas / $filas_por_pagina);

    if ($pagina_actual < 1) {
      $pagina_actual = 1;
    } elseif ($pagina_actual > $total_paginas) {
      $pagina_actual = $total_paginas;
    }

    $offset = ($pagina_actual - 1) * $filas_por_pagina;

    $stmt = $db->prepare("SELECT * FROM informacion LIMIT :filas_por_pagina OFFSET :offset");
    $stmt->bindParam(':filas_por_pagina', $filas_por_pagina, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    if ($stmt->execute()) {
      $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $datos;
    } else {
      $error = $stmt->errorInfo();
      echo "Error SQLSTATE: " . $error[0] . "<br>";
      echo "Código de error: " . $error[1] . "<br>";
      echo "Mensaje de error: " . $error[2] . "<br>";
    }
  } catch (PDOException $e) {
    // Manejo de errores
    echo "Error: " . $e->getMessage();
    die();
  }
}


function procesar_archivo($archivo)
{

  if (!file_exists($archivo['tmp_name'])) return;

  $nombrearchivo = $archivo['name'];
  $archivo = $archivo['tmp_name'];
  $contenido = file_get_contents($archivo);
  $cantlineas = count(explode("\n", $contenido));
  $cantpalabras = preg_match_all('/\S+/', $contenido);
  $cantcaracteres = strlen(str_replace("\n", "", $contenido));
  $fecharegistro = date('Y-m-d H:i:s');

  $datos = [
    'nombrearchivo' => $nombrearchivo,
    'cantlineas' => $cantlineas,
    'cantpalabras' => $cantpalabras,
    'cantcaracteres' => $cantcaracteres,
    'fecharegistro' => $fecharegistro
  ];

  return $datos;
}
