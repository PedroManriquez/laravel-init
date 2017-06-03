<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{   
    // definicion de tabla a la cual pertenece
    protected $table = 'peliculas';
    // definicion de clave primaria
    protected $primaryKey = 'id_pelicula';
    // timestamps columnas createAt y deleteAt no implementadas
    public $timestamps = false;
    // // definicion de columnas editables de la tabla
    protected $fillable = [
    	'nombre',
    	'id_genero',
    	'anno_estreno',
    	'director',
    	'sinopsis'
    ];
}
