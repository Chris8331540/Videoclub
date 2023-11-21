<?php
include_once "../ejercicio329/Resumible.php";
/*328.- Al transformar la clase en abstracta conseguimos que no sea posible
instanciar la clase, sino que deba usarse clases que hereden de ella, además
de que con métodos abstractos obligamos su uso en las clases herederas
*/
abstract class Soporte implements Resumible{
    public string $titulo;
    protected int $numero;
    private float $precio;
    private static int $IVA = 21;

    public function __construct(string $titulo, int $numero, float $precio){
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    /**
     * @return float
     */
    public function getPrecio(): float {
        return $this->precio;
    }

    public function getPrecioConIVA():float{
        return $this->precio*((self::$IVA+100)/100);
    }

    /**
     * @return int
     */
    public function getNumero(): int {
        return $this->numero;
    }

    public function muestraResumen():void{
        echo "<p>$this->titulo</p>";
        echo "<p>$this->precio € (IVA no incluido)</p>";
    }
}