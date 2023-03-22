<?php


use LDAP\Result;

session_start();
require "Request.php";

//include_once '../views/Gasolina.php';
$request = new Request();


switch($_REQUEST["opcion"]) {
  
    case "unitList":
        
        $data = $request->unitList();

        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $list[] = array(
                    "id" => $data[$i]['id_unidad'],
                    "unidad" => $data[$i]['nombre'],
                    "seleccionar" => printButton($data[$i]['id_unidad']),
                    "descargar" => ButtonPdf($data[$i]['id_unidad'], $data[$i]['nombre'])
                );
            }

            $result = array(
                "sEcho" => 1,   
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
            echo json_encode($result);
        } else {
            $list[] = array(
                "id" => 'No hay unidades disponibles',
                "unidad" => ' ',
                "seleccionar" => " ",
                "descargar" => " ",
            );

            $result = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
            echo json_encode($result);
        }
        
        break;

    case "getLitersDatesBetween":
        if (!empty($request->getLitersDatesBetween($_POST['id'], $_POST['startDate'], $_POST['endDate']))) {
            echo json_encode($request->getLitersDatesBetween($_POST['id'], $_POST['startDate'], $_POST['endDate']));
        } else {
            echo json_encode('error');
        }
        break;

    case "getLitersOneDate":
        if (!empty($request->getLitersOneDate($_POST['id'], $_POST['date']))) {
            echo json_encode($request->getLitersOneDate($_POST['id'], $_POST['date']));
        } else {
            echo json_encode('error');
        }
        break;

    case "getKmDatesBetween":
        if (!empty($request->getKmDatesBetween($_POST['id'], $_POST['startDate'], $_POST['endDate']))) {
            echo json_encode($request->getKmDatesBetween($_POST['id'], $_POST['startDate'], $_POST['endDate']));
        } else {
            echo json_encode('error');
        }
        break;

    case "getKmOneDate":
        if (!empty($request->getKmOneDate($_POST['id'], $_POST['date']))) {
            echo json_encode($request->getKmOneDate($_POST['id'], $_POST['date']));
        } else {
            echo json_encode('error');
        }
        break;

    case "gasFillList":
        
        switch($_POST['option']){
            case 'one':
                $datos = $request->gasFillList($_POST['idUnit'],$_POST['date']);
                break;
            case 'two':
                $datos = $request->gasFillList2($_POST['idUnit'],$_POST['dateStart'],$_POST['dateEnd']);
                break;
        }        

        if (!empty($datos)) {
            for ($i = 0; $i < count($datos); $i++) {
                $list[] = array(
                    "no" => $i + 1,
                    "fecha" => $datos[$i]['fecha'],
                    "combustible" => $datos[$i]['combustible'],
                    "litros" => $datos[$i]['litros'],
                    "costo" => $datos[$i]['costo'],
                    "clitros" => $datos[$i]['costol']
                );
            }

            $result = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
            echo json_encode($result);
        } else {
            $list[] = array(
                "no" => "No hay registros disponibles",
                "fecha" => " ",
                "combustible" => " ",
                "litros" => " ",
                "costo" => " ",
                "clitros" => " "
            );

            $result = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
            echo json_encode($result);
        }
        break;

    case 'getRangeDates':
        echo json_encode($request->getRangeDates($_POST['idUnit'],$_POST['dateStart'],$_POST['dateEnd']));
        break;
    
    case 'getGasCostDay':
        echo json_encode($request->gasFillList($_POST['idUnit'],$_POST['date']));
        break;
    case 'getRecargaComb1':
        if (!empty($request->getRecargaComb1($_POST['id'], $_POST['date']))) {
            echo json_encode($request->getRecargaComb1($_POST['id'], $_POST['date']));
        } else {
            echo json_encode('error');
        }
        break;  
}

function printButton($id)
{
    $idC = '"' . $id . '"';
    return "<button type='button' class='btn btn-primary' id='chkUnit" . $id . "' onclick='graphUnit(" . $idC . ")'>Graficar</button>";   
}

function ButtonPdf($id){
    $idP = '"' . $id . '"';
    return "<button  type='button' class='btn btn-primary' id='chkUnit" . $id . "' onclick='Prueba(".$idP.")'> Descargar PDF</button></a>";
}


