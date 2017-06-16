<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PeliculaRequest; // request personalizado creado para la validacion de datos del formulario
//uso de modelos
use App\Pelicula;   
use App\Genero;

//uso de componentes
use Redirect; // redireccionamiento a otra ruta
use Session;    // comunicador de mensajes hacia el cliente

class PeliculaApiController extends Controller
{   

    // Constructor
    public function __construct()
    {   
        // utiliza el middleware auth
        // $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Pelicula::all();
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
        $pelicula = Pelicula::create($request->all());
        if (!isset($pelicula)) { 
            $datos = [
            'errors' => true,
            'msg' => 'No se creo pelicula',
            ];
            $pelicula = \Response::json($datos, 404);
        }         
        // se retorna a la ruta 
        return $pelicula;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $pelicula = Pelicula::find($id);
        if (!isset($pelicula)) {
            
        }
        return $pelicula;
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
