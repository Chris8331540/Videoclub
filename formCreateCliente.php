<?php
session_start();
$users = $_SESSION["users"];
$usuario = "";
$password = "";
$validado = false;
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
    ?>
    <form method="post" action="createCliente.php">
        <input type="text" name="nombreCliente" placeholder="Nombre del cliente">
        <input type="text" name="usuarioCliente" placeholder="Usuario del cliente">
        <input type="text" name="passwordCliente" placeholder="Password del cliente">
        <input type="submit" value="Crear">
    </form>
<?php
}