@extends('lex.plantilla')

@section('content')

<home 
    :user-name="'{{ Auth::user()->name }}'" 
    :status-message="'{{ session('status') }}'"
>
</home>

@endsection