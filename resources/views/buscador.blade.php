@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="row">
    <div class="col-xl-12">
    @include('navbar')
        <form action="{{route('buscador')}}" method="get">
            <div class="form-row">
                <div class="col-sm-4 my-1">
                    <input type="text" class="form-control" name="texto">
                </div>
            </div>
            <div class="col-auto my-1">
                <input type="submit" class="btn btn-primary" value="Buscar">
            </div>
        </form>
    </div>
    <div class="col-xl-12">
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @if(count($posts)<=0)
                    <tr>
                        <td colspan="3">No hay resultados</td>
                    </tr>
                @else
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->body }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection