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
    $nombreActualizar = "";
    $usuarioActualizar = "";
    $passwordActualizar = "";
    if(isset($_POST["nombreCliente"])){
        $nombreActualizar = $_POST["nombreCliente"];
    }
    if(isset($_POST["usuarioCliente"])){
        $usuarioActualizar = $_POST["usuarioCliente"];
    }
    if(isset($_POST["passwordCliente"])){
        $passwordActualizar = $_POST["passwordCliente"];
    }
    $usuarioVc = $_SESSION["usuarioVc"];
    $indiceActualizar = array_search($usuarioVc, $vc->getSocios());

    //actualizamos datos
    $socios = $vc->getSocios();
    $socios[$indiceActualizar]->nombre = $nombreActualizar;
    $socios[$indiceActualizar]->setUsuario($usuarioActualizar);
    $socios[$indiceActualizar]->setPassword($passwordActualizar);
    $vc->setSocios($socios);
    $_SESSION["vc"]=$vc;
    //añadir las nuevas creedenciales a la sesión
    unset($users[$usuarioVc->getUsuario()]);
    $users[$usuarioActualizar]=$passwordActualizar;
    $_SESSION["users"]=$users;

    if($usuario=="admin"){
        header("Location: mainAdmin.php");
    }else{
        header("Location: mainCliente.php");
    }
}