@extends('layouts.app')

@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <h3>{{ $course['fullname'] }}</h3>
        </div>
        <div class="card-body">
            <p>{{ $course['summary'] }}</p>
        </div>
    </div>
@endsection