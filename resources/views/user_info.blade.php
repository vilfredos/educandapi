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