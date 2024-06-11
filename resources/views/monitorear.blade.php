@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('content')
@if (Str::contains(Auth::user()->name, 'profesor'))
@include('navbar')
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h1 class="my-4 text-center ">Comentarios con Malas Palabras</h1>

            @if($comentarios->isEmpty())
            <div class="alert alert-info">No se encontraron comentarios con malas palabras.</div>
            @else
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Post</th>
                        <th>Usuario</th>
                        <th>Comentario</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comentarios as $comentario)
                    <tr>
                        <td>{{ $comentario->post_title }}</td>
                        <td>{{ $comentario->name }}</td>
                        <td>{{ $comentario->texto }}</td>
                        <td>
                            <form action="{{ route('comentarios.destroy', $comentario->id_post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="texto" value="{{ $comentario->texto }}">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <div class="col-md-6 text-center">
            <h1 class="my-4">Diccionario de Malas Palabras</h1>

            @if(empty($malasPalabras))
            <div class="alert alert-info">No se encontraron malas palabras.</div>
            @else
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Palabra</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($malasPalabras as $palabra)
                    <tr>
                        <td>{{ $palabra }}</td>
                        <td>
                            <form action="{{ route('diccionario.destroy', $palabra) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <h2 class="my-4 text-center ">Agregar Nueva Palabra</h2>
            <form action="{{ route('diccionario.store') }}" method="POST">
                @csrf
                <div class="form-group text-center">
                    <input type="text" name="nueva_palabra" class="form-control" placeholder="Nueva palabra" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection