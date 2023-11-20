<?php
include_once "./../ejercicio320/Soporte.php";
class Dvd extends Soporte {
    public string $idiomas;
    private string $formatPantalla;

    public function __construct(string $titulo, int $numero, float $precio, string $idiomas, string $formatPantalla) {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas = $idiomas;
        $this->formatPantalla = $formatPantalla;
    }

    public function muestraResumen(): void {
        $precio = parent::getPrecio();
        echo "
            <span>Película en DVD:</span><br>
            <span>$this->titulo</span><br>
            <span>$precio € (IVA no incluido)</span><br>
            <span>Idiomas: $this->idiomas</span><br>
            <span>Formato Pantalla: $this->formatPantalla</span><br>
        ";
    }
}