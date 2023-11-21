<?php
    class Ticket extends Conectar{
        public function insert_ticket($usuid, $catid, $ticktitulo, $tickdesc){
            $conectar = parent::Conexion();
            parent::set_names();

            $sql = "INSERT INTO tm_ticket (tickid, usuid, catid, ticktitulo, tickdesc, tichest fechcrea, est) VALUES (NULL, ?, ?, ?, ?, 'Abierto', now(), '1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usuid);
            $sql->bindValue(2, $catid);
            $sql->bindValue(3, $ticktitulo);
            $sql->bindValue(4, $tickdesc);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function listar_ticket_x_usu($usuid){
            $conectar = parent::Conexion();
            parent::set_names();

            $sql = "SELECT
                tm_ticket.tickid,
                tm_ticket.usuid,
                tm_ticket.catid,
                tm_ticket.ticktitulo,
                tm_ticket.tickdesc,
                tm_ticket.tickest,
                tm_ticket.fechcrea,
                tm_usuario.usunom,
                tm_usuario.usuape,
                tm_categoria.catnom
            FROM
                tm_ticket
            INNER JOIN tm_categoria ON tm_ticket.catid = tm_categoria.catid
            INNER JOIN tm_usuario ON tm_ticket.usuid = tm_usuario.usuid
            WHERE
                tm_ticket.est = 1
            AND 
                tm_usuario.usuid = ?";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $usuid);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function listar_ticket(){
            $conectar = parent::Conexion();
            parent::set_names();

            $sql = "SELECT
                tm_ticket.tickid,
                tm_ticket.usuid,
                tm_ticket.catid,
                tm_ticket.ticktitulo,
                tm_ticket.tickdesc,
                tm_ticket.tickest,
                tm_ticket.fechcrea,
                tm_usuario.usunom,
                tm_usuario.usuape,
                tm_categoria.catnom
            FROM
                tm_ticket
            INNER JOIN tm_categoria ON tm_ticket.catid = tm_categoria.catid
            INNER JOIN tm_usuario ON tm_ticket.usuid = tm_usuario.usuid
            WHERE
                tm_ticket.est = 1";

            $sql = $conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function listar_ticketdetalle_x_ticket($tickid){
            $conectar = parent::Conexion();
            parent::set_names();

            $sql = "SELECT 
                    td_ticketdetalle.tickid_id, 
                    td_ticketdetalle.tickid_desc, 
                    td_ticketdetalle.fechcrea, 
                    tm_usuario.usunom, 
                    tm_usuario.usuape, 
                    tm_usuario.rolid
                FROM
                    td_ticketdetalle 
                INNER JOIN 
                    tm_usuario 
                ON 
                    td_ticketdetalle.usuid = tm_usuario.usuid 
                WHERE 
                    tickid = ?;";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $tickid);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }
    }
?>