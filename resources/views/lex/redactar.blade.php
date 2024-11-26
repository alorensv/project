@extends('lex.plantilla')

@section('content')

  <redactar 
    :inputs="{{ json_encode($inputs) }}" 
    :documento="{{ json_encode($documento) }}">
  </redactar>

@endsection