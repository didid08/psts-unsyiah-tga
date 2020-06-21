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
	@if ($category != 'mahasiswa' && $nim == null)
		<div class="container">
			<div class="card">
				<div class="card-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr class="bg-info">
								<th class="align-middle text-center">No.</th>
								<th class="align-middle">Nama</th>
								<th class="align-middle text-center">NIM</th>
								<th class="align-middle text-center">Opsi</th>
							</tr>
						</thead>
						<tbody>
							@php
								$empty = true;
							@endphp
							@foreach ($administrasi_tga as $index => $value)
								@php
									$empty = false;
								@endphp
								<tr>
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle">{{ $value->nama }}</td>
									<td class="align-middle text-center">{{ $value->nim }}</td>
									<td class="align-middle text-center"><a href="{{ route('main.administrasi-tga', ['category' => $category, 'nim' => $value->nim ]) }}" class="btn btn-info">Pilih</a></td>
								</tr>
							@endforeach
							@if ($empty)
								<tr>
									<td class="align-middle text-center">--</td>
									<td class="align-middle">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	@else
		@include('main.administrasi-tga.modals')
		<div class="container">
			@include('main.administrasi-tga.function')
			@if (isset($roles->mhs))
				@include('main.administrasi-tga.mhs.function')
			@endif
			<div class="card">
				<div class="card-body" style="overflow-x: auto;">
					<table class="table table-bordered table-striped table-secondary table-responsive">
						<thead>
							<tr class="bg-light">
								<th colspan="11" class="align-middle" style="background-color: #f1f2f6;">
									<table class="table-borderless">
										<tr class="" style="background-color: #f1f2f6;">
											<td class="align-middle text-center">
												<img src="{{ asset('dist/img/logo-unsyiah.png') }}" alt="Universitas Syiah Kuala" width="110em">	
											</td>
											<td class="align-middle text-left">
												LEMBAR DISPOSISI TUGAS AKHIR - JURUSAN TEKNIK SIPIL<br>
												FAKULTAS TEKNIK UNIVERSITAS SYIAH KUALA<br>
												@if (isset($roles->admin))
													<span class="mr-2">No: </span><input type="text" name="no-disposisi" class="form-control mt-2" placeholder="Belum ada nomor" style="width: 18em; display: inline; height: 2.2em;">
													<button class="btn btn-sm btn-secondary">Update</button><br>
												@else
													<span class="mr-2">No: </span><input type="text" class="form-control bg-light mt-2" placeholder="Belum ada nomor" style="width: 18em; display: inline; height: 2.2em;" readonly="repeat_optional">
												@endif
											</td>
										</tr>
									</table>
								</th>
								{{--<th colspan="10" class="align-top text-center" style="background-color: #f1f2f6;">
									
								</th>--}}
							</tr>
							<tr class="" style="background-color: #f5f6fa">
								<th rowspan="2" class="text-center align-middle">#</th>
								<th class="text-center align-middle">Nama</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa->nama }}</th>
								<th class="text-center align-middle">Bidang</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa_data_tga->bidang->content }}</th>
								<th colspan="6" class="text-center align-middle">Progress</th>
							</tr>
							<tr class="" style="background-color: #f5f6fa">
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
							{{-- Tahap 1 --}}
							<tr class="{{ background(1, 3, $administrasi_tga) }}">
								<td><b>1</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-1', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-1', 'admin'))
									@elseif (isset($roles->koor_prodi))
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

							{{-- Tahap 2 --}}
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

							{{-- Tahap 3 --}}
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

							@if ($administrasi_tga->value('progress') >= 26 &&  $administrasi_tga->value('progress_optional') < 6)
								{{-- Tahap 3 (opsional) [Inactive] --}}
								<tr>
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
										<i class="fa fa-circle nonactive icon-size"></i>
									</td>
									<td class="text-center align-middle">
										<i class="fa fa-circle nonactive icon-size"></i>
									</td>
									<td class="text-center align-middle">
										<i class="fa fa-circle nonactive icon-size"></i>
									</td>
									<td class="text-center align-middle"></td>
									<td class="text-center align-middle"></td>
									<td class="text-center align-middle"></td>
								</tr>

								{{-- Tahap 3 (opsional) bagian 2 [Inactive] --}}
								<tr>
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
										<i class="fa fa-circle nonactive icon-size"></i>
									</td>
									<td class="text-center align-middle">
										<i class="fa fa-circle nonactive icon-size"></i>
									</td>
									<td class="text-center align-middle"></td>
									<td class="text-center align-middle"></td>
									<td class="text-center align-middle"></td>
								</tr>
							@else
								{{-- Tahap 3 (opsional) --}}
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

								{{-- Tahap 3 (opsional) bagian 2 --}}
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
							@endif
							
							{{-- Tahap 4 --}}
							<tr class="{{ background(7, 7, $administrasi_tga) }}">
								<td><b>4</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-4', 'mhs'))
									@elseif (isset($roles->pembimbing_co) && $is_pembimbing)
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

							{{-- Tahap 5 --}}
							<tr class="{{ background(8, 10, $administrasi_tga) }}">
								<td><b>5</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-5', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-5', 'admin'))
									@elseif (isset($roles->koor_tga))
										@include(namaFile('tahap-5', 'koor-tga'))
									@else
										@include(namaFile('tahap-5', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
									{!! progress(8, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(9, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(10, $administrasi_tga) !!}
								</td>
							</tr>			

							{{-- Tahap 6 --}}
							<tr class="{{ background(11, 12, $administrasi_tga) }}">
								<td><b>6</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-6', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-6', 'admin'))
									@elseif (isset($roles->koor_prodi))
										@include(namaFile('tahap-6', 'koor-prodi'))
									@else
										@include(namaFile('tahap-6', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(11, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(12, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 7 --}}
							<tr class="{{ background(13, 14, $administrasi_tga) }}">
								<td><b>7</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-7', 'mhs'))
									@elseif (isset($roles->komisi_penguji))
										@include(namaFile('tahap-7', 'komisi-penguji'))
									@else
										@include(namaFile('tahap-7', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 8 --}}
							<tr class="{{ background(15, 17, $administrasi_tga) }}">
								<td><b>8</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-8', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-8', 'admin'))
									@elseif (isset($roles->koor_prodi))
										@include(namaFile('tahap-8', 'koor-prodi'))
									@else
										@include(namaFile('tahap-8', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
									{!! progress(15, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(16, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(17, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							
							{{-- Tahap 9 --}}
							<tr class="{{ background(18, 19, $administrasi_tga) }}">
								<td><b>9</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-9', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-9', 'admin'))
									@else
										@include(namaFile('tahap-9', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
									{!! progress(18, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(19, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 10 --}}
							<tr class="{{ background(20, 20, $administrasi_tga) }}">
								<td><b>10</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-10', 'mhs'))
									@elseif (isset($roles->pembimbing_co) && $is_pembimbing)
										@include(namaFile('tahap-10', 'pembimbing-co'))
									@else
										@include(namaFile('tahap-10', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(20, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 11 --}}
							<tr class="{{ background(21, 23, $administrasi_tga) }}">
								<td><b>11</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-11', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-11', 'admin'))
									@elseif (isset($roles->koor_tga))
										@include(namaFile('tahap-11', 'koor-tga'))
									@else
										@include(namaFile('tahap-11', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
									{!! progress(21, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(22, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(23, $administrasi_tga) !!}
								</td>
							</tr>

							{{-- Tahap 12 --}}
							<tr class="{{ background(24, 25, $administrasi_tga) }}">
								<td><b>12</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-12', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-12', 'admin'))
									@elseif (isset($roles->koor_prodi))
										@include(namaFile('tahap-12', 'koor-prodi'))
									@else
										@include(namaFile('tahap-12', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(24, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(25, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 13 --}}
							<tr class="{{ background(26, 27, $administrasi_tga) }}">
								<td><b>13</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-13', 'mhs'))
									@elseif (isset($roles->komisi_penguji))
										@include(namaFile('tahap-13', 'komisi-penguji'))
									@else
										@include(namaFile('tahap-13', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 14 --}}
							<tr class="{{ background(28, 30, $administrasi_tga) }}">
								<td><b>14</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-14', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-14', 'admin'))
									@elseif (isset($roles->koor_prodi))
										@include(namaFile('tahap-14', 'koor-prodi'))
									@else
										@include(namaFile('tahap-14', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
									{!! progress(28, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(29, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(30, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 15 --}}
							<tr class="{{ background(31, 32, $administrasi_tga) }}">
								<td><b>15</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-15', 'mhs'))
									@elseif (isset($roles->pembimbing_co))
										@include(namaFile('tahap-15', 'pembimbing-co'))
									@else
										@include(namaFile('tahap-15', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
									{!! progress(31, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(32, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 16 --}}
							<tr class="{{ background(34, 36, $administrasi_tga) }}">
								<td><b>16</b></td>
								<td colspan="4">
									@if (isset($roles->mhs))
										@include(namaFile('tahap-16', 'mhs'))
									@elseif (isset($roles->admin))
										@include(namaFile('tahap-16', 'admin'))
									@elseif (isset($roles->koor_prodi))
										@include(namaFile('tahap-16', 'koor-prodi'))
									@else
										@include(namaFile('tahap-16', 'read-only'))
									@endif
								</td>
								<td class="text-center align-middle">
									{!! progress(34, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(35, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(36, $administrasi_tga) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	@endif
@endsection

@section('custom-script')
	<script>
		$('input[type=file]').each(function (index, data) {
			$(this).val('');
		});

		function showSelectedFile(label, e) {
			var fileName = e.target.files[0].name;

			var html;
			if (fileName.length <= 10) {
				html = fileName;
			} else {
				html = fileName.substring(0,10)+'...';
			}
			$(label).html(html);
		}

		@php
			$tahap = [
				[1,2,3], //Tahap 1
				[4], //Tahap 2
				[5,6], //Tahap 3
				[7], //Tahap 4
				[8,9,10], //Tahap 5
				[11,12], //Tahap 6
				[13,14], //Tahap 7
				[15,16,17], //Tahap 8
				[18,19], //Tahap 9
				[20], //Tahap 10
				[21,22,23], //Tahap 11
				[24,25], //Tahap 12
				[26,27], //Tahap 13
				[28,29,30], //Tahap 14
				[31,32,33], //Tahap 15
				[34,35,36] //Tahap 16
			];

			$tahap_opsional = [
				[1,2,3],
				[4,5]
			];
		@endphp

		@if (isset($roles->mhs))
			@if ($administrasi_tga->value('repeat'))
				toastr.error('Pengajuan anda sebelumnya ditolak, harap ajukan kembali')
			@endif
			@if ($administrasi_tga->value('repeat_optional'))
				toastr.error('Pengajuan opsional anda sebelumnya ditolak, harap ajukan kembali')
			@endif
		@endif
	</script>
@endsection