@extends('main.master')

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	<li class="breadcrumb-item active">{{ $subtitle }}</li>
@endsection

@section('content')
	<div class="container">
	    <div class="card height-auto mt-4">
	    	<div class="card-body" style="overflow-x: auto;">
				<div class="row">
					<div class="col">
						<div class="row">
							<p>
								SISTEM ADMINISTRASI DAN DATABASE TUGAS AKHIR MAHASISWA DAN DOSEN<br>
								PROGRAM STUDI S1 TEKNIK SIPIL<br>
								FAKULTAS TEKNIK - UNIVERSITAS SYIAH KUALA
							</p>
							<div class="col">
								<div class="row p-2">
									<div class="col">NIM Mahasiswa</div>
									<div class="col">
										<select name="nim-mahasiswa" id="">
											@foreach ($semua_mahasiswa as $mahasiswa)
												<option>{{ $mahasiswa->nomor_induk }}</option>
											@endforeach
										</select>
									</div>
									<div class="col"><button class="btn btn-lg btn-primary">Panggil Data</button></div>
								</div>
								<div class="row p-2">
									<div class="col">Nama Mahasiswa</div>
									<div class="col"></div>
									<div class="col"><button class="btn btn-lg btn-secondary">Ubah Password</button></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						
					</div>
				</div>
	    	</div>
	    </div>
	</div>
@endsection