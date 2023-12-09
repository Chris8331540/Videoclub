<?php
$users = array("admin"=>"admin", "usuario"=>"usuario");
$usuario = "";
$password = "";
$validado = false;
if(isset($_POST["usuario"])){
    $usuario = $_POST["usuario"];
}
if(isset($_POST["password"])){
    $password = $_POST["password"];
}
if(array_key_exists($usuario, $users)){
    if($users[$usuario]==$password){
        $validado = true;
        session_start();
        $_SESSION["usuario"]=$usuario;
        $_SESSION["password"]=$password;
    }
}
if($validado){
    header("Location: main.php");
}else{
    header("Location: index.php?error=1");
}