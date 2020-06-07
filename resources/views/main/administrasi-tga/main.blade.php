@extends('main.master')

@section('custom-style')
	<style>
		.nonactive {
			color: rgba(0,0,0,0.1);
		}
		.icon-size {
			font-size: 1.8em;
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
			@php
				function namaFile ($tahap, $role) {
					$path = 'main.administrasi-tga.';
					return $path.$role.'.'.$tahap;
				}

				function progressIndicator ($tahap, $disposition, $administrasi_tga) {
					if ($administrasi_tga->value('tahap') > $tahap) {
						return '<i class="fa fa-check-circle text-green icon-size"></i>';
					} elseif ($administrasi_tga->value('tahap') == $tahap && $administrasi_tga->value('disposition') > $disposition) {
						return '<i class="fa fa-check-circle text-green icon-size"></i>';
					} elseif ($administrasi_tga->value('tahap') == $tahap && $administrasi_tga->value('disposition') == $disposition && $administrasi_tga->value('repeat')) {
						return '<i class="fa fa-times-circle text-red icon-size"></i>';
					} else {
						return '<i class="fa fa-circle nonactive icon-size"></i>';
					}
				}

				function progressIndicatorOpsional ($disposition, $administrasi_tga) {
					if ($administrasi_tga->value('disposition_optional') > $disposition) {
						return '<i class="fa fa-check-circle text-green icon-size"></i>';
					} elseif ($administrasi_tga->value('disposition_optional') == $disposition && $administrasi_tga->value('repeat_optional')) {
						return '<i class="fa fa-times-circle text-red icon-size"></i>';
					} else {
						return '<i class="fa fa-circle nonactive icon-size"></i>';
					}
				}
			@endphp
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
							<tr class="{{ $administrasi_tga->value('tahap') > 1 ? 'table-success' : ($administrasi_tga->value('repeat') ? 'table-danger' : 'table-info') }}">
								<td><b>1</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-1', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-1', 'admin'))
									@elseif ($roles->koor-prodi != null)
										@include(namaFile('tahap-1', 'koor-prodi'))
									@else
										@include(namaFile('tahap-1', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
									{!! progressIndicator(1, 1, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progressIndicator(1, 2, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progressIndicator(1, 3, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr class="{{ $administrasi_tga->value('tahap') > 2 ? 'table-success' : ($administrasi_tga->value('tahap') < 2 ? '' : ($administrasi_tga->value('repeat') ? 'table-danger' : 'table-info')) }}">
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
									{!! progressIndicator(2, 1, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr class="{{ $administrasi_tga->value('tahap') > 3 ? 'table-success' : ($administrasi_tga->value('tahap') < 3 ? '' : ($administrasi_tga->value('repeat') ? 'table-danger' : 'table-info')) }}">
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
									{!! progressIndicator(3, 1, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progressIndicator(3, 2, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr class="{{ $administrasi_tga->value('disposition_optional') > 3 ? 'table-success' : ($administrasi_tga->value('disposition_optional') < 1 ? '' : ($administrasi_tga->value('repeat_optional') ? 'table-danger' : 'table-warning')) }}">
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
									{!! progressIndicatorOpsional(1, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progressIndicatorOpsional(2, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progressIndicatorOpsional(3, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr class="{{ $administrasi_tga->value('disposition_optional') > 5 ? 'table-success' : ($administrasi_tga->value('disposition_optional') < 4 ? '' : ($administrasi_tga->value('repeat_optional') ? 'table-danger' : 'table-warning')) }}">
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
									{!! progressIndicatorOpsional(4, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progressIndicatorOpsional(5, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		@endif
	</div>
@endsection