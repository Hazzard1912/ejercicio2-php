<?php

include_once './database.php';

class Informacion
{

  function viewRegistros()
  {
    $pdo = get_pdo();
    $query = "SELECT codigo,
                            nombrearchivo,
                            cantlineas,
                            cantpalabras,
                            cantcaracteres,
                            fecharegistro
                    FROM informacion
                    ORDER BY codigo ASC";
    $modules = $pdo->prepare($query);
    $modules->execute();
    $datos_informacion = $modules->fetchAll();
    return $datos_informacion;
  }

  function viewRegistrosPorRango($primer_registro, $ultimo_registro)
  {
    $pdo = get_pdo();
    $query = "SELECT codigo,
                            nombrearchivo,
                            cantlineas,
                            cantpalabras,
                            cantcaracteres,
                            fecharegistro
                    FROM informacion
                    WHERE codigo BETWEEN :primer_registro AND :ultimo_registro
                    ORDER BY codigo ASC";
    $modules = $pdo->prepare($query);

    if ($modules->execute(['primer_registro' => $primer_registro, 'ultimo_registro' => $ultimo_registro])) {
      $datos_informacion = $modules->fetchAll();
      return $datos_informacion;
    } else {
      $error = $modules->errorInfo();
      echo "Error SQLSTATE: " . $error[0] . "<br>";
      echo "Código de error: " . $error[1] . "<br>";
      echo "Mensaje de error: " . $error[2] . "<br>";
    }
  }
}
