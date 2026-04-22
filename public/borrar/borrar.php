<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght,XOPQ,XTRA,YOPQ,YTDE,YTFI,YTLC,YTUC@8..144,100..1000,96,468,79,-203,738,514,712&display=swap" rel="stylesheet">
<style>
  * {
    letter-spacing: 1px;
    color: #47566C;
    font-family: "Roboto Flex", sans-serif;
    font-optical-sizing: auto;
    font-weight: 400;
    font-style: normal;
    font-variation-settings:
      "slnt" 0,
      "wdth" 100,
      "GRAD" 0,
      "XOPQ" 96,
      "XTRA" 468,
      "YOPQ" 79,
      "YTAS" 750,
      "YTDE" -203,
      "YTFI" 738,
      "YTLC" 514,
      "YTUC" 712;
  }

  b {
    letter-spacing: 1px;
    font-weight: 500;
    color: #1D293D;
  }

  .divider {
    color: #CBD5E1
  }

  span {
    font-size: 14px;
    font-weight: 500;
    color: #1D293D;
  }
</style>
<?php
$v = [
  17764060.00,
  31738966.00,
  35463101.43,
  36554780.76,
  30607823.61
];
$t = [
  79180,
  143209,
  158565,
  165357,
  144481
];
$v = [
  77592,
  139126,
  155109,
  162344,
  140598
];
$i = [
  1416,
  3673,
  3168,
  2737,
  3278
];
$a = [
  372,
  1388,
  1359,
  756,
  634
];
$r = [
  1044,
  2285,
  1809,
  1981,
  2644
];
for ($index = 2021; $i < 2026; $index++) {
  echo "Año: $index <br>";
  echo "Venta: " . number_format($v[$index - 2021], 2, ',', ' ') . "<br>";
  echo "Totales: " . number_format($t[$index - 2021], 0, ',', ' ') . "<br>";
  echo "Validos: " . number_format($v[$index - 2021], 0, ',', ' ') . "<br>";
  echo "Invalidos: " . number_format($i[$index - 2021], 0, ',', ' ') . "<br>";
  echo "Anulados: " . number_format($a[$index - 2021], 0, ',', ' ') . "<br>";
  echo "Reasignados: " . number_format($r[$index - 2021], 0, ',', ' ') . "<br><br><br>";
}
// Array corregido con todos los valores como números enteros (int)
// Se ha limpiado el error de formato en 2025['anulados'][0] (el "1\t" era un artefacto de copia)
$data1 = [
  2023 => [
    'totales' => 158565,
    'validos' => 155109,
    'invalidos' => 6640,
    'anulados' => 1359,
    'reasignados' => 1809,
    'venta' => 35463101.43,
  ],
  2024 => [
    'totales' => 165357,
    'validos' => 162344,
    'invalidos' => 9305,
    'anulados' => 756,
    'reasignados' => 1981,
    'venta' => 36554780.76,
  ],
  2025 => [
    'totales' => 144481,
    'validos' => 140598,
    'invalidos' => 12263,
    'anulados' => 634,
    'reasignados' => 2644,
    'venta' => 30607823,
  ],
  // 2026 => [
  //   'anulados' => [
  //     12980207,
  //     9400308,
  //     12292663,
  //     826796
  //   ],
  //   'Reasignado' => [
  //     259112,
  //     191017,
  //     182849,
  //     9612
  //   ],
  //   'venta' => [
  //     12980207,
  //     9400308,
  //     12292663,
  //     826796
  //   ],
  // ]
];
$data_mayaoro = [
  2023 => [
    'totales' => 634993,
    'validos' => 625517,
    'invalidos' => 9222,
    'anulados' => 1984,
    'reasignados' => 6632,
    'venta' => 98280524,
  ],
  2024 => [
    'totales' => 716769,
    'validos' => 702733,
    'invalidos' => 13155,
    'anulados' => 1120,
    'reasignados' => 10592,
    'venta' => 124309951,
  ],
  2025 => [
    'totales' => 675473,
    'validos' => 660497,
    'invalidos' => 14403,
    'anulados' => 591,
    'reasignados' => 12213,
    'venta' => 102217961,
  ],
  // 2026 => [
  //   'anulados' => [
  //     12980207,
  //     9400308,
  //     12292663,
  //     826796
  //   ],
  //   'Reasignado' => [
  //     259112,
  //     191017,
  //     182849,
  //     9612
  //   ],
  //   'venta' => [
  //     12980207,
  //     9400308,
  //     12292663,
  //     826796
  //   ],
  // ]
];
$data = [
  2023 => [
    'totales' => [
      66906,
      52872,
      59070,
      67882,
      54068,
      53640,
      66870,
      71101,
      76091,
      53830,
      79163,
      93198
    ],
    'validos' => [
      65562,
      52074,
      58232,
      66693,
      53181,
      52653,
      65793,
      69967,
      74775,
      52860,
      77765,
      91482
    ],
    'invalidos' => [
      1338,
      789,
      821,
      1160,
      876,
      948,
      1072,
      1129,
      1244,
      916,
      1376,
      1619
    ],
    'anulados' => [
      339,
      240,
      242,
      397,
      263,
      265,
      330,
      227,
      269,
      186,
      344,
      353
    ],
    'reasignados' => [
      957,
      510,
      547,
      715,
      577,
      636,
      664,
      850,
      857,
      647,
      909,
      1173
    ],
    'venta' => [
      11232772,
      8858999,
      9923334,
      11311301,
      8940573,
      8788956,
      10978439,
      11410092,
      12736099,
      9535212,
      13393311,
      16712169
    ],
  ],
  2024 => [
    'totales' => [
      88041,
      68371,
      84043,
      69439,
      70955,
      65855,
      67568,
      65896,
      62958,
      69079,
      75087,
      96232
    ],
    'validos' => [
      86477,
      67093,
      82421,
      68308,
      70038,
      64622,
      66184,
      64476,
      61060,
      67132,
      73515,
      94215
    ],
    'invalidos' => [
      1527,
      1180,
      1552,
      1114,
      889,
      1212,
      1283,
      1404,
      1748,
      1674,
      1505,
      1950
    ],
    'anulados' => [
      331,
      327,
      370,
      260,
      29,
      74,
      66,
      72,
      39,
      75,
      154,
      122
    ],
    'reasignados' => [
      1060,
      736,
      1075,
      756,
      752,
      1041,
      1104,
      1178,
      1530,
      1415,
      1142,
      1665
    ],
    'venta' => [
      16949981,
      12994574,
      15185637,
      13142417,
      13286433,
      12137350,
      12418265,
      11871126,
      11178946,
      12242481,
      13251242,
      16243299
    ],
  ],
  2025 => [
    'totales' => [
      79821,
      59295,
      59104,
      76546,
      60460,
      64823,
      63891,
      64643,
      59237,
      62928,
      73548,
      95658
    ],
    'validos' => [
      77899,
      57880,
      57669,
      74761,
      59425,
      63322,
      62446,
      63284,
      57830,
      61569,
      71857,
      93153
    ],
    'invalidos' => [
      1902,
      1184,
      1309,
      1775,
      1022,
      1376,
      1429,
      1341,
      1388,
      1295,
      1662,
      2324
    ],
    'anulados' => [
      111,
      162,
      111,
      108,
      61,
      70,
      94,
      61,
      47,
      81,
      170,
      149
    ],
    'reasignados' => [
      1419,
      776,
      1064,
      1544,
      901,
      1177,
      1239,
      1140,
      1218,
      1065,
      1401,
      1913
    ],
    'venta' => [
      13240928,
      9617073,
      9511365,
      12247517,
      9852753,
      10359579,
      10363964,
      10452679,
      9395654,
      10129495,
      12052808,
      15601964
    ],
  ],
  // 2026 => [
  //   'anulados' => [
  //     12980207,
  //     9400308,
  //     12292663,
  //     826796
  //   ],
  //   'Reasignado' => [
  //     259112,
  //     191017,
  //     182849,
  //     9612
  //   ],
  //   'venta' => [
  //     12980207,
  //     9400308,
  //     12292663,
  //     826796
  //   ],
  // ]
];

