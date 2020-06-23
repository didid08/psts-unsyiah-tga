@extends('main.master')

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	<li class="breadcrumb-item active">{{ $subtitle }}</li>
@endsection

@section('content')
	<div class="container">
		<div class="card height-auto">
            <div class="card-body">
                <h3>Selamat Datang {{ $category == 'mahasiswa' ? $nama : '' }}</h3>
                @if ($category == 'tamu')
                	<h6>Informasi yang berkaitan dengan dosen dapat dilihat di menu <i>Dosen</i></h6>
                @else
                	<h6>Informasi yang berkaitan dengan TGA dapat dilihat menu <i>TGA</i></h6>
                @endif
            </div>
        </div>
	</div>
@endsection