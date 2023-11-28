<?php
    class Documento extends Conectar{
        public function insert_documento($tickid, $doc_nom){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO td_documento (doc_id, tickid, doc_nom, fech_crea, est) VALUES (NULL, ?, ?, now(), 1);";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $tickid);
            $sql->bindValue(2, $doc_nom);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_documento_ticket($tickid){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM td_documento WHERE tickid = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1, $tickid);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }

?>