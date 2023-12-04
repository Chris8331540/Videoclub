<?php namespace Dwes\ProyectoVideoClub;

include_once "Soporte.php";
include_once "CintaVideo.php";
include_once "Dvd.php";
include_once "Juego.php";
include_once "Cliente.php";

Class Videoclub{
    private string $nombre;
    private $productos = array();
    private int $numProductos=0;
    private $socios = array();
    private int $numSocios=0;

    public function __construct(string $nombre){
        $this->nombre = $nombre;
    }

    private function incluirProducto(Soporte $producto):void{
            array_push($this->productos, $producto);
            echo "<span>Incuido soporte $this->numProductos</span><br>";
            $this->numProductos++;
    }

    public function incluirCintaVideo(string $titulo, float $precio, float $duracion){

        $cintaVideo = new CintaVideo($titulo,$this->numProductos, $precio, $duracion);
        $this->incluirProducto($cintaVideo);
    }

    public function incluirDvd(string $titulo, float $precio, string $idiomas, string $pantalla){
        $dvd = new Dvd($titulo,$this->numProductos, $precio, $idiomas, $pantalla);
        $this->incluirProducto($dvd);
    }

    public function incluirJuego(string $titulo, float $precio, string $consola, int $minJ, int $maxJ){
        $juego = new Juego($titulo,$this->numProductos, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juego);
    }

    public function incluirSocio(string $nombre, int $maxAlquileresConcurrentes = 3){
        $cliente = new Cliente($nombre,$this->numSocios, $maxAlquileresConcurrentes);
        array_push($this->socios, $cliente);
        $this->numSocios++;
    }

    public function listarProductos():void{
        foreach($this->productos as $producto){
            $numLista = $producto->getNumero()+1;
            echo "<span>$numLista.-</span>";
            $producto->muestraResumen();
            echo "<br><br>";
        }
    }

    public function listarSocios():void{

        echo "<span>Listado de $this->numSocios socios del videoclub:</span><br>";
        foreach($this->socios as $socio){
            $numero = $socio->getNumero();
            echo "<b>Cliente $numero: </b>";
            $socio->muestraResumen();
            echo "<br><br>";
        }
    }

    public function alquilarSocioProducto(int $numeroCliente, int $numeroSoporte){
        foreach($this->socios as $socio){
            if($socio->getNumero()==$numeroCliente){
                //comprobamos cual socio coincide con el numero de cliente
                foreach($this->productos as $producto){
                    if($producto->getNumero() == $numeroSoporte){
                        //comprobamos cual producto coincide con el número de soporte
                        $alquilado = $socio->alquilar($producto);
                        if($alquilado){
                            //si se ha alquilado, se muestra el resumen del soporte
                            $producto->muestraResumen();
                        }
                        echo "<br><br>";
                    }
                }
            }
        }
        return $this;
    }
}