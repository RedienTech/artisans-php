<?php
    include 'lib/config.php';
    
    function publicacion($id, $name, $usuario, $contenido, $id_user, $likes, $com, $own = 0){
    
?>
    <div class="card mx-auto" style="width: 35rem;">
        <div class="card-body">            
            <h5 class="card-title"><a href="perfil.php?user=<?php echo $usuario ?>"><?php echo $name ?></a></h5>
            <h6 class="card-subtitle mb-2 text-muted"> @<?php echo $usuario ?></h6>
            <p class="card-text"><?php echo $contenido ?></p>
            <a href="likes.php?post=<?php echo $id?>" class="card-link">Likes <?php echo $likes ?></a>
            <a href="comentarios.php?id=<?php echo $id?>" class="card-link">Comentarios <?php echo $com ?></a>
            <?php 
              if ($own){
                  echo '<a href="eliminar.php?post='. $id.' class="card-link ml-2"> Eliminar </a>';
              }  
            ?>
        </div>
    </div>
    <?php }
    
    function comentario($id, $name, $usuario, $contenido, $idUser, $own){
    
    ?>
    <div class="card mx-auto" style="width: 35rem;">
        <div class="card-body">
            <h5 class="card-title"><a href="perfil.php?user=<?php echo $usuario ?>"><?php echo $name ?></a></h5>
            <h6 class="card-subtitle mb-2 text-muted"> <?php echo $usuario ?></h6>
            <p class="card-text"><?php echo $contenido ?></p>
            <?php 
              if ($own){
                  echo '<a href="eliminar-coment.php?id='. $id.' class="card-link ml-2"> Eliminar </a>';
              } 
            ?>
        </div>
    </div>
    <?php } ?>