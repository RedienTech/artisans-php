<?php
    function mesage($idsend ,$sender, $receiver,  $contenido){
?>
<div class="card mx-auto mt-2" style="width: 35rem;">
        <div class="card-body">
            <h5 class="card-title"><a href="perfil.php?user=<?php echo $idsend ?>"><?php echo $sender ?></a></h5>
            <h6 class="card-subtitle mb-2 text-muted"> a <?php echo $receiver ?></h6>
            <p class="card-text"><?php echo $contenido ?></p>
        </div>
    </div>
<?php } ?>