<?php

$data[] = array(
    "id" => "1",
    "unidad" => "C. ROJA SN-75-866",
    "kilometraje" => "28933",
    "combustible" => "79"    
);

$data[] = array(
    "id" => "2",
    "unidad" => "HIDALGUIN",
    "kilometraje" => "21563",
    "combustible" => "60"    
);

$data[] = array(
    "id" => "3",
    "unidad" => "MOTO ADAN",
    "kilometraje" => "38632",
    "combustible" => "73"    
);

$result = array(
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data
);

echo json_encode($result['aaData']);

?>