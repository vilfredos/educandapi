@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ $post->title }}</h2>
        </div>
        <div class="card-body">
            <p>{{ $post->body }}</p>
        </div>
    </div>

    <div class="mt-4">
        @foreach ($comentarios as $comentario)
            @include('partials.comentario', ['comentario' => $comentario])
        @endforeach
        <div class="card-footer">
            <form method="POST" action="{{ route('post.comment', $post->id_post) }}">
                @csrf
                <div class="form-group">
                    <textarea name="texto" class="form-control" placeholder="Escribe tu comentario aquí..." required></textarea>
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <button type="submit" class="btn btn-primary">Enviar comentario</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleReplyForm(id) {
        var form = document.getElementById('reply-form-' + id);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endsection