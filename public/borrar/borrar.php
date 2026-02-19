<?php

include 'ips.php';

// $texto = "La IP 192.168.1.1 aparece dos veces: 192.168.1.1. Otra IP es 10.0.0.1 y 8.8.8.8.";

// Expresión regular para extraer IPs IPv4 válidas
$regex = '/\b(?:(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\.){3}(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)\b/';

// Extraer todas las IPs coincidentes
preg_match_all($regex, $texto, $coincidencias);

preg_match_all($regex, $texto2, $coincidencias2);

// Obtener el arreglo de IPs extraídas
$ips = $coincidencias[0];
$ips2 = $coincidencias2[0];

$conteo_ips = array_count_values($ips);
$conteo_ips2 = array_count_values($ips2);

arsort($conteo_ips);
arsort($conteo_ips2);
// Imprimir el resultado para verificación

echo "<div style='display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-gap: 10px;
  grid-auto-rows: minmax(100px, auto);'><div>";

foreach ($conteo_ips as $key => $value) {
  echo "$key = $value <br>";
}
echo "</div>";

echo "<div>";
foreach ($conteo_ips2 as $key => $value) {
  echo "$key = $value <br>";
}
echo "</div>";

echo "</div>";
die();


$echo = function ($array, $interval) {
  echo "<div>";
  echo $interval . ' suma ' . array_sum($array) . "<br><br>";
  foreach ($array as $key => $value) {
    echo "$key = $value <br>";
  }
  echo "</div>";
};
$diff = function ($array, $i, $j) use ($echo, $ips_8_9, $ips_9_10, $ips_10_11, $ips_11_12, $ips_12_13, $ips_13_14) {
  $arrays = [];
  for ($i2 = 8, $j2 = 9; $i2 < 14; $i2++, $j2++) {
    if ($i2 != $i && $j2 != $j) {
      $temp = array_count_values(${"ips_{$i2}_{$j2}"});
      arsort($temp);
      $arrays[] = $temp;
    }
  }
  $aux = array_diff_key($array, ...$arrays);
  $echo($aux, "$i a $j Diferencia");
};
echo "<div style='display: flex; justify-content: space-around;'>";
for ($i = 8, $j = 9; $i < 14; $i++, $j++) {
  $hoy_count = array_count_values(${"ips_{$i}_{$j}"});
  arsort($hoy_count);
  $echo($hoy_count, "$i a $j");
}
echo "</div>";
echo "<div style='display: flex; justify-content: space-around;'>";
for ($i = 8, $j = 9; $i < 14; $i++, $j++) {
  $hoy_count = array_count_values(${"ips_{$i}_{$j}"});
  arsort($hoy_count);
  $diff($hoy_count, $i, $j);
}
echo "</div>";
die();
$aux = function ($variable, $temp2) {
  $temp = [];
  foreach ($variable as $key => $value) {
    if (in_array($key, $temp2)) {
      $temp[$key] = $value;
    }
  }
  return $temp;
};


$hoy_count = array_count_values($ips);
$hoy_count2 = array_count_values($ips2);
$hoy_count_diff = array_count_values($hoy_count);
$hoy_count_diff2 = array_count_values($hoy_count2);
arsort($hoy_count);
arsort($hoy_count2);
arsort($hoy_count_diff);
// $filter = $aux($hoy_count, $diff);
// arsort($filter);
$echo = function ($array) {
  foreach ($array as $key => $value) {
    echo "$key = $value <br>";
  }
};
$diff = array_diff_key($hoy_count2, $hoy_count);

echo "<div style='display: flex; justify-content: space-around;'><div>";
$echo($hoy_count);
echo "</div><div>";
$echo($hoy_count2);
echo "</div><div>";
$echo($diff);
echo "</div></div>";

// echo
// join("\n", array_keys($hoy_count));
die;
// arsort($temp5);
//190.149.166.62 ronal peten
//181.189.154.32 ruben
//200.119.178.55 aguilar batres boleto 
//190.148.50.108 zona 1 mitocha encomienda
if (
  !in_array(@$_SERVER['REMOTE_ADDR'], $ips)
) {
  header('HTTP/1.0 403 Forbidden');
  exit('Sistema en pausa... Es necesario detenero de 5 a 10 minutos para nua actualizacion de ultima hora. Muchas gracias,');
}
// ksort($temp4);
return 1;


//189.238.95.102 el naranjo
// 190.148.157.26 tecum
// 190.149.166.53 ronald
//190.149.166.21 melchor
//45.229.40.234 Mayra
// 190.143.186.146 Oli agencia
// 190.56.130.22 guatepeque
// 45.186.105.130 el estor
//24.152.55.20 morales gasolinera
//45.228.233.43 San lorenzo
// '190.143.157.97 Luis de Getaway
//, '179.60.175.107' oficinista de Victorias
//190.149.186.20 Oficina de Mazate
// '186.151.119.106' Oficina Reu
$data = [
  '$surface-1' => 'oklch(98.4% 0.003 247.858);',
  '$surface-2' => 'oklch(96.8% 0.007 247.896);',
  '$surface-3' => 'oklch(92.9% 0.013 255.508);',
  '$surface-4' => 'oklch(86.9% 0.022 252.894);',
  '$surface-5' => 'oklch(70.4% 0.04 256.788);',
  '$surface-6' => 'oklch(55.4% 0.046 257.417);',
  '$surface-7' => 'oklch(44.6% 0.043 257.281);',
  '$surface' => 'oklch(44.6% 0.043 257.281)',
  '$surface-8' => 'oklch(37.2% 0.044 257.287);',
  '$surface-9' => 'oklch(27.9% 0.041 260.031);',
  '$surface-10' => 'oklch(20.8% 0.042 265.755);',
  '$surface-11' => 'oklch(12.9% 0.042 264.695);',
];
