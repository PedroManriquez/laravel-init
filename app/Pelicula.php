<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $table = 'peliculas';

    protected $primaryKey = 'id_pelicula';

    public $timestamps = false;

    protected $fillable = [
    	'nombre',
    	'id_genero',
    	'anno_estreno',
    	'director',
    	'sinopsis'
    ];
}
