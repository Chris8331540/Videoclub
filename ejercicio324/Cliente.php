<?php
class Cliente{
    public string $nombre;
    private int $numero;
    private $soportesAlquilados = array();
    private int $numSoportesAlquilados;
    private int $maxAlquilerConcurrente;

    public function __construct(string $nombre, int $numero, int $maxAlquilerConcurrente=3) {
        $this->nombre = $nombre;
        $this->numero = numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
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

    public function alquilar(Soporte $s):bool{
        if($this->tieneAlquilado($s) and $this->numSoportesAlquilados<$this->maxAlquilerConcurrente){
            //si está alquilado y no supera el numero máximo, realizamos la operacion.
            $this->numSoportesAlquilados++;
            array_push($this->soportesAlquilados, $s);
            echo "<span>Se ha alquilado.</span><br>";
            return true;
        }
        //en caso contrario, no realizamos nada, y devolvemos false;
        echo "<span>No se ha podido alquilar.</span><br>";
        return false;

    }
}