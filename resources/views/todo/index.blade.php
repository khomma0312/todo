@extends('layouts.index')

@section('error')
	@include('components.error', ['errors' => $errors])
@endsection

@section('items')

@foreach ($items as $item)
	@include('components.item', ['todo' => $item->todo, 'completed' => $item->getCompleted()])
@endforeach

@endsection