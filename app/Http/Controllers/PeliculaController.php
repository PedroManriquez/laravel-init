<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PeliculaRequest; // request personalizado creado para la validacion de datos del formulario
//uso de modelos
use App\Pelicula;   
use App\Genero;

//uso de componentes
use Redirect; // redireccionamiento a otra ruta
use Session;    // comunicador de mensajes hacia el cliente

class PeliculaController extends Controller
{   

    // Constructor
    public function __construct()
    {   
        // utiliza el middleware auth
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peliculas = Pelicula::all(); // se obtiene la totalidad de peliculas existentes en la BD
        $datos = array ();
        $contador = 0;

        // se obtenendran los valores de cada pelicula y se almacenaran en un array para ser retornados hacia la vista
        foreach ($peliculas as $pelicula) {
            $genero = Genero::find($pelicula->id_genero); // se busca el genero especifico de la pelicula, buscando el id

            // asigancion de valores
            $datos[$contador]["id"] = $pelicula->id_pelicula;
            $datos[$contador]["nombre"] = $pelicula->nombre;
            $datos[$contador]["genero"] = $genero->descripcion;
            $datos[$contador]["anno_estreno"]   = $pelicula->anno_estreno;
            $datos[$contador]["director"] = $pelicula->director;
            $datos[$contador]["sinopsis"] = $pelicula->sinopsis;

            $contador++;
        }
        // retorno de vista y datos que listara
        return view("/home", compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $generos = Genero::all(); // se obtiene todos los generos
        
        // retorno de vista y datos que listara
        return view("/createMovie",compact('generos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     *
     *Se implementa un Request propio para las validaciones de los datos el request
     *Revisar App\Http\Requests\PeliculaRequest.php*/
    public function store(PeliculaRequest  $request)
    {
        // creacion y a su vez validacion si el recurso se creo correctamente
         if (Pelicula::create($request->all())) { 
            // se envia mensaje de confirmacion, (nombre, mensaje) es recivido por alerts.blade.php ubicado en resources/views
            Session::flash('message-success','La pelicula se creó exitosamente');
        } else {
            // se envia mensaje de confirmacion, (nombre, mensaje) es recivido por alerts.blade.php ubicado en resources/views
           Session::flash('message-error','No se ha podido crear la pelicula');
        }
        
        // se retorna a la ruta 
        return Redirect::to('/peliculas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelicula = Pelicula::find($id); // se busca la pelicula
        $generos = Genero::all(); // se busca la pelicula

        // se retorna la vista  y los datos
        return view('editMovie', compact('pelicula','generos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pelicula = Pelicula::find($id); // busqueda de la pelicula a actualizar
        $pelicula->fill($request->all()); // se rellenaran los atributos del objeto con sus respectivos datos
        
        // se guardan los cambios
        if ($pelicula->save()) {
            Session::flash('message-success','La pelicula se actualizó exitosamente');
        } else {
           Session::flash('message-error','No se ha podido actualizar la pelicula');
        }
        
        return Redirect::to('/peliculas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelicula = Pelicula::find($id); // se busca la pelicula

        if ($pelicula->delete()) {  // se elimina
            Session::flash('message-success','La pelicula se eliminó exitosamente');
        } else {
           Session::flash('message-error','No se ha podido eliminar la pelicula');
        }
        return Redirect::to('/peliculas');
    }
}
