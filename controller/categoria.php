<?php 
    require_once("../config/conexion.php");
    require_once("../models/Categoria.php");
    $categoria = new Categoria();

    switch($_GET["op"]){
        case "combo":
            $datos = $categoria->get_categoria();
            $html = "";
            if(is_array($datos) === true and count($datos) > 0){
                foreach($datos as $row){
                    $html .= "<option label='Seleccionar'></option>";
                    $html .= "<option value='".$row['catid']."'>".$row['catnom']."</option>";
                }
                echo $html;
            }
        break;
    }
?>