

@extends('layouts.app')

@section('content')
@include('navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header text-center">Post</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre del Usuario</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Cantidad de Comentarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->name }}</td> <!-- Muestra el nombre del usuario -->
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->body }}</td>
                                <td>{{ $post->comment_count }}</td> <!-- Muestra la cantidad de comentarios -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection