<?php
    session_start();
    include 'lib/config.php';
    include 'lib/plantilla.php';
    include 'publicaciones.php';
    include 'lib/footer.php';

    ini_set('Test de errores', 0);
    
    if(!isset($_SESSION['usuario']))
    {
      header("Location: signin.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Inicio</title>
</head>
<body>
    <?php navbar()?>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">              
              <div class="box box-primary direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Nueva Publicacion</h3>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                      <i class="fa fa-minus"></i>
                    </button>
                </div>              
                <div class="box-footer">
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                      <textarea name="publicacion" onkeypress="return validarn(event)" placeholder="Escribir..." class="form-control" cols="200" rows="3" required></textarea>
                      <br><br><br><br>
                                <br>
                      <button type="submit" name="publicar" class="btn btn-primary btn-flat">Publicar</button>
                    </div>
                  </form>
                    <?php
                        if(isset($_POST['publicar'])){
                            $publicacion = mysqli_real_escape_string($con, $_POST['publicacion']);

                            $query = "INSERT INTO publicaciones (usuario, contenido)
                                    VALUES ('".$_SESSION['id']."', '$publicacion');";
                            $publicar = mysqli_query($con, $query);

                            if ($publicar){
                                header("Location: index.php");
                            }
                        }      
                    ?>           
                </div>
                                     
              </div>

              <?php 
                $pub = "SELECT * FROM publicaciones ORDER BY fecha DESC";
                $busqueda = mysqli_query($con, $pub);
                while ($rows = mysqli_fetch_array($busqueda)){
                    $nombre = mysqli_query($con, "SELECT nombre, usuario FROM usuarios 
                                                  WHERE id_use = '".$rows['usuario']."';");

                      $coments = mysqli_query($con, "SELECT * FROM comentarios
                                                    WHERE publicacion = ".$rows['id_pub'].";");

                      $numComents = mysqli_num_rows($coments);

                      $likes = mysqli_query($con, "SELECT * FROM likes
                                                  WHERE post = ".$rows['id_pub'].";");

                      $numLikes = mysqli_num_rows($likes);

                      $own = ($_SESSION['id'] == $rows['usuario']);

                    while ($user = mysqli_fetch_array($nombre)){
                        echo '<div class="mt-3">';
                        echo publicacion($rows['id_pub'], $user['nombre'], $user['usuario'], 
                                        $rows['contenido'], $rows['usuario'], $numLikes, $numComents, $own);
                        echo '</div> ';
                    }
                }
              ?>

              
                    <?php ?>
            </div>           
    </div>
    </div>
    <?php echo footer(); ?>
</body>
</html>