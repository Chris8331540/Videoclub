<?php
include_once "app/Videoclub.php";
use Dwes\ProyectoVideoClub\Videoclub;

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
    ?>
        <h2>Lista de Productos</h2>
<ul>
    <?php
    foreach($vc->getProductos() as $producto){
        $nombreProducto = $producto->titulo;//eliminar mensajes de creacion de producto
        echo"<li>$nombreProducto</li>";
    }
    ?>
</ul>
    <h2>Lista de Clientes</h2>
    <ul>
        <?php
        foreach($vc->getSocios() as $socio){
            $nombreCliente = $socio->nombre;//eliminar mensajes de creacion de cliente
            echo"<li>$nombreCliente</li>";
        }
        ?>
    </ul>
<?php
    echo "<a href='formCreateCliente.php'><button>Añadir nuevo cliente</button></a>";
}