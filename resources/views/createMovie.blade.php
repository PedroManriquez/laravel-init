@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Nueva Pelicula</div>
                @include('errores')
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/peliculas') }}">
                        {{ csrf_field() }} {{--  token necesario para realizar la consulta --}}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nombre" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="anno_estreno" class="col-md-4 control-label">Año de Estreno</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="anno_estreno" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_genero" class="col-md-4 control-label">Genero</label>
                            <div class="col-md-6">
                                <select class="form-control" name="id_genero" >
                                 {{--  se recorreran los generos enviados desde el servidor --}}
                                   @foreach ($generos as $genero)
                                         <option value="{{ $genero->id_genero }}">{{ $genero->descripcion }}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="director" class="col-md-4 control-label">Nombre de Director</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="director" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sinopsis" class="col-md-4 control-label">Sinopsis</label>

                            <div class="col-md-6">
                                <textarea type="date" class="form-control" name="sinopsis" ></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            	<a class="btn btn-default btn-md" href='/peliculas'>Volver</a>
                                <button type="submit" class="btn btn-primary">
                                    Crear Pelicula
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
