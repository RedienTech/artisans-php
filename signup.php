<?php
    session_start();
    include 'lib/config.php';
    ini_set("Errores",0);

    if(isset($_SESSION['usuario'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Registro de nuevo usuario</title>
</head>
<body>
<div class="container">
        <div class="row mt-4 mx-auto">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="emailHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Correo</label>
                        <input  type="email" class="form-control" name="correo" id="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input   type="text" id="usuario" name="usuario" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pass">Contraseña</label>
                        <input type="password" id="pass" class="form-control" name="contraseña" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm">Confirmar contraseña</label>
                        <input type="password" id="confirm" class="form-control" name="confirm" required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Guardar Contraseña</label>
                    </div>
                    <button type="submit" id = "env" name="registrar" class="btn btn-primary">Registrate</button>
                    <label for="env"><a href="signin.php">O Inicia Sesion</a></label>
                </form>
<?php
    if(isset($_POST['registrar'])){
        $nombre = ($_POST['nombre']);
        $correo = ($_POST["correo"]);
        $usuario = ($_POST["usuario"]);
        $contraseña = (md5($_POST["contraseña"]));
        $confirm = (md5($_POST["confirm"]));
        
        $compusuario = mysqli_query($con ,"SELECT usuario FROM usuarios WHERE usuario = '$usuario';");
        
        if (!empty($compusuario) && mysqli_num_rows($compusuario) >= 1){echo "El nombre de usuario esta en uso";} else {
        $compemail = mysqli_query($con, "SELECT email FROM usuarios WHERE email = '$correo';");
        if (!empty($compemail) && mysqli_num_rows($compemail) >= 1) {echo 'El correo ya esta en uso, seleccione otro';} else {
        if ($contraseña != $confirm){echo 'LAs contraseñas no coinciden'; } else {

            $guardarUsuario = mysqli_query($con,"INSERT INTO usuarios(nombre, email, usuario, contrasena) 
                                                VALUES ('$nombre', '$correo', '$usuario', '$contraseña');");
            if($guardarUsuario){
                echo 'Usuario guardado con exito';
            } else {
                echo 'No se ha guardado';
            }
                }
            }
        }
    }
?>


            </div>
        </div>
    </div>
</body>
</html>