// Pre-cálculo de las sumas por año y por clave (para mayor eficiencia)
$sums = [];
foreach ($data as $year => $categories) {
  $sums[$year] = [];
  foreach ($categories as $key => $values) {
    $sums[$year][is_array($key) ? $key[0] : $key] = is_array($values) ? array_sum($values) : $values; //array_sum($values);
  }
}

// Obtener los años ordenados cronológicamente
$years = array_keys($data);
sort($years);

$categories = [['venta', '- Venta en (Q)'], ['totales', '- Total de boletos vendidos'], ['validos', '- Validos: No incluye anulados ni reasignados'], ['invalidos', '- Invalidos: la suma de los anulados y reasignados'], ['reasignados', '- Reasignados'], ['anulados', '- Anulados']];


echo "<br/>";
echo "<br/>";
echo "<div style='margin: auto;  width: fit-content;' >=== Comparación delos totales de venta, reasignados y anulados de los años 2023, 2024 y 2025  ===</div><br/>";
echo "<div style='margin: 20px; margin-top: 0px;'> *Nota: <span style='font-size: 14px;'> \"validos\" incluye todos los facturados en la Sat. No incluye a los \"invalidos\" que son la suma de anulados y reasignados.</span></div>";
echo "<br/>";

echo "<div style='margin: auto; width:fit-content;'>";
foreach ($years as $i => $year1) {
  for ($j = $i + 1; $j < count($years); $j++) {
    $year2 = $years[$j];

    echo "<div style='float: left; width: 450px; 
    border-left: 1px solid;
    border-right: 1px solid;
    padding: 20px; margin: 5px; font-size:18px'><b>Comparación entre {$year1} y {$year2}</b>";
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";

    // echo str_repeat("-", 50) . "<br/>";

    foreach ($categories as $key) {
      $text = null;
      if (is_array($key)) {
        $text = $key[1];
        $key = $key[0]; // Mostrar la descripción en lugar de la clave original
      }
      $abs = number_format(abs($sums[$year2][$key] - $sums[$year1][$key]), 0, ',', ' ');
      if ($sums[$year2][$key] > $sums[$year1][$key]) {
        // $diff = "$year2+ <b>$abs</b> $key";
        $diff = "Diferencia = <b>$abs</b> <span>( $year2 > $year1 )</span>";
      } else {
        $diff = "Diferencia = <b>$abs</b> <span>( $year1 > $year2 )</span>";
      }
      // $diff = $sums[$year2][$key] - $sums[$year1][$key];

      if ($text) {
        echo " <div style='margin-bottom: 1px; '> <b>{$text}</b> </div><br/>";
      } else {
        echo " <div style='margin-bottom: 1px;'> <b>{$key}</b> </div><br/>";
      }
      echo "  <div style='margin-bottom: 1px;'>  {$year1} = " . number_format($sums[$year1][$key], 0, ',', ' ') . "</div><br/>";
      echo " <div style='margin-bottom: 1px;'>   {$year2} = " . number_format($sums[$year2][$key], 0, ',', ' ') . "</div><br/>";
      // echo " <div style='margin-bottom: 1px;'>   Diferencia: {$year2} - {$year1} = <b style='letter-spacing: 1px;'> " . number_format($diff, 0, ',', ' ') . "</b></div><br/><br/>";
      echo "<div style='margin-bottom: 1px;'> $diff </b></div><br/><br/>";
      echo "<div class='divider'>" . str_repeat(" -  -", 18) . "</div><br/>";
    }

    echo str_repeat("=", 60) . "<br/><br/></div>";
  }
}
echo "</div>";

