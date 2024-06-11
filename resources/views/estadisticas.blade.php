@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('content')
@if (Str::contains(Auth::user()->name, 'profesor'))
@include('navbar')
@endif

<div class="container">
    <h1 class="my-4 text-center">Buscar Estudiante</h1>

    <form action="{{ route('usuarios.estadisticas') }}" method="GET" class="form-inline mb-4 justify-content-center">
        <div class="form-group mx-sm-3 mb-2">
            <label for="user_id" class="sr-only">buscar por id del estudiante</label>
            <input type="text" class="form-control" id="user_id" name="user_id" placeholder="ID de Usuario" value="{{ request('user_id') }}">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="name" class="sr-only">Buscar por nombre del estudiante</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ request('name') }}">
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary mb-2">Buscar</button>
        </div>
    </form>

    <div class="mb-4">
        <p><strong>Total de Posts:</strong> {{ $total_posts }}</p>
        <p><strong>Total de Comentarios:</strong> {{ $total_comentarios }}</p>
    </div>

    @if(empty($usuarios_estadisticas))
    <div class="alert alert-info">No se encontraron estadísticas para los criterios de búsqueda.</div>
    @else
    @foreach($usuarios_estadisticas as $usuario)
    <div class="mb-4">
        <h4>{{ $usuario['name'] }}</h4>
        <p><strong>Total de Comentados:</strong> {{ $usuario['posts_comentados'] }}</p>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Comentario</th>
                    <th>Post</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuario['comentarios'] as $comentario)
                <tr>
                    <td>{{ $comentario['comentario_texto'] }}</td>
                    <td>{{ $comentario['post_title'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
    @endif
</div>
@endsection