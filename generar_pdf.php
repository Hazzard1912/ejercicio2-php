<?php
require './vendor/autoload.php';
require './model/informacion.php';
include './fpdf-dev/exfpdf.php';
include './fpdf-dev/easyTable.php';

$informacion = new Informacion();

$primer_registro = $_POST['primer_registro'];
$ultimo_registro = $_POST['ultimo_registro'];

$datos_informacion = $informacion->viewRegistrosPorRango($primer_registro, $ultimo_registro);

$pdf = new exFPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

$table = new easyTable($pdf, '{30, 70, 30, 30, 30, 30}', 'border:1');


// Agrega los encabezados de la tabla
$table->easyCell(iconv("UTF-8", "CP1252", 'Código'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Nombre del archivo'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Número de líneas'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Número de palabras'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Número de caracteres'), 'font-size:12; font-style:B');
$table->easyCell(iconv("UTF-8", "CP1252", 'Fecha de registro'), 'font-size:12; font-style:B');
$table->printRow();

// Recorre los datos de la tabla
foreach ($datos_informacion as $fila) {
  $table->easyCell($fila['codigo']);
  $table->easyCell($fila['nombrearchivo']);
  $table->easyCell($fila['cantlineas']);
  $table->easyCell($fila['cantpalabras']);
  $table->easyCell($fila['cantcaracteres']);
  $table->easyCell($fila['fecharegistro']);
  $table->printRow();
}

$table->endTable();

$pdf->Output();
