<?php
    session_start();
    include 'lib/config.php';
    include 'lib/plantilla.php';
    include 'publicaciones.php';
    include 'lib/footer.php';
    include 'lib/msg.php';

    ini_set('Test de errores', 0);
    
    if(!isset($_SESSION['usuario']))
    {
      header("Location: signin.php");
    }

    $predeterminado;

    if ($_GET['correo'] != "null"){
        $predeterminado = $_GET['correo'];
    } else {
        $predeterminado = "";
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Mensajes</title>
</head>
<body>
    <?php navbar()?>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">              
              <div class="box box-primary direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Redactar Mensaje</h3>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                      <i class="fa fa-minus"></i>
                    </button>
                </div>              
                <div class="box-footer">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" value="<?php echo $predeterminado?>" class="form-control" id="correo" name="correo">
                        <label for="correo">Correo de destinatario</label>
                    </div>
                    <div class="input-group">
                      <textarea name="mensaje" onkeypress="return validarn(event)" placeholder="Escribir..." class="form-control" cols="200" rows="3" required></textarea>
                      <br><br><br><br>
                                <br>
                      <button type="submit" name="enviar" class="btn btn-primary btn-flat">Enviar</button>
                    </div>
                  </form>

                <?php
                    if(isset($_POST['enviar'])){
                        $correo = $_POST['correo'];
                        $mensaje = $_POST['mensaje'];

                        $compCorreo = mysqli_query($con, "SELECT * FROM usuarios
                        WHERE email = '$correo';");

                        if(!empty($compCorreo) && mysqli_num_rows($compCorreo) == 1){
                            while ($info = mysqli_fetch_array($compCorreo)){
                                $enviar = mysqli_query($con, "INSERT INTO mensajes (sender, recep, mensaje)
                                VALUES ('".$_SESSION['id']."', '".$info['id_use']."', '$mensaje');");

                                if ($enviar){
                                    header("Location: mensajes.php");
                                } else {
                                    echo 'Ha habido un error';
                                }
                            }
                        } else {
                            "Error en la primera consulta";
                        }
                    }

                ?>

                             
                </div>
                                     
             </div>

                            
                   
            </div>           
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <?php
                
                $msg = mysqli_query($con, "SELECT * FROM mensajes WHERE sender = '".$_SESSION['id']."'
                                           OR recep = '".$_SESSION['id']."' 
                                           ORDER BY fecha DESC");

                while ($msgs = mysqli_fetch_array($msg)){
                    $buscarSender = mysqli_query($con, "SELECT * FROM usuarios 
                                                        WHERE id_use= '".$msgs['sender']."';");
                    while ($sender = mysqli_fetch_array($buscarSender)){
                        $buscarRecep = mysqli_query($con, "SELECT * FROM usuarios 
                                                            WHERE id_use= '".$msgs['recep']."';");
                        while ($recep = mysqli_fetch_array($buscarRecep)){
                            echo mesage($sender['usuario'], $sender['nombre'], $recep['nombre'], $msgs['mensaje']);
                        } 
                    }
                }

                ?>
            </div>
        </div>
    </div>
    <?php echo footer(); ?>
</body>
</html>
