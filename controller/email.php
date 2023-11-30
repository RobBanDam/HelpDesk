<?php
    require_once("../config/conexion.php");
    require_once("../models/Email.php");
    $email = new Email();

    switch ($_GET["op"]) {
        case "ticket_abierto":
            $email -> ticket_abierto($_POST["tickid"]);
        break;
        case "ticket_cerrado":
            $email -> ticket_cerrado($_POST["tickid"]);
        break;
        case "ticket_asginado":
            $email -> ticket_asignado($_POST["tickid"]);
        break;
    }
?>