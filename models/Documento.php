<?php
    class Documento extends Conectar{
        public function insert_documento($tickid, $doc_nom){
            $conectar= parent::conexion();
            /* consulta sql */
            $sql="INSERT INTO td_documento (doc_id,tickid,doc_nom,fech_crea,est) VALUES (null,?,?,now(),1);";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$tickid);
            $sql->bindParam(2,$doc_nom);
            $sql->execute();
        }

        public function get_documento_ticket($tickid){
            $conectar= parent::conexion();
            /* consulta sql */
            $sql="SELECT * FROM td_documento WHERE tickid=?";
            $sql = $conectar->prepare($sql);
            $sql->bindParam(1,$tickid);
            $sql->execute();
            return $resultado = $sql->fetchAll(pdo::FETCH_ASSOC);
        }
    }
?>