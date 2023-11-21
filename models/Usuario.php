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
    }
?>