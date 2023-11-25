<?php
    class Usuario extends Conectar{
        public function login(){
            $conectar = parent::conexion();
            parent::set_names();

            if(isset($_POST["enviar"])){
                $correo = $_POST["usucorreo"];
                $pass = $_POST["usupass"];
                $rol = $_POST["rolid"];

                if(empty($correo) and empty($pass)){
                    header("Location:" . conectar::ruta() . "index.php?m=2");
                    exit();
                }else{
                    $sql = "SELECT * FROM tm_usuario WHERE usucorreo = ? AND usupass = ? AND rolid = ? AND est = 1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1, $correo);
                    $stmt->bindValue(2, $pass);
                    $stmt->bindValue(3, $rol);
                    $stmt->execute();
                    $resultado = $stmt->fetch();

                    if(is_array($resultado) and count($resultado) > 0){
                        $_SESSION["usuid"] = $resultado["usuid"];
                        $_SESSION["usunom"] = $resultado["usunom"];
                        $_SESSION["usuape"] = $resultado["usuape"];
                        $_SESSION["rolid"] = $resultado["rolid"];

                        header("Location:" . Conectar::ruta() . "view/Home/");
                        exit();
                    }else{
                        header("Location:" . Conectar::ruta() . "index.php?m=1");
                        exit();
                    }
                }
            }
        }

        public function insert_usuario($usunom, $usuape, $usucorreo, $usupass, $rolid){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO tm_usuario (usuid, usunom, usuape, usucorreo, usupass, rolid, fechacrea, fechamod, fechaelim, est) VALUES (NULL, ?, ?, ?, ?, ?, now(), NULL, NULL, '1');";
            $sql = $conectar -> prepare($sql);
            $sql -> bindValue(1, $usunom);
            $sql -> bindValue(2, $usuape);
            $sql -> bindValue(3, $usucorreo);
            $sql -> bindValue(4, $usupass);
            $sql -> bindValue(5, $rolid);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }

        public function update_usuario($usuid, $usunom, $usuape, $usucorreo, $usupass, $rolid){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE tm_usuario
                SET
                    usunom = ?,
                    usuape = ?,
                    usucorreo = ?,
                    usupass = ?,
                    rolid = ?
                WHERE
                    usuid = ?";
            $sql = $conectar -> prepare($sql);
            $sql -> bindValue(1, $usunom);
            $sql -> bindValue(2, $usuape);
            $sql -> bindValue(3, $usucorreo);
            $sql -> bindValue(4, $usupass);
            $sql -> bindValue(5, $rolid);
            $sql -> bindValue(6, $usuid);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }

        public function delete_usuario($usuid){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE tm_usuario SET est = '0', fechaelim = now() WHERE usuid = ?";
            $sql = $conectar -> prepare($sql);
            $sql -> bindValue(1, $usuid);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }

        public function get_usuario(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM tm_usuario WHERE est = '1'";
            $sql = $conectar -> prepare($sql);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }

        public function get_usuario_id($usuid){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM tm_usuario WHERE usuid = ?";
            $sql = $conectar -> prepare($sql);
            $sql -> bindValue(1, $usuid);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }

        public function get_usuario_total_id($usuid){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT COUNT(*) as TOTAL FROM tm_ticket WHERE usuid = ?";
            $sql = $conectar -> prepare($sql);
            $sql -> bindValue(1, $usuid);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }

        public function get_usuario_totalAbierto_id($usuid){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT COUNT(*) as TOTAL FROM tm_ticket WHERE usuid = ? AND tickest = 'Abierto'";
            $sql = $conectar -> prepare($sql);
            $sql -> bindValue(1, $usuid);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }

        public function get_usuario_totalCerrado_id($usuid){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT COUNT(*) as TOTAL FROM tm_ticket WHERE usuid = ? AND tickest = 'Cerrado'";
            $sql = $conectar -> prepare($sql);
            $sql -> bindValue(1, $usuid);
            $sql -> execute();
            return $resultado = $sql -> fetchAll();
        }
    }
?>