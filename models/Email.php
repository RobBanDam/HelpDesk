<?php
    require_once("../models/class.phpmailer.php");
    require_once("../models/class.smtp.php");
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");

    class Email extends PHPMailer{
        protected $gcorreo = 'mordidadeperro95@hotmail.com';
        protected $gpass = 'aqui tu pass';

        public function ticket_abierto($tickid){
            $ticket = new Ticket();
            $datos = $ticket -> listar_ticket_x_id($tickid);
            foreach($datos as $row){
                $id = $row["tickid"];
                $usu = $row["usunom"];
                $titulo = $row["ticktitulo"];
                $categoria = $row["catnom"];
                $correo = $row["usucorreo"];
            }
            //Igual//
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';//Aqui el server
            $this->Port = 587;//Aqui el puerto
            $this->SMTPAuth = true;
            $this->Username = $this->gcorreo;
            $this->Password = $this->gpass;
            $this->From = $this->gcorreo;
            $this->SMTPSecure = 'tls';
            $this->FromName = "Ticket Abierto ";
            $this->CharSet = 'UTF8';
            $this->addAddress($correo);
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = "Ticket Abierto";
            //Igual//
            $cuerpo = file_get_contents('../public/NuevoTicket.html');
            $cuerpo = str_replace("#xnroticket",$id,$cuerpo);
            $cuerpo = str_replace("#lblNomUsu",$usu,$cuerpo);
            $cuerpo = str_replace("#lblTitu",$titulo,$cuerpo);
            $cuerpo = str_replace("#lblCate",$categoria,$cuerpo);

            $this->Body = $cuerpo;
            $this->AltBody = strip_tags("Ticket Abierto");
            return $this->Send();
        }

        public function ticket_cerrado($tickid){
            
        }

        public function ticket_asignado($tickid){
            
        }
    }
?>