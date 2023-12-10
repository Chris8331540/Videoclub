<?php
include_once "app/Videoclub.php";
include_once "app/Cliente.php";
use \Dwes\ProyectoVideoClub\Videoclub;
use \Dwes\ProyectoVideoClub\Cliente;
session_start();
$users = $_SESSION["users"];
$usuario = "";
$password = "";
$validado = false;
$vc = $_SESSION["vc"];
if(isset($_SESSION["usuario"])){
    $usuario = $_SESSION["usuario"];
}
if(isset($_SESSION["password"])){
    $password = $_SESSION["password"];
}

if(array_key_exists($usuario, $users)){
    if($users[$usuario]==$password){
        $validado = true;
    }
}

if($validado){
    $usuarioToUpdate = "";
    if($usuario == "admin"){
        if(isset($_GET["usuarioToUpdate"])){
            $usuarioToUpdate = $_GET["usuarioToUpdate"];
        }
    }else{
        $usuarioToUpdate = $usuario;
    }
    $usuarioVc=obtenerUsuario($usuarioToUpdate);
    $_SESSION["usuarioVc"]=$usuarioVc;
    ?>

<form method="post" action="updateCliente.php" >
    <label>Nombre del Cliente:</label><br>
    <input type="text" name="nombreCliente" value="<?php echo $usuarioVc->nombre?>"><br><br>

    <label>Usuario del Cliente:</label><br>
    <input type="text" name="usuarioCliente" value="<?php echo $usuarioVc->getUsuario() ?>"><br><br>

    <label>Contraseña del Cliente:</label><br>
    <input type="text" name="passwordCliente" value ="<?php echo $usuarioVc->getPassword()?>"><br><br>
    <input type="submit" value="Actualizar">
</form>
<?php
}

function obtenerUsuario($nombreUsuario):?Cliente{
    global $vc;
    $listaUsuarios = $vc->getSocios();
    foreach($listaUsuarios as $usuario){
        if($usuario->getUsuario()==$nombreUsuario){
            return $usuario;
        }
    }
    return null;
}