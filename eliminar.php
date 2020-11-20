<?php 
    session_start();
    include 'lib/config.php';

    if(!isset($_SESSION['usuario']))
    {
      header("Location: index.php");
    }

    $query = mysqli_query($con, "SElECT * FROM publicaciones WHERE id_pub = '".$_GET['post']."'
                                AND usuario = ".$_SESSION['id']."");

    
    

    if (!empty($query) && mysqli_num_rows($query) == 1){
        $delete = mysqli_query($con, "DELETE FROM publicaciones WHERE id_pub = '".$_GET['post']."'");

        if($delete){
            header("Location: index.php");
        } else {
            echo 'Ha habido un error';
        }
    } else {
        echo 'No existe';
    }

?>