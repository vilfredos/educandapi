<!-- resources/views/post/comment.blade.php -->
@extends('layouts.app')

@section('content')

<div class="card mb-2">
    <div class="card-body">
        <p><strong>{{ $comentario->name }}</strong>: {{ $comentario->texto }}</p>
        <button class="btn btn-sm btn-link" onclick="toggleReplyForm('{{ $comentario->id }}')">Responder</button>
        <div id="reply-form-{{ $comentario->id }}" style="display: none;">
            <form method="POST" action="{{ route('post.comment', $comentario->id_post) }}">
                @csrf
                <div class="form-group">
                    <textarea name="texto" class="form-control" placeholder="Escribe tu respuesta aquí..." required></textarea>
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="parent_id" value="{{ $comentario->id }}">
                <button type="submit" class="btn btn-primary btn-sm">Enviar respuesta</button>
            </form>
        </div>
    </div>
    @if ($comentario->replies)
        @foreach ($comentario->replies as $reply)
            @include('post.comment', ['comentario' => $reply])
        @endforeach
    @endif
</div>