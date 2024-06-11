<div class="comment-container" style="margin-left: {{ 20 * $level }}px;">
    <div class="card mb-2">
        <div class="card-body">
            <p><strong>{{ $comentario->user_name }}</strong>: {{ $comentario->texto }}</p>
            <div class="d-flex">
                <button class="btn btn-sm btn-link mr-2 reply-btn" onclick="toggleReplyForm('{{ $comentario->comentario_id }}')">Responder</button>
                <button id="toggle-btn-{{ $comentario->comentario_id }}" class="btn btn-sm btn-link" onclick="toggleReplies('{{ $comentario->comentario_id }}')">Mostrar respuestas</button>
            </div>
            <div id="reply-form-{{ $comentario->comentario_id }}" style="display: none;">
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
    @foreach ($replies as $reply)
        @if ($reply->parent_id == $comentario->comentario_id)
            <div class="reply-line" style="margin-left: {{ 20 * $level + 10 }}px;"></div>
            <div class="reply-{{ $comentario->comentario_id }}" style="display: none;">
                @include('comment', ['comentario' => $reply, 'level' => $level + 1])
            </div>
        @endif
    @endforeach
</div>