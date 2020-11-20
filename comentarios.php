<?php
    session_start();
    include 'lib/config.php';
    include 'lib/plantilla.php';
    include 'publicaciones.php';

    ini_set('Test de errores', 0);
    
    if(!isset($_SESSION['usuario']))
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
    <title>Comentar</title>
</head>
<body>
    <?php navbar()?>
    <div class="container">
       <div class="row">
        <div class="col-md-8 mx-auto">
            <?php 
                $query = mysqli_query($con, "SELECT * FROM publicaciones WHERE id_pub = ".$_GET['id'].";");
                while ($rows = mysqli_fetch_array($query)){
                    $name = mysqli_query($con, "SELECT nombre, usuario FROM usuarios 
                                                  WHERE id_use = '".$rows['usuario']."';");
                    $coments = mysqli_query($con, "SELECT * FROM comentarios
                    WHERE publicacion = ".$rows['id_pub'].";");

                    $numComents = mysqli_num_rows($coments);

                    $likes = mysqli_query($con, "SELECT * FROM likes
                                         WHERE post = ".$rows['id_pub'].";");

                    $numLikes = mysqli_num_rows($likes);

                    while ($user = mysqli_fetch_array($name)){
                        echo '<div class="mt-3">';
                        echo publicacion($rows['id_pub'], $user['nombre'], $user['usuario'], 
                                        $rows['contenido'], $rows['usuario'], $numLikes, $numComents);
                        echo '</div> ';
                    }
                }


            ?>
        </div>
       </div> 
       <div class="row mt-2">
           <div class="col-md-6 mx-auto">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                      <textarea name="comentario" onkeypress="return validarn(event)" placeholder="Escribir" class="form-control" cols="200" rows="3" required></textarea>
                      <br><br><br><br>
                                <br>
                      <button type="submit" name="publicar" class="btn btn-primary btn-flat">Comentar</button>
                    </div>
                  </form>
                <?php 
                    if (isset($_POST['publicar'])){
                        $contenido = mysqli_real_escape_string($con, $_POST['comentario']);
                        $userId = $_SESSION['id'];
                        $pubId = $_GET['id'];

                        $query = mysqli_query($con, "INSERT INTO comentarios (usuario, comentario, publicacion)
                                           VALUES ($userId, '$contenido', $pubId);");

                        if ($query){
                            echo 'Comentario publicado';
                        //header("Location: comentarios.php?id='$pubId'");
                        }
                    }
                ?>
           </div>
       </div>
       <h4 class="mx-auto text-center mt-2">Comentarios</h4>
       <div class="row mt-2">
            <?php 
                $coments = mysqli_query($con, "SELECT * FROM comentarios WHERE publicacion = 
                ".$_GET['id']." ORDER BY fecha DESC;");

                while ($rows = mysqli_fetch_array($coments)){
                    $idUser = $rows['usuario'];
                    $infoUser = mysqli_query($con, "SELECT nombre, usuario FROM usuarios
                    WHERE id_use = '$idUser';");

                    $own = ($rows['usuario'] == $_SESSION['id']);

                    while ($info = mysqli_fetch_array($infoUser)){
                        echo '<div class="mt-3 mx-auto">';
                        echo comentario($rows['id_com'], $info['nombre'], $info['usuario'], 
                                        $rows['comentario'], $rows['usuario'], $own);
                        echo '</div> ';
                    }
                }

            ?>
       </div>
    </div>
</body>
</html>