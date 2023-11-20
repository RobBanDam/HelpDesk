<?php 
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();

    switch($_GET["op"]){
        case "insert":
            // Aplica htmlspecialchars al campo tickdesc
            $tickdesc = htmlspecialchars($_POST["tickdesc"]);

            // Llama a la función insert_ticket con el campo tickdesc modificado
            $ticket->insert_ticket($_POST["usuid"], $_POST["catid"], $_POST["ticktitulo"], $tickdesc);
            
        break;

        case "listar_x_usu":
            $datos = $ticket->listar_ticket_x_usu($_POST["usuid"]);
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tickid"];
                $sub_array[] = $row["catnom"];
                $sub_array[] = $row["ticktitulo"];
                $sub_array[] = '<button type="button" onClick="ver('.$row["tickid"].');" id="'.$row["tickid"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
    }
?>