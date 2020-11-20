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
    <title>Perfil</title>
</head>
<body>
<?php echo navbar(); 

$perfil = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario = '".$_GET['user']."'");

while ($info = mysqli_fetch_array($perfil)){

?>

<div class="container">
    <div class="row mt-2">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $info['nombre']?></h5>
                    <span class="card-text">@<?php echo $info['usuario']?></span> <br>
                    <span class="card-text"><?php echo $info['email']?></span> <br><br>
                    <a href="mensajes.php?correo=<?php echo $info['email']?>" class="btn btn-primary">Enviar Mensaje</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2 mx-auto">
       <div class="mx-auto col-md-8">
        <h6 class="text-center">Publicaciones</h6>
       </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-8 mx-auto">
        <?php 
                $pub = "SELECT * FROM publicaciones WHERE usuario = '".$info['id_use']."' ORDER BY fecha DESC";
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
        </div>
    </div>
</div>
    
</body>
</html>

<?php } ?>