<?php
include "app/Videoclub.php";
use Dwes\ProyectoVideoClub\Videoclub;
$users = array("admin"=>"admin", "usuario"=>"usuario");
$usuario = "";
$password = "";
$validado = false;
$vc = new Videoclub("Severo 8A");

//voy a incluir unos cuantos soportes de prueba
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente", 4.5, "es","16:9");
$vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
$vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9");
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);

$vc->incluirSocio("Amancio Ortega", "usuario1", "password1");
$vc->incluirSocio("Pablo Picasso", "usuario2", "password2", 2);


session_start();
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
}