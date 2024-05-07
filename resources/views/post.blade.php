<!-- resources/views/post.blade.php -->

@extends('layouts.app')

@section('content')
@include('navbar')
<div class="container">
    <!-- Formulario para publicar un nuevo post -->
    <div class="card mb-4">
        <div class="card-header">
            Publicar un nuevo post
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('post.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" class="form-control" placeholder="Escribe el título aquí...">
                </div>
                <div class="form-group">
                    <label for="body">Cuerpo</label>
                    <textarea name="body" class="form-control" placeholder="Escribe el cuerpo del post aquí..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Publicar post</button>
            </form>
        </div>
    </div>

    <!-- Aquí se muestran los posts existentes -->
    @foreach ($posts as $post)
    <div class="card mb-4">
        <div class="card-header">
            {{ $post->title }}
        </div>
        <div class="card-body">
            {{ $post->body }}
            <hr>
            <!-- Aquí puedes mostrar la información del post -->
            @foreach ($post->comentarios as $comentario)
                <p><strong>{{ $comentario->name }}:</strong> {{ $comentario->texto }}</p>
            @endforeach
        </div>
        <!-- Formulario de comentarios -->
        <div class="card-footer">
            <form method="POST" action="{{ route('post.comment', $post->id_post) }}">
                @csrf
                <div class="form-group">
                    <textarea name="texto" class="form-control" placeholder="Escribe tu comentario aquí..."></textarea>
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <button type="submit" class="btn btn-primary">Enviar comentario</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection