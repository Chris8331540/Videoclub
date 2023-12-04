<?php namespace Dwes\ProyectoVideoClub;
/*
 * ejercicio 329.- Hace falta que lo "implemente" el padre y en este caso no sería
 * necesario que los hijos tambien lo implementasen, ya que se usaría el del padre.
 * Otro caso sería en el que el metodo fuese abstracto, de esta forma los hijos si tendrían
 * que implementarlo por obligación*/
interface Resumible{
    public function muestraResumen():void;
}