@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-dark">
                <div class="card-header">{{ $note->title }}</div>
                <div class="card-body">
                    <p class="card-text">{{ $note->text }}</p>
                </div>
            </div>
            <a class="btn btn-danger mt-2" href="{{ url('/home') }}"><i class="fa-solid fa-circle-chevron-left"></i></a> 
        </div>
    </div>
</div>
@endsection
