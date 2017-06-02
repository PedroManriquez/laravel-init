@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de Peliculas</div>

                <div class="panel-body">
                    <div class="col-md-4 col-md-offset-8">
                        <a class="btn btn-primary btn-block" href='/peliculas/create'">Agregar Nueva Pelicula</a>
                    </div>
                    @foreach($datos as $dato)
                        <div class="col-md-10 col-md-offset-1">
                            <h3>{{ $dato['nombre'] }}</h3>
                            <h4>Director: {{ $dato['director'] }}</h4>
                            <h4>Año Estreno: {{ $dato['anno_estreno'] }}</h4>
                            <h4>Genero: {{ $dato['genero'] }}</h4>
                            <h3>Sinopsis</h3>
                            <div style="word-wrap: break-word;">
                                <p>{{ $dato['sinopsis'] }}</p>
                            </div>
                            <br>
                            <div class="col-md-8 col-md-offset-2" style="float: bottom;">
                                <div class="col-md-6">
                                    <a class="btn btn-success btn-md btn-block" href='/peliculas/{{ $dato['id'] }}/edit'>Editar</a>
                                </div>
                                <div class="col-md-6">
                                    <form method="POST" action="{{ url('/peliculas/'.$dato['id']) }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-danger btn-block" value="Eliminar">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <hr>
                        </div>
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
