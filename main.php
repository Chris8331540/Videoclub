<?php
include_once "app/Videoclub.php";
use Dwes\ProyectoVideoClub\Videoclub;
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
    $vc = new Videoclub("Severo 8A");

    $vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
    $vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 1);
    $vc->incluirDvd("Torrente", 4.5, "es","16:9");
    $vc->incluirDvd("Origen", 4.5, "es,en,fr", "16:9");
    $vc->incluirDvd("El Imperio Contraataca", 3, "es,en","16:9");
    $vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107);
    $vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140);

    $vc->incluirSocio("Amancio Ortega", "usuario1", "password1");
    $vc->incluirSocio("Pablo Picasso", "usuario2", "password2", 2);
    $users["usuario1"]="password1";
    $users["usuario2"]="password2";
    $vc->alquilarSocioProducto(1,2)->
    alquilarSocioProducto(1,3)->
    alquilarSocioProducto(1,2)->
    alquilarSocioProducto(1,6);

    $_SESSION["users"]=$users;
    $_SESSION["vc"]=$vc;
    if($usuario == "admin"){
        header("Location: mainAdmin.php");
        die();
    }else{
        header("Location: mainCliente.php");
        die();
    }

}else{
    header("Location: index.php");
    die();
}