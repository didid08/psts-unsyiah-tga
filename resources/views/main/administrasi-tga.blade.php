@extends('main.master')

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	@if ($category != 'mahasiswa' && $nim != null)
		<li class="breadcrumb-item"><a href="{{ route('main.administrasi-tga', ['category' => $category]) }}">{{ $subtitle }}</a></li>
	@endif
	<li class="breadcrumb-item active">{{ $category != 'mahasiswa' ? ($nim != null ? $nama_mahasiswa : $subtitle) : $subtitle }}</li>
@endsection

@section('content')
	<div class="container">
		@if ($category != 'mahasiswa' && $nim == null)
			<div class="card">
				<div class="card-body">
					Halaman Daftar Mahasiswa
				</div>
			</div>
		@else
			<div class="card">
				<div class="card-body">
					Halaman Administrasi TGA
				</div>
			</div>
		@endif
	</div>
@endsection