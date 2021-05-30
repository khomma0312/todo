@extends('layouts.index')

@section('error')
	@include('components.error', ['errors' => $errors])
@endsection
