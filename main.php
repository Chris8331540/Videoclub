<?php
$users = array("admin"=>"admin", "usuario"=>"usuario");
$usuario = "";
$password = "";
$validado = false;
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
}else{
    header("Location: index.php");
    die();
}