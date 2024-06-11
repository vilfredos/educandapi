<style>
    .container {
        max-width: 800px; /* Limita el ancho del contenido */
        margin: auto; /* Centra el contenido */
        padding: 20px; /* Añade un poco de espacio alrededor del contenido */
    }

    h1, h2 {
        color: #4CAF50; /* Un verde oscuro para los títulos */
    }

    .post {
        background-color: #F0F0F0; /* Un color de fondo suave para los posts */
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* Añade una sombra a los posts */
    }

    .btn-danger {
        background-color: #f44336; /* Botón rojo */
        border: none; /* Sin borde */
        color: white; /* Texto blanco */
        padding: 15px 32px; /* Añade un poco de espacio alrededor del texto */
        text-align: center; /* Centra el texto */
        text-decoration: none; /* Elimina el subrayado */
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s; /* Añade una transición suave cuando se pasa el cursor por encima */
        cursor: pointer;
    }

    .btn-danger:hover {
        background-color: #da190b; /* Un rojo un poco más oscuro cuando se pasa el cursor por encima */
        color: white;
    }
</style>


@extends('layouts.app')

@section('content')
@include('navbar')
<div class="container">
    <h1>Información del usuario</h1>
    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <h2>Posts del usuario</h2>
    @foreach ($posts as $post)
        <div class="post">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->body }}</p>

            <!-- Formulario de eliminación del post -->
            <form action="{{ route('post.destroy', $post->id_post) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar Post</button>
            </form>
        </div>
    @endforeach
</div>

@endsection