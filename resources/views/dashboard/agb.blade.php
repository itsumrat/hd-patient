@extends('layout.master')
@section('content')

    @if(!empty($unsere_agbs))
        {!! $unsere_agbs->description  !!}
    @else



@endif
@endsection
