@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('content')
@if (Str::contains(Auth::user()->name, 'profesor'))
    @include('navbar')
@endif
<div class="container">
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title text-center "><strong> Información de la Nota</strong></h5>
            <p class="card-text">
                <strong>Nota Individual:</strong> La nota individual se calcula sumando las notas de las participaciones individuales y dividiendo el resultado entre el total de notas otorgadas por cada publicación, según lo establecido en la rúbrica. Este resultado se multiplica por 100 para obtener la nota
            </p>
            <p class="card-text">
                <strong>Nota Grupal:</strong> La nota grupal se puede calificar en la parte de abajo.
            </p>
            <p class="card-text">
                <strong>Nota Final:</strong> La nota final es el promedio de ambas notas.
            </p>
        </div>
    </div>
</div>

<div class="container mt-5">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th>Calificar participación grupal</th>
                <th>Nota participacion grupal</th>
                <th>Nota participacion individual</th>
                <th>Nota final</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $estudiante)
                @php
                    $nota_estudiante = $notas->where('id_user', $estudiante->id)->sum('nota');
                    $suma_nota_estudiantes = $notas_estudiantes->has($estudiante->id) ? $notas_estudiantes[$estudiante->id]->suma_nota_estudiantes : 0;
                    $suma_nota_rubrica_post = $suma_nota_rubrica_post ?: 1; // Evitar división por cero
                    $porcentaje_nota_estudiantes = round(($suma_nota_estudiantes / $suma_nota_rubrica_post) * 100, 2);
                    $resultado = round(($porcentaje_nota_estudiantes + $nota_estudiante) / 2, 2);
                @endphp
                <tr>
                    <td>{{ $estudiante->name }}</td>
                    <td><a href="{{ route('rubrica', $estudiante->id) }}" class="btn btn-primary btn-sm">Calificar</a></td>
                    <td>{{ $nota_estudiante }}</td>
                    <td>{{ $porcentaje_nota_estudiantes }}%</td>
                    <td>{{ $resultado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection