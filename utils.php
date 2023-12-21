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
