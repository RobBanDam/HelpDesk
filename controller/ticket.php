<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();

    switch ($_GET["op"]) {
        case "insert":
            // Aplica htmlspecialchars al campo tickdesc
            /* $tickdesc = htmlspecialchars($_POST["tickdesc"]); */
            
            // Llama a la función insert_ticket con el campo tickdesc modificado
            $ticket->insert_ticket($_POST["usuid"], $_POST["catid"], $_POST["ticktitulo"], $_POST["tickdesc"]);
        break;

        case "update":
            // Aplica htmlspecialchars al campo tickdesc
            /* $tickdesc = htmlspecialchars($_POST["tickdesc"]); */
            
            // Llama a la función insert_ticket con el campo tickdesc modificado
            $ticket->update_ticket($_POST["tickid"]);
            $ticket->insert_ticketdetalle_cerrar($_POST["tickid"], $_POST["usuid"]);

        break;

        case "listar_x_usu":
            $datos = $ticket->listar_ticket_x_usu($_POST["usuid"]);
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["tickid"];
                $sub_array[] = $row["catnom"];
                $sub_array[] = $row["ticktitulo"];

                if ($row["tickest"] == "Abierto") {
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                } else {
                    $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
                }

                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fechcrea"]));

                // Aplica html_entity_decode al campo tickdesc
                /* $sub_array[] = html_entity_decode($row["tickdesc"]); */

                $sub_array[] = '<button type="button" onClick="ver(' . $row["tickid"] . ');" id="' . $row["tickid"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
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

        case "listar":
            $datos = $ticket->listar_ticket();
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["tickid"];
                $sub_array[] = $row["catnom"];
                $sub_array[] = $row["ticktitulo"];

                if ($row["tickest"] == "Abierto") {
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                } else {
                    $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
                }

                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fechcrea"]));

                // Aplica html_entity_decode al campo tickdesc
                /* $sub_array[] = html_entity_decode($row["tickdesc"]); */

                $sub_array[] = '<button type="button" onClick="ver(' . $row["tickid"] . ');" id="' . $row["tickid"] . '" class="btn btn-inline btn-primary btn-sm ladda-button"><div><i class="fa fa-eye"></i></div></button>';
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

        case "listardetalle":
            $datos = $ticket->listar_ticketdetalle_x_ticket($_POST["tickid"]);
            ?>
                <?php
                    foreach ($datos as $row) {
                        ?>
                            <article class="activity-line-item box-typical">
                                <div class="activity-line-date">
                                    <?php echo date("d/m/Y", strtotime($row["fechcrea"]));?>
                                </div>
                                <header class="activity-line-item-header">
                                    <div class="activity-line-item-user">
                                        <div class="activity-line-item-user-photo">
                                            <a href="#">
                                                <img src="../../public/<?php echo $row["rolid"]?>.jpg" alt="avatar de usuario">
                                            </a>
                                        </div>
                                        <div class="activity-line-item-user-name"> <?php echo $row['usunom']. ' '.$row['usuape']; ?> </div>
                                        <div class="activity-line-item-user-status">
                                            <?php 
                                                if($row['rolid'] == 1 ){
                                                    echo "Usuario";
                                                }else{
                                                    echo "Soporte";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </header>
                                <div class="activity-line-action-list">
                                    <section class="activity-line-action">
                                        <div class="time"><?php echo date("H:i:s", strtotime($row["fechcrea"]));?></div>
                                        <div class="cont">
                                            <div class="cont-in">
                                                <p>
                                                    <?php echo $row["tickid_desc"];?>
                                                </p>
                                            </div>
                                        </div>
                                    </section><!--.activity-line-action-->
                                </div><!--.activity-line-action-list-->
                            </article><!--.activity-line-item-->
                        <?php
                    }
                ?>
            <?php
        break;

        case "mostrar":
            $datos=$ticket->listar_ticket_x_id($_POST["tickid"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["tickid"] = $row["tickid"];
                    $output["usuid"] = $row["usuid"];
                    $output["catid"] = $row["catid"];
                    $output["ticktitulo"] = $row["ticktitulo"];
                    $output["tickdesc"] = $row["tickdesc"];

                    if($row["tickest"] == "Abierto"){
                        $output["tickest"] = '<span class="label label-pill label-success">Abierto</span>';
                    }else{
                        $output["tickest"] = '<span class="label label-pill label-danger">Cerrado</span>';
                    }

                    $output["tickest_txt"] = $row["tickest"];

                    $output["fechcrea"] = date("d/m/Y H:i:s", strtotime($row["fechcrea"]));
                    $output["usunom"] = $row["usunom"];
                    $output["usuape"] = $row["usuape"];
                    $output["catnom"] = $row["catnom"];
                }
                echo json_encode($output);
            }
        break;

        case "insertdetalle":
            // Aplica htmlspecialchars al campo tickdesc
            /* $tickdesc = htmlspecialchars($_POST["tickdesc"]); */

            // Llama a la función insert_ticketdetalle con el campo tickdesc modificado
            $ticket->insert_ticketdetalle($_POST["tickid"], $_POST["usuid"], $_POST["tickid_desc"]);

        break;

        case "total":
            $datos=$ticket->get_ticket_total();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "totalabierto":
            $datos=$ticket->get_ticket_totalAbierto();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "totalcerrado":
            $datos=$ticket->get_ticket_totalCerrado();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "grafico":
            $datos = $ticket -> get_ticket_grafico();
            echo json_encode($datos);
        break;
    }
?>