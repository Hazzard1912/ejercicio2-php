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
}
