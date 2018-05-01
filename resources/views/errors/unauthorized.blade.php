@extends('layouts.app')
@section('content')
<div class="flex-center position-ref full-height">
    <div class="jumbotron">
      <div class="container text-center">
        <h1 class="display-4">A tartalom megtekintéséhez nincs jogosultsága!</h1>
        <p class="lead mt-4">
            <a class="btn btn-outline-primary" href="{{ url()->previous() }}">Vissza</a>
            <a class="btn btn-primary" href="{{ route('dashboard') }}">Vezérlőpult</a>
        </p>
      </div>
    </div>
</div>
@endsection
