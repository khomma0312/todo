@extends('layouts.index')

@section('error')
	@include('components.error', ['errors' => $errors])
@endsection

@section('items')

@foreach ($items as $item)
	@include('components.item', [ 'item' => $item ])
@endforeach

@endsection