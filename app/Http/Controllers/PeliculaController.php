<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelicula;
use App\Genero;
use Redirect;

class PeliculaController extends Controller
{   


    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peliculas = Pelicula::all();
        $datos = array ();
        $contador = 0;
        foreach ($peliculas as $pelicula) {
            $genero = Genero::find($pelicula->id_genero);

            $datos[$contador]["id"] = $pelicula->id_pelicula;
            $datos[$contador]["nombre"] = $pelicula->nombre;
            $datos[$contador]["genero"] = $genero->descripcion;
            $datos[$contador]["anno_estreno"]   = $pelicula->anno_estreno;
            $datos[$contador]["director"] = $pelicula->director;
            $datos[$contador]["sinopsis"] = $pelicula->sinopsis;

            $contador++;
        }
        return view("/home", compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $generos = Genero::all();
        
        return view("/createMovie",compact('generos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pelicula::create($request->all());

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
        $pelicula = Pelicula::find($id);
        $generos = Genero::all();

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
        $pelicula = Pelicula::find($id);
        $pelicula->fill($request->all());
        $pelicula->save();
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
        $pelicula = Pelicula::find($id);
        $pelicula->delete();
        return Redirect::to('/peliculas');
    }
}
