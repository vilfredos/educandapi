<link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
<nav>
    <ul>
        <li><a href="{{ route('pagina_central') }}">menu principal</a></li>
        <li><a href="{{ route('ranking') }}">Posts</a></li>
        <li><a href="{{ route('usuarios.estadisticas') }}">Participacion estudiante</a></li>
        <li><a href="{{ route('calificar') }}">Calificar Participacion</a></li>
        <li><a href="{{ route('crear_post') }}">Crear post y anuncios</a></li>
        <li><a href="{{ route('calificar_post') }}">Calificacion individual</a></li>
        <li><a href="{{ route('comentarios.monitorear') }}">Moderar contenido</a></li>


    </ul>
</nav>