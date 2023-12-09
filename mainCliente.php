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
    echo "<p>Hola $usuario</p>";
    echo "<a href='salir.php'>Cerrar sesión</a>";
    $cliente = getCliente();
    ?>
<ul>
    <?php
    echo "<h3>Productos alquilados:</h3>";
    foreach($cliente->getAlquileres() as $productoAlquilado){
        $titulo = $productoAlquilado->titulo;
        echo "<li>$titulo</li>";
    }
    ?>
</ul>
<?php


}

function getCliente(): ?Cliente{
    global $vc, $usuario;
    foreach($vc->getSocios() as $socio){
        if($socio->getUsuario()==$usuario){
            return $socio;
        }
    }
    return null;
}