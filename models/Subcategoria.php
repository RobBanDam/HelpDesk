<?php
    class Subcategoria extends Conectar{
        public function get_subcategoria($catid){
            $conectar = parent::Conexion();
            parent::set_names();

            $sql = "SELECT * FROM tm_subcategoria WHERE catid = ? AND est = 1;";
            $sql = $conectar->prepare($sql);
            $sql -> bindParam(1, $catid);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>