<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    protected $table = 'artistas';

    protected $primaryKey = 'id_artista';

    protected $timestamps =  false;

    protected $fillable = [
    	'nombre',
    	'apellido',
    	'id_pelicula'
    ];
}
