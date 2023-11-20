<?php
include_once "./../ejercicio320/Soporte.php";
class Juego extends Soporte{
    public string $consola;
    private int $minNumJugadores;
    private int $maxNumJugadores;

    public function __construct(string $titulo, int $numero, float $precio, string $consola, int $minNumJugadores, int $maxNumJugadores) {
        parent::__construct($titulo, $numero, $precio);
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

    public function muestraJugadoresPosibles(){
        if($this->minNumJugadores ==1 and $this->maxNumJugadores ==1){
            return "Para un jugador";
        }
        if($this->minNumJugadores == 1 and $this->maxNumJugadores>1){
            return "De $this->minNumJugadores a $this->maxNumJugadores jugadores";
        }
        if($this->minNumJugadores==$this->maxNumJugadores){
            return "Para $this->minNumJugadores jugadores";
        }
    }

    public function muestraResumen(): void {
        $precio = parent::getPrecio();
        $jugadores = $this->muestraJugadoresPosibles();
        echo "
            <span>Juego para: $this->consola</span><br>
            <span>Juego para $this->titulo</span><br>
            <span>$precio € (IVA no incluido)</span><br>
            <span>$jugadores</span><br>
        ";
    }


}