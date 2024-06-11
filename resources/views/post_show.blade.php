@extends('layouts.app')
@php
    use Illuminate\Support\Str;
@endphp

@section('content')
@if (Str::contains(Auth::user()->name, 'profesor'))
        @include('navbar')
    @endif
<link href="{{ asset('css/post_comentarios.css') }}" rel="stylesheet">
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ $post->title }}</h2>
            <p>Posteado por: {{ $post->user_name }}</p>
        </div>
        <div class="card-body">
            <p>{{ $post->body }}</p>
            <button class="btn btn-info" id="toggle-rubrica">Mostrar rúbrica</button>
            <div id="rubrica-section" style="display: none; margin-top: 10px;">
                <h4>Rúbrica a calificar</h4>
                <div class="row">
                    @foreach ($rubricas as $rubrica)
                    <div class="col-md-4 mb-3">
                        <div class="rubrica-item p-3 border rounded">
                            <p><strong>Descripción:</strong> {{ $rubrica->description }}</p>
                            <p><strong>Nota:</strong> 0/{{ $rubrica->nota }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="comment-section mt-4">
        @foreach ($comentarios as $comentario)
        @include('comment', ['comentario' => $comentario, 'level' => 0])
        @endforeach
        <div class="card-footer">
            <form method="POST" action="{{ route('post.comment', $post->id_post) }}">
                @csrf
                <div class="form-group">
                    <textarea name="texto" class="form-control" placeholder="Escribe tu comentario aquí..." required></textarea>
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="parent_id" value="">
                <button type="submit" class="btn btn-primary">Enviar comentario</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('toggle-rubrica').addEventListener('click', function() {
        var rubricaSection = document.getElementById('rubrica-section');
        rubricaSection.style.display = rubricaSection.style.display === 'none' ? 'block' : 'none';
        this.innerText = this.innerText === 'Mostrar rúbrica' ? 'Ocultar rúbrica' : 'Mostrar rúbrica';
    });

    function toggleReplyForm(id) {
        var form = document.getElementById('reply-form-' + id);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function toggleReplies(id) {
        var replies = document.querySelectorAll('.reply-' + id);
        var button = document.getElementById('toggle-btn-' + id);

        replies.forEach(function(reply) {
            reply.style.display = reply.style.display === 'none' ? 'block' : 'none';
        });

        button.innerText = button.innerText === 'Mostrar respuestas' ? 'Ocultar respuestas' : 'Mostrar respuestas';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const replyButtons = document.querySelectorAll('.reply-btn');

        replyButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                const form = button.nextElementSibling;
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            });
        });
    });
</script>
@endsection