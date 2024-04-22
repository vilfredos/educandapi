<!DOCTYPE html>
<html>
<head>
    <title>My Laravel Site</title>
    <link rel="stylesheet" href="{{ asset('css/actividades.css') }}">
<body>
@include('navbar')

    <nav>s
        <ul>
            <li>START MENU</li>
            <li>USER INFO</li>
            <li>POSTS</li>
            <li>RANKING</li>
            <li>HISTORIAL POST</li>
            <li>SIGN IN</li>
        </ul>
    </nav>
    <div class="content">
        <div class="post">
            <h2>POST</h2>
            <ul>
                <li>Ecuaciones Cuadráticas</li>
                <li>Energía Solar</li>
                <li>Diagramas de Flujo</li>
                <li>Condicional IF</li>
                <li>Pensamiento Sistémico</li>
            </ul>
        </div>
        <div class="participation">
            <h2>PARTICIPACIÓN</h2>
            <ul>
                <li>100</li>
                <li>99</li>
                <li>52</li>
                <li>45</li>
                <li>23</li>
            </ul>
        </div>
    </div>
</body>
</html>