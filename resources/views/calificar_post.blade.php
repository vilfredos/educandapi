@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
@if (Str::contains(Auth::user()->name, 'profesor'))
    @include('navbar')
@endif
<div class="container">

    @foreach ($posts as $post)
        <div class="card mb-4">
            <div class="card-header">
                <h3>{{ $post->title }}</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Estudiante</th>
                            @foreach ($rubricas->where('id_post', $post->id_post) as $rubrica)
                                <th>{{ $rubrica->description }} (max: {{ $rubrica->nota }})</th>
                            @endforeach
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estudiantes as $estudiante)
                            <tr>
                                <form method="POST" action="{{ route('guardar_calificaciones') }}">
                                    @csrf
                                    <td>{{ $estudiante->name }}</td>
                                    @foreach ($rubricas->where('id_post', $post->id_post) as $rubrica)
                                        <td>
                                            <input type="number" name="notas[]" class="form-control" max="{{ $rubrica->nota }}" min="0" required>
                                        </td>
                                    @endforeach
                                    <td>
                                        <input type="hidden" name="id_user" value="{{ $estudiante->id }}">
                                        <input type="hidden" name="id_post" value="{{ $post->id_post }}">
                                        <button type="submit" class="btn btn-primary">Calificar</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection