<?php
    session_start();
    include 'lib/config.php';

    if(!isset($_SESSION['usuario']))
    {
      header("Location: index.php");
    }

    $idPub = $_GET['post'];

    $query = mysqli_query($con, "SELECT * FROM likes WHERE post = '".$_GET['post']."';");

    if (!empty($query) && mysqli_num_rows($query) >= 1){
        header("Location: index.php");
    } else {
        $darLike = mysqli_query($con, "INSERT INTO likes(usuario, post) 
                                 VALUES ('".$_SESSION['id']."', '".$_GET['post']."');");

        if ($darLike){
            header("Location: index.php");
        }
    }

?>