<?php 

    session_star();
    include 'lib/config.php';

    if(!isset($_SESSION['usuario']))
    {
      header("Location: signin.php");
    }

    $own = $_GET['post'] == $_SESSION['id'];

    if ($own){
        $query = mysqli_query($con, "DELETE FROM comentarios WHERE id_com = ".$_GET['post']."");

        if($query){
            header("Location: index.php");
        }
    }

?>