die();

include 'ips.php';

$data = [
  '2023' => [
    'anulados' => [
      '11232772',
      '8858999',
      '9923334',
      '11311301',
      '8940573',
      '8788956',
      '10978439',
      '11410092',
      '12736099',
      '9535212',
      '13393311',
      '16712169'
    ],
    'Reasignado' => [
      151810,
      86175,
      96290,
      116797,
      97627,
      100165,
      110720,
      141664,
      139016,
      99037,
      130602,
      178724,
    ],
    'venta' => [
      11232772,
      8858999,
      9923334,
      11311301,
      8940573,
      8788956,
      10978439,
      11410092,
      12736099,
      9535212,
      13393311,
      16712169,
    ],
  ],
  '2024' => [
    'anulados' => [
      '16949981',
      '12994574',
      '15185637',
      '13142417',
      '13286433',
      '12137350',
      '12418265',
      '11871126',
      '11178946',
      '12242481',
      '13251242',
      '16243299',
    ],
    'Reasignado' => [
      137320,
      101587,
      172497,
      115747,
      115375,
      138337,
      156869,
      163279,
      201084,
      194929,
      169974,
      264581,
    ],
    'venta' => [
      16949981,
      12994574,
      15185637,
      13142417,
      13286433,
      12137350,
      12418265,
      11871126,
      11178946,
      12242481,
      13251242,
      16243299,
    ],
  ],
  '2025' => [
    'anulados' => [
      '1 13240928',
      '9617073',
      '9511365',
      '12247517',
      '9852753',
      '10359579',
      '10363964',
      '10452679',
      '9395654',
      '10129495',
      '12052808',
      '15601964'
    ],
    'Reasignado' => [
      206975,
      116607,
      155100,
      228717,
      122199,
      157015,
      179172,
      168998,
      174245,
      159847,
      213341,
      300893,
    ],
    'venta' => [
      13240928,
      9617073,
      9511365,
      12247517,
      9852753,
      10359579,
      10363964,
      10452679,
      9395654,
      10129495,
      12052808,
      15601964,
    ],
  ],
  '2026' => [
    'anulados' => [
      '12980207',
      '9400308',
      '12292663',
      '826796',
    ],
    'Reasignado' => [
      259112,
      191017,
      182849,
      9612,
    ],
    'venta' => [
      12980207,
      9400308,
      12292663,
      826796,
    ],
  ]
];



// $texto="La IP 192.168.1.1 aparece dos veces: 192.168.1.1. Otra IP es 10.0.0.1 y 8.8.8.8." ;

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

echo "<div style='display: flex; justify-content: space-around;'>
      <div>";
$echo($hoy_count);
echo "</div>
      <div>";
$echo($hoy_count2);
echo "</div>
      <div>";
$echo($diff);
echo "</div>
    </div>";

// echo
// join("<br />", array_keys($hoy_count));
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
