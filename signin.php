<?php 
    session_start();
    include 'lib/config.php';

    ini_set('Test de errores', 0);

    if(isset($_SESSION['usuario']))
    {
      header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Inicio de Sesion</title>
</head>
<body>
    <div class="container">
        
        <div class="row mt-4 mx-auto">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form  action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electronico</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Email con el que te registraste</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input name="pass" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Guardar Contraseña</label>
                    </div>
                    <button type="submit" name="entrar" id = "env" class="btn btn-primary">iniciar Session</button>
                    <label for="env"><a href="signup.php">O Registrate</a></label>
                </form>

<?php
    if(isset($_POST['entrar'])){
        $email = mysqli_real_escape_string($con ,$_POST['email']);
        $email = strip_tags($_POST['email']);
        $email = trim($_POST['email']);

        $pass = mysqli_real_escape_string($con, md5($_POST['pass']));
        $pass = strip_tags(md5($_POST['pass']));
        $pass = trim(md5($_POST['pass']));

        $buscar = mysqli_query($con, "SELECT * FROM usuarios WHERE email = '$email'
                                        AND contrasena = '$pass';");

        if (!empty($buscar) && mysqli_num_rows($buscar) == 1){
            while ($fila = mysqli_fetch_array($buscar)){
                if($email = $fila['email'] && $pass = $fila['contrasena']){
                    $_SESSION['usuario'] = $fila['usuario'];
                    $_SESSION['id'] = $fila['id_use'];
                    $_SESSION['name'] = $fila['nombre'];

                    header("Location: index.php");
                }
            }
        } else {
            echo 'Error de combinacion entre usuario y contraseña';
        }
        
    }
?>

            </div>
        </div>
    </div>
</body>
</html>