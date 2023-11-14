<?php
include "./../ejercicio320/Soporte.php";
class CintaVideo extends Soporte{
    private float $duracion;

    public function __construct(string $titulo, int $numero, float $precio, float $duracion){
        parent::__construct($titulo, $numero, $precio);
        $this->duracion = $duracion;
    }

    public function muestraResumen(): void {
        $precio = parent::getPrecio();
        echo "
        <span>Película en VHS:</span><br>
        <span>$this->titulo</span>
        <span>$precio € (IVA no incluido)</span>
        <span>Duración: $this->duracion minutos</span>
        ";
    }
}