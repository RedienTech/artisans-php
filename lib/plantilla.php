<?php
include 'lib/config.php';

function navbar () 

{
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Artisans</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="perfil.php?user=<?php echo $_SESSION['usuario']; ?>"><?php echo $_SESSION['usuario']; ?> <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mensajes.php?correo=null">Mensajes</a>
      </li>
      <li class="mr-auto">
        <a class="nav-link" href="logout.php" tabindex="-1">Cerrar Sesion</a>
      </li>
    </ul>
  </div>
</nav>
<?php
}
?>