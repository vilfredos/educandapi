@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    @if (Str::contains(Auth::user()->name, 'profesor'))
        @include('navbar')
    @endif
    <link href="{{ asset('css/principal.css') }}" rel="stylesheet">
    <div class="container mt-5">
        <div class="row">
            <!-- Columna izquierda para Publicar un nuevo Post y Crear Rúbrica -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header text-center ">
                        <h2>Publicar Post con Rúbrica</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('crear_post') }}">
                            @csrf
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Escribe el título aquí..." required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Escribe la descripción aquí..." required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="rubrica">Rúbrica</label>
                                <button type="button" id="agregar" class="btn btn-secondary mb-2">Agregar</button>
                                <div id="rubrica">
                                    <!-- Aquí se insertarán los campos de la rúbrica -->
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <button type="submit" class="btn btn-primary">Publicar Post y Crear Rúbrica</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Columna derecha para Publicar un nuevo Anuncio -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h2>Publicar un nuevo Anuncio</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('post.anuncio') }}">
                            @csrf
                            <div class="form-group">
                                <label for="body">Anuncio</label>
                                <textarea name="texto" class="form-control" placeholder="Escribe el anuncio aquí..." required></textarea>
                            </div>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <button type="submit" class="btn btn-primary">Publicar Anuncio</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('agregar').addEventListener('click', function() {
            var rubrica = document.getElementById('rubrica');
            var rubricaItem = document.createElement('div');
            rubricaItem.classList.add('rubrica-item', 'mb-2', 'p-2', 'border', 'rounded');
            rubricaItem.innerHTML = `
                <div class="form-group">
                    <label for="descripcionCalificar">Descripción a Calificar</label>
                    <input type="text" id="descripcionCalificar" name="descripcionCalificar[]" class="form-control" placeholder="Descripción a calificar" required>
                </div>
                <div class="form-group">
                    <label for="nota">Nota Maxima a colocar</label>
                    <input type="number" id="nota" name="nota[]" class="form-control" placeholder="Nota" min="1" required>
                </div>
                <button type="button" class="eliminar btn btn-danger mt-2">Eliminar</button>
            `;
            rubrica.appendChild(rubricaItem);

            var eliminarButtons = document.querySelectorAll('.eliminar');
            eliminarButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    this.parentNode.remove();
                });
            });
        });
    </script>
@endsection