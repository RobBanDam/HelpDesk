<?php
    class Ticket extends Conectar{
        public function insert_ticket($usuid, $catid, $ticktitulo, $tickdesc){
            $conectar = parent::Conexion();
            parent::set_names();

            $sql = "INSERT INTO tm_ticket (tickid, usuid, catid, ticktitulo, tickdesc, tickest, fechcrea, est) VALUES (NULL, ?, ?, ?, ?, 'Abierto', now(), '1');";
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

        public function listar_ticket_x_id($tickid){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
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
                INNER join tm_categoria on tm_ticket.catid = tm_categoria.catid
                INNER join tm_usuario on tm_ticket.usuid = tm_usuario.usuid
                WHERE
                tm_ticket.est = 1
                AND tm_ticket.tickid = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tickid);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle($tickid, $usuid, $tickid_desc){
            $conectar = parent::Conexion();
            parent::set_names();

            $sql = "INSERT INTO td_ticketdetalle (tickid_id, tickid, usuid, tickid_desc, fechcrea, est) VALUES (NULL, ?, ?, ?, now(), '1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $tickid);
            $sql->bindValue(2, $usuid);
            $sql->bindValue(3, $tickid_desc);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function insert_ticketdetalle_cerrar($tickid, $usuid){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "INSERT INTO td_ticketdetalle (tickid_id, tickid, usuid, tickid_desc, fechcrea, est) VALUES (NULL, ?, ?, 'Ticket Cerrado...', now(), '1');";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $tickid);
            $sql->bindValue(2, $usuid);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function update_ticket($tickid){
            $conectar = parent::Conexion();
            parent::set_names();
            $sql = "UPDATE 
                tm_ticket
            SET
                tickest = 'Cerrado'
            WHERE
                tickid = ?;";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $tickid);
            $sql->execute();
            return $resultado = $sql->fetchAll();
        }

        public function get_ticket_total(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT COUNT(*) as TOTAL FROM tm_ticket";
            $sql = $conectar -> prepare($sql);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }

        public function get_ticket_totalAbierto(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT COUNT(*) as TOTAL FROM tm_ticket WHERE tickest = 'Abierto'";
            $sql = $conectar -> prepare($sql);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }

        public function get_ticket_totalCerrado(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT COUNT(*) as TOTAL FROM tm_ticket WHERE tickest = 'Cerrado'";
            $sql = $conectar -> prepare($sql);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }
    }
?>