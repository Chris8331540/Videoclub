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
    $nombreCliente = "";
    $usuarioCliente = "";
    $passwordCliente = "";
    global $vc;
    if(isset($_POST["nombreCliente"])){
        $nombreCliente = $_POST["nombreCliente"];
    }
    if(isset($_POST["usuarioCliente"])){
        $usuarioCliente = $_POST["usuarioCliente"];
    }
    if(isset($_POST["passwordCliente"])){
        $passwordCliente = $_POST["passwordCliente"];
    }
    $vc->incluirSocio($nombreCliente, $usuarioCliente, $passwordCliente);
    //actualizamos la información de sesión
    $_SESSION["vc"]=$vc;
    //añadimos el nuevo usuario
    $users[$usuarioCliente]=$passwordCliente;
    $_SESSION["users"]=$users;
    header("Location: mainAdmin.php");
}
