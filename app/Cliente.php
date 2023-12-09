<?php namespace Dwes\ProyectoVideoClub;
include_once "Soporte.php";
class Cliente{
    public string $nombre;
    private int $numero;
    private $soportesAlquilados = array();
    private int $numSoportesAlquilados=0;
    private int $maxAlquilerConcurrente;

    private string $usuario;
    private string $password;

    public function __construct(string $nombre, int $numero, $usuario, $password, int $maxAlquilerConcurrente=3) {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
        $this->usuario = $usuario;
        $this->password = $password;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function setNumero(int $numero){
        $this->numero = $numero;
    }

    public function getNumSoportesAlquilados(){
        return $this->numSoportesAlquilados;
    }

    public function muestraResumen(){
        $cantidad = count($this->soportesAlquilados);
        echo "
        <span>$this->nombre</span><br>
        <span>Cantidad de alquileres: $cantidad</span><br>
        ";
    }

    public function tieneAlquilado(Soporte $s):bool{
        foreach ($this->soportesAlquilados as $soporte){
            if($soporte==$s){
                return true;
            }
        }
        return false;
    }

    public function alquilar(Soporte $s){

        if($this->tieneAlquilado($s)){
            echo "<span>El cliente ya tiene alquilado el soporte <b>$s->titulo</b></span><br>";
        }else if($this->numSoportesAlquilados>=$this->maxAlquilerConcurrente){
            //si ya ha alcanzado la cantidad máxima de items alquilados, se deniega
            echo "<span>Este cliente tiene $this->maxAlquilerConcurrente elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo.</span><br>";
        }else{
            //si no lo tiene alquilado, lo alquilamos.
            $this->numSoportesAlquilados++;
            array_push($this->soportesAlquilados, $s);
            echo "<span>Alquilado soporte a: <b>$this->nombre</b></span><br>";
        }
        return $this;
    }

    public function devolver(int $numSoporte):bool{
        for($i=0; $i<count($this->soportesAlquilados); $i++){
            if($this->soportesAlquilados[$i]->getNumero() == $numSoporte){
                //lo quitamos del array de soportes alquilados
                unset($this->soportesAlquilados[$i]);
                $this->numSoportesAlquilados--;
                //realizo un reindexamiento del array
                $this->soportesAlquilados=array_values($this->soportesAlquilados);
                echo "<span>Se ha devuelto el soporte.</span><br>";
                return true;
            }
        }
        echo "<span>No se ha podido encontrar el soporte en los alquileres de este cliente</span><br>";
        return false;
    }

    public function listaAlquileres():void{
        echo "<span>El cliente tiene $this->numSoportesAlquilados soportes alquilados</span><br>";
        foreach($this->soportesAlquilados as $s){
            $s->muestraResumen();
        }
    }
}