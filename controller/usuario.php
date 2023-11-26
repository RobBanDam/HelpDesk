<?php 
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    $usuario = new Usuario();

    switch($_GET["op"]){
        case "guardaryeditar":
            if(empty($_POST["usuid"])){
                    $usuario -> insert_usuario($_POST["usunom"], $_POST["usuape"], $_POST["usucorreo"], $_POST["usupass"], $_POST["rolid"]);
            }else{
                $usuario -> update_usuario($_POST["usuid"], $_POST["usunom"], $_POST["usuape"], $_POST["usucorreo"], $_POST["usupass"], $_POST["rolid"]);
            }
        break;

        case "listar":
            $datos = $usuario->get_usuario();
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["usunom"];
                $sub_array[] = $row["usuape"];
                $sub_array[] = $row["usucorreo"];
                $sub_array[] = $row["usupass"];

                if ($row["rolid"] == "1") {
                    $sub_array[] = '<span class="label label-pill label-success">Usuario</span>';
                } else {
                    $sub_array[] = '<span class="label label-pill label-info">Soporte</span>';
                }

                $sub_array[] = '<button type="button" onClick="editar(' . $row["usuid"] . ');" id="' . $row["usuid"] . '" class="btn btn-inline btn-warning btn-sm ladda-button"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar(' . $row["usuid"] . ');" id="' . $row["usuid"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><div><i class="fa fa-trash"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            echo json_encode($results);
        break;

        case "eliminar":
            $usuario -> delete_usuario($_POST["usuid"]);
        break;

        case "mostrar":
            $datos=$usuario->get_usuario_id($_POST["usuid"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["usuid"] = $row["usuid"];
                    $output["usunom"] = $row["usunom"];
                    $output["usuape"] = $row["usuape"];
                    $output["usucorreo"] = $row["usucorreo"];
                    $output["usupass"] = $row["usupass"];
                    $output["rolid"] = $row["rolid"];
                }
                echo json_encode($output);
            }
        break;

        case "total":
            $datos=$usuario->get_usuario_total_id($_POST["usuid"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "totalabierto":
            $datos=$usuario->get_usuario_totalAbierto_id($_POST["usuid"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "totalcerrado":
            $datos=$usuario->get_usuario_totalCerrado_id($_POST["usuid"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "grafico":
            $datos = $usuario -> get_usuario_grafico($_POST["usuid"]);
            echo json_encode($datos);
        break;
    }
?>