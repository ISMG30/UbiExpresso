<?php
session_start();


switch($_REQUEST["opcion"]){
    case "unitList":

        $data[] = array(
            "id" => "1",
            "unidad" => "hidalguin",
            "seleccionar" => printCheck("1")
        );
        $data[] = array(
            "id" => "2",
            "unidad" => "TORTON",
            "seleccionar" => printCheck("2")
        );
        $data[] = array(
            "id" => "3",
            "unidad" => "ADAN MOTO",
            "seleccionar" => printCheck("3")
        );
        $data[] = array(
            "id" => "4",
            "unidad" => "TRAILER ABARROTERA",
            "seleccionar" => printCheck("4")
        );
        $data[] = array(
            "id" => "5",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("5")
        );
        $data[] = array(
            "id" => "6",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("6")
        );
        $data[] = array(
            "id" => "7",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("7")
        );
        $data[] = array(
            "id" => "8",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("8")
        );
        $data[] = array(
            "id" => "9",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("9")
        );
        $data[] = array(
            "id" => "10",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("10")
        );
        $data[] = array(
            "id" => "11",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("11")
        );
        $data[] = array(
            "id" => "12",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("12")
        );
        $data[] = array(
            "id" => "13",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("13")
        );
        $data[] = array(
            "id" => "14",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("14")
        );
        $data[] = array(
            "id" => "15",
            "unidad" => "COLECTIVA SUBURBAN",
            "seleccionar" => printCheck("15")
        );

        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($result);

        break;    
}


function printCheck($id){
    $idC = '"'.$id.'"';
    return "<input class='form-check-input' type='checkbox' value='' id='chkUnit".$id."' onclick='changeChk(".$idC.")'>";
}
?>