@extends('main.master')

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	<li class="breadcrumb-item active">{{ $subtitle }}</li>
@endsection

@section('content')
	<div class="container">
		
	</div>
@endsection