@extends('main.master')

@section('custom-style')
	<style>
		.nonactive {
			color: rgba(0,0,0,0.1);
		}
		.icon-size {
			font-size: 1.8em;
		}

		.bg-alert-danger-1 {
			background-color: #c0392b;
		}

		.bg-alert-danger-2 {
			background-color: #e74c3c;
		}
	</style>
@endsection

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	@if ($category != 'mahasiswa' && $nim != null)
		<li class="breadcrumb-item"><a href="{{ route('main.administrasi-tga', ['category' => $category]) }}">{{ $subtitle }}</a></li>
	@endif
	<li class="breadcrumb-item active">{{ $category != 'mahasiswa' ? ($nim != null ? $mahasiswa->nama : $subtitle) : $subtitle }}</li>
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
			@include('main.administrasi-tga.function')
			@if (isset($roles->mhs))
				@include('main.administrasi-tga.mhs.function')
			@endif
			<div class="card">
				<div class="card-body" style="overflow-x: auto;">
					<table class="table table-bordered table-striped table-secondary table-responsive">
						<thead>
							<tr class="bg-info">
								<th rowspan="2" class="text-center align-middle">#</th>
								<th class="text-center align-middle">Nama</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa->nama }}</th>
								<th class="text-center align-middle">Bidang</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa_data_tga->bidang->content }}</th>
								<th colspan="6" class="text-center align-middle">Progress</th>
							</tr>
							<tr class="bg-info">
								<th class="text-center align-middle">NIM</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa->nomor_induk }}</th>
								<th class="text-center align-middle">Nomor HP</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa_data_tga->no_hp->content }}</th>
								<th class="text-center align-middle">Mhs</th>
								<th class="text-center align-middle">Admin</th>
								<th class="text-center align-middle">Koor Prodi</th>
								<th class="text-center align-middle">Ketua Kel.Keahlian</th>
								<th class="text-center align-middle">Pembimbing (Co)</th>
								<th class="text-center align-middle">Koor TGA</th>
							</tr>
						</thead>
						<tbody>
							<tr class="{{ background(1, 3, $administrasi_tga) }}">
								<td><b>1</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-1', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-1', 'admin'))
									@elseif ($roles->koor_prodi != null)
										@include(namaFile('tahap-1', 'koor-prodi'))
									@else
										@include(namaFile('tahap-1', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
									{!! progress(1, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(2, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(3, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr class="{{ background(4, 4, $administrasi_tga) }}">
								<td><b>2</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-2', 'mhs'))
									@elseif (isset($roles->ketua_kel_keahlian))
										@include(namaFile('tahap-2', 'ketua-kel-keahlian'))
									@else
										@include(namaFile('tahap-2', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(4, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr class="{{ background(5, 6, $administrasi_tga) }}">
								<td><b>3</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-3', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-3', 'admin'))
									@elseif (isset($roles->koor_prodi))
										@include(namaFile('tahap-3', 'koor-prodi'))
									@else
										@include(namaFile('tahap-3', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
								</td>
								<td class="text-center align-middle">
									{!! progress(5, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(6, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr class="{{ backgroundOptional(1, 3, $administrasi_tga) }}">
								<td></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-3-opsional-1', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-3-opsional-1', 'admin'))
									@elseif (isset($roles->koor_prodi))
										@include(namaFile('tahap-3-opsional-1', 'koor-prodi'))
									@else
										@include(namaFile('tahap-3-opsional-1', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
									{!! progressOptional(1, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progressOptional(2, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progressOptional(3, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr class="{{ backgroundOptional(4, 5, $administrasi_tga) }}">
								<td></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-3-opsional-2', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-3-opsional-2', 'admin'))
									@elseif (isset($roles->koor_prodi))
										@include(namaFile('tahap-3-opsional-2', 'koor-prodi'))
									@else
										@include(namaFile('tahap-3-opsional-2', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
								</td>
								<td class="text-center align-middle">
									{!! progressOptional(4, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progressOptional(5, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							<tr class="{{ background(7, 7, $administrasi_tga) }}">
								<td><b>4</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-4', 'mhs'))
									@elseif (isset($roles->pembimbing_co))
										@include(namaFile('tahap-4', 'pembimbing-co'))
									@else
										@include(namaFile('tahap-4', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(7, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		@endif
	</div>
@endsection