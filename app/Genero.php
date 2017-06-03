<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{	
	// definicion de tabla a la cual pertenece
    protected $table = 'generos';
    // definicion de clave primaria
    protected $primaryKey = 'id_genero';
    // timestamps columnas createAt y deleteAt no implementadas
    public $timestamps = false;
    // definicion de columnas editables de la tabla
    protected $fillable = [
    	'descripcion',
    ];
}
