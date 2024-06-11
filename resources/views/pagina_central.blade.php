@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
    @if (Str::contains(Auth::user()->name, 'profesor'))
        @include('navbar')
    @endif
    <link href="{{ asset('css/principal.css') }}" rel="stylesheet">

    <div class="container">
        <div class="row">
            <!-- Columna izquierda para los posts -->
            <div class="col-md-6">
                @foreach ($categorias as $categoria)
                    <div class="card posts mb-4">
                        <div class="card-header text-center">
                            <h2>Post</h2>
                        </div>
                        <div class="card-body">
                            @foreach ($categoria->posts as $post)
                                <h3><a href="{{ route('post_show', $post->id_post) }}">⭢{{ $post->title }}⭠</a></h3>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Columna derecha para anuncios y reglas -->
            <div class="col-md-6">
                <div class="card announcements mb-4">
                    <div class="card-header text-center">
                        <h2>Anuncios</h2>
                    </div>
                    <div class="card-body ">
                        @foreach ($anuncios as $anuncio)
                            <div class="mb-3">
                                <h4>{{ $anuncio->name }}</h4>
                                <p>{{ $anuncio->Texto }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card community-rules">
                    <div class="card-header text-center">
                        <h2>Reglas de la Comunidad del Foro Estudiantil</h2>
                    </div>
                    <div class="card-body">
                        <p>Para asegurar un ambiente seguro y respetuoso, todos los miembros deben seguir estas reglas:</p>
                        <ul>
                            <li><strong>Respeto:</strong> Trata a todos los miembros de la comunidad con respeto. No se tolerará ningún tipo de acoso o discriminación.</li>
                            <li><strong>Contenido Adecuado:</strong> Todo el contenido publicado debe ser apropiado para una audiencia estudiantil. Evita el lenguaje ofensivo, violento o sexual.</li>
                            <li><strong>Académico:</strong> Este foro está destinado a discusiones académicas. Mantén tus publicaciones relevantes para los temas de estudio.</li>
                            <li><strong>Originalidad:</strong> No plagies el trabajo de otros. Siempre da crédito a las fuentes originales.</li>
                            <li><strong>Privacidad:</strong> Respeta la privacidad de otros. No compartas información personal sin consentimiento.</li>
                        </ul>
                        <p>El incumplimiento de estas reglas puede resultar en la eliminación de publicaciones, suspensión o expulsión del foro.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection