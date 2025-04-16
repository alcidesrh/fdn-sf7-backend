<?php

include 'ips.php';
// include '11_02_14_1534_pm.php';
// include '06_02_09_11.php';



// $ip_11_02_14_1534_pm_count = array_count_values($ip_11_02_14_1534_pm);
// $ip_11_02_14_1534_pm__key = array_keys($ip_11_02_14_1534_pm_count);
// $diff = array_diff($ip_11_02_14_1534_pm__key, $fdn_ips);

// $ip_06_02_09_11_count = array_count_values($ip_06_02_09_11);
// $ip_06_02_09_11__key = array_keys($ip_06_02_09_11_count);

// $diff2 = array_diff($ip_06_02_09_11__key, $fdn_ips);

// arsort($ip_11_02_14_1534_pm_count);
// arsort($ip_06_02_09_11_count);
$aux = function ($variable, $temp2) {
  $temp = [];
  foreach ($variable as $key => $value) {
    if (in_array($key, $temp2)) {
      $temp[$key] = $value;
    }
  }
  return $temp;
};
// $result1 = $aux($ip_11_02_14_1534_pm_count, $diff);
// $result2 = $aux($ip_06_02_09_11_count, $diff2);
// $result3 = $aux($ip_06_02_09_11_count, $diff2);
// $diff = [...array_diff($ip_11_02_14_1534_pm__key, $ip_06_02_09_11__key), ...array_diff($ip_06_02_09_11__key, $ip_11_02_14_1534_pm__key)];

// arsort($result1);
// arsort($result2);
// $result2 = $aux($temp11, $temp5);
// $result3 = $aux($temp2, $temp5);
// $result4 = $aux($temp12, $temp5);
// foreach()"45.164.149.36"
// $diff = array_diff(['181.174.89.205', '186.151.119.74', '186.151.119.25', '45.229.40.28', '190.56.130.8', '190.148.252.204', '190.149.166.58', '181.174.72.72', '181.174.74.174', '190.56.50.43', '190.106.197.177', '138.84.59.102', '190.149.4.221', '45.229.41.92', '190.149.186.202', '31.13.224.222', '190.148.157.68', '181.174.66.189', '181.174.67.236', '190.106.196.61', '190.61.91.89', '172.104.11.4', '190.56.54.48', '190.56.48.158', '190.56.54.14', '190.56.54.142', '190.56.50.222', '190.106.200.4', '181.174.89.160 ']);
// echo join(" | ", array_keys($result1));
$diff = array_diff($hoy, $user);
$hoy_count = array_count_values($hoy);
$hoy_count_diff = array_count_values($diff);
arsort($hoy_count);
arsort($hoy_count_diff);
$filter = $aux($hoy_count, $diff);
arsort($filter);
echo join("', '", array_keys($hoy_count));
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
