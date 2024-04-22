<!DOCTYPE html>
<html>

<head>
    <!-- Agrega esta línea para vincular tu archivo CSS -->
    <link href="{{ asset('css/ranking.css') }}" rel="stylesheet">
</head>
@include('navbar')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ranking</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Post</th>
                                <th>ID Usuario</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id_post }}</td>
                                <td>{{ $post->id_usuario }}</td>
                                <td>{{ $post->titulo }}</td>
                                <td>{{ $post->descripcion }}</td>
                                <td>{{ $post->calificacion }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>