<div class="card mb-2">
    <div class="card-body">
        <div>
            <strong>{{ $comentario->user_name }}</strong>
            <p>{{ $comentario->texto }}</p>
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-link" onclick="toggleReplyForm('{{ $comentario->comentario_id }}')">Responder</button>
                <span class="ml-2">{{ $comentario->created_at->diffForHumans() }}</span>
            </div>
        </div>
        <div id="reply-form-{{ $comentario->comentario_id }}" style="display: none;" class="mt-2">
            <form method="POST" action="{{ route('post.comment', $post->id_post) }}">
                @csrf
                <div class="form-group">
                    <textarea name="texto" class="form-control" placeholder="Escribe tu respuesta aquí..." required></textarea>
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="parent_id" value="{{ $comentario->comentario_id }}">
                <button type="submit" class="btn btn-primary">Enviar respuesta</button>
            </form>
        </div>
    </div>
</div>

@if ($comentario->replies)
    <div class="ml-4">
        @foreach ($comentario->replies as $reply)
            @include('partials.comentario', ['comentario' => $reply])
        @endforeach
    </div>
@endif