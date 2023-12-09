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

    private $numProductosAlquilados = array();
    private int $numTotalAlquileres;

    public function __construct(string $nombre){
        $this->nombre = $nombre;
    }
    public function getNumProductosAlquilados(){
        return $this->numProductosAlquilados;
    }

    public function setNumProductosAlquilados(array $valor){
        $this->numProductosAlquilados = $valor;
    }

    public function getNumTotalAlquileres(){
        return $this->numTotalAlquileres;
    }
    public function setNumTotalAlquilere($valor){
        $this->numTotalAlquileres = $valor;
    }
    public function getProductos(){
        return $this->productos;
    }
    public function getSocios(){
        return $this->socios;
    }
    private function incluirProducto(Soporte $producto):void{
            array_push($this->productos, $producto);
            //echo "<span>Incuido soporte $this->numProductos</span><br>";
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
                        //ponemos el producto como alquilado y lo incluimos en la lista, aumentamos el contador
                        $producto->setAlquilado(true);
                        array_push($this->numProductosAlquilados, $producto->getNumero());
                        $this->numTotalAlquileres++;

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

    public function alquilarSocioProductos(int $numSocio, array $numerosProductos){
        //comprobamos todos los numeros de producto para ver si estan disponibles
        $continuar = true;
        foreach($numerosProductos as $numeroProducto){
            if($continuar){
                $continuar = $this->comprobarNumero($numeroProducto);
            }
        }
        if($continuar){//si continuar sigue estando en true, entonces todos los productos se encuentran disponibles
            foreach($numerosProductos as $numeroProducto){
                $this->alquilarSocioProducto($numSocio, $numeroProducto);
            }
        }
    }

    public function devolverSocioProducto(int $numSocio, int $numeroProducto){
        foreach($this->socios as $socio){
            if($socio->getNumero()==$numSocio){
                for($i = 0; $i<count($this->productos); $i++){
                    if($this->productos[$i]->getNumero()==$numeroProducto){
                        $devuelto = $socio->devolver($numeroProducto);
                        if($devuelto){
                            //en caso de que se haya completado la devolucion
                            //debemos modificar los arrays y cambiar la propiedad alquilado del objeto
                            $this->productos[$i]->setAlquilado(false);
                            unset($this->numProductosAlquilados[array_search($numeroProducto, $this->numProductosAlquilados)]);
                            $this->numProductosAlquilados = array_values($this->numProductosAlquilados);
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function devolverSocioProductos(int $numSocio, array $numerosProductos){
        foreach($numerosProductos as $numeroProducto){
            $this->devolverSocioProducto($numSocio, $numeroProducto);
        }
    }
    private function comprobarNumero($numeroProducto):bool{
        foreach($this->productos as $producto){
            if($numeroProducto==$producto->getNumero()){
                return true;
            }
        }
        return false;
    }
}