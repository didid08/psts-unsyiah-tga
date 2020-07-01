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

@section('content')
	@if ($category != 'mahasiswa' && $nim == null)
		<div class="container">
			<div class="card">
				<div class="card-body">
					<table class="table table-bordered table-striped" id="daftar-mahasiswa">
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
							@foreach ($disposisi as $index => $value)
								@php
									$empty = false;
								@endphp
								<tr>
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle">{{ $value->user->nama }}</td>
									<td class="align-middle text-center">{{ $value->user->nomor_induk }}</td>
									<td class="align-middle text-center"><a href="{{ route('main.tga.disposisi', ['nim' => $value->user->nomor_induk ]) }}" class="btn btn-info">Pilih</a></td>
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
		<div class="container">
			@include('main.tga.disposisi.function')
			<div class="card">
				<div class="card-body" style="overflow-x: auto;">
					<table class="table table-bordered table-striped table-secondary table-responsive">
						<thead>
							<tr class="bg-light">
								<th colspan="11" class="align-middle" style="background-color: #f1f2f6;">

									<table class="table-borderless" width="100%">
										<tr class="" style="background-color: #f1f2f6;">
											<td class="align-middle text-center">
												<img src="{{ asset('dist/img/logo-unsyiah.png') }}" alt="Universitas Syiah Kuala" width="110em">	
											</td>
											<td class="align-middle text-left">
												LEMBAR DISPOSISI TUGAS AKHIR - JURUSAN TEKNIK SIPIL<br>
												FAKULTAS TEKNIK UNIVERSITAS SYIAH KUALA<br>
												<span class="mr-2">No: </span><input type="text" class="form-control bg-light mt-2"{!! $disposisi->no_disposisi != null ? ' value="'.$disposisi->no_disposisi.'"' : '' !!} placeholder="Belum ada nomor" style="width: 18em; display: inline; height: 2.2em;" readonly="readonly">
												<br>
												<span class="mr-2">Tgl: </span><input type="text" class="form-control bg-light mt-2"{!! $disposisi->tgl_disposisi != null ? ' value="'.date('d-m-Y', strtotime($disposisi->tgl_disposisi)).'"' : '' !!} placeholder="Belum ada tanggal" style="width: 18em; display: inline; height: 2.2em;" readonly="readonly">
											</td>
											<td></td><td></td>
											<td class="align-middle text-center">
												<a href="{{ route('main.tga.disposisi.cetak', ['nim' => $mahasiswa->nomor_induk]) }}" class="btn btn-sm btn-outline-secondary text-bold"><i class="fa fa-download"></i>&nbsp;&nbsp;Cetak Disposisi</a>												
											</td>
										</tr>
									</table>

								</th>
							</tr>
							<tr class="" style="background-color: #f5f6fa">
								<th rowspan="2" class="text-center align-middle">No</th>
								<th class="text-center align-middle">Nama</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa->nama }}</th>
								<th class="text-center align-middle">Bidang</th>
								<th class="align-middle font-weight-normal">{{ isset($data->bidang) ? $data->bidang->content : '--' }}</th>
								<th colspan="6" class="text-center align-middle">Progress</th>
							</tr>
							<tr class="" style="background-color: #f5f6fa">
								<th class="text-center align-middle">NIM</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa->nomor_induk }}</th>
								<th class="text-center align-middle">Nomor HP</th>
								<th class="align-middle font-weight-normal">{{ isset($data->no_hp) ? $data->no_hp->content : '--' }}</th>
								<th class="text-center align-middle">Mhs</th>
								<th class="text-center align-middle">Admin</th>
								<th class="text-center align-middle">Koor Prodi</th>
								<th class="text-center align-middle">Ketua Kel.Keahlian</th>
								<th class="text-center align-middle">Pembimbing (Co)</th>
								<th class="text-center align-middle">Koor TGA</th>
							</tr>
						</thead>
						<tbody>
							@php
								if (isset($role->mhs)) {
									$folder = 'mhs';
								} else {
									$folder = 'read-only';
								}
							@endphp
							{{-- Tahap 1 --}}
							<tr class="{{ background(1, 3, $disposisi) }}">
								<td><b>1</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-1')
								</td>
								<td class="text-center align-middle">
									{!! progress(1, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(2, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(3, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 2 --}}
							<tr class="{{ background(4, 4, $disposisi) }}">
								<td><b>2</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-2')
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(4, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 3 --}}
							<tr class="{{ background(5, 6, $disposisi) }}">
								<td><b>3</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-3')
								</td>
								<td class="text-center align-middle">
								</td>
								<td class="text-center align-middle">
									{!! progress(5, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(6, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							@if ($disposisi->progress >= 26 &&  $disposisi->progress_optional < 6)
								{{-- Tahap 3 (opsional) [Inactive] --}}
								<tr>
									<td></td>
									<td colspan="4">
										@include('main.tga.disposisi.'.$folder.'.tahap-3-opsional-1')
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
										@include('main.tga.disposisi.'.$folder.'.tahap-3-opsional-2')
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
								<tr class="{{ backgroundOptional(1, 3, $disposisi) }}">
									<td></td>
									<td colspan="4">
										@include('main.tga.disposisi.'.$folder.'.tahap-3-opsional-1')
									</td>
									<td class="text-center align-middle">
										{!! progressOptional(1, $disposisi) !!}
									</td>
									<td class="text-center align-middle">
										{!! progressOptional(2, $disposisi) !!}
									</td>
									<td class="text-center align-middle">
										{!! progressOptional(3, $disposisi) !!}
									</td>
									<td class="text-center align-middle"></td>
									<td class="text-center align-middle"></td>
									<td class="text-center align-middle"></td>
								</tr>

								{{-- Tahap 3 (opsional) bagian 2 --}}
								<tr class="{{ backgroundOptional(4, 5, $disposisi) }}">
									<td></td>
									<td colspan="4">
										@include('main.tga.disposisi.'.$folder.'.tahap-3-opsional-2')
									</td>
									<td class="text-center align-middle">
									</td>
									<td class="text-center align-middle">
										{!! progressOptional(4, $disposisi) !!}
									</td>
									<td class="text-center align-middle">
										{!! progressOptional(5, $disposisi) !!}
									</td>
									<td class="text-center align-middle"></td>
									<td class="text-center align-middle"></td>
									<td class="text-center align-middle"></td>
								</tr>
							@endif
							
							{{-- Tahap 4 --}}
							<tr class="{{ background(7, 7, $disposisi) }}">
								<td><b>4</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-4')
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(7, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 5 --}}
							<tr class="{{ background(8, 10, $disposisi) }}">
								<td><b>5</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-5')
								</td>
								<td class="text-center align-middle">
									{!! progress(8, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(9, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(10, $disposisi) !!}
								</td>
							</tr>			

							{{-- Tahap 6 --}}
							<tr class="{{ background(11, 12, $disposisi) }}">
								<td><b>6</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-6')
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(11, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(12, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 7 --}}
							<tr class="{{ background(13, 14, $disposisi) }}">
								<td><b>7</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-7')
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 8 --}}
							<tr class="{{ background(15, 17, $disposisi) }}">
								<td><b>8</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-8')
								</td>
								<td class="text-center align-middle">
									{!! progress(15, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(16, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(17, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							
							{{-- Tahap 9 --}}
							<tr class="{{ background(18, 19, $disposisi) }}">
								<td><b>9</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-9')
								</td>
								<td class="text-center align-middle">
									{!! progress(18, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(19, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 10 --}}
							<tr class="{{ background(20, 20, $disposisi) }}">
								<td><b>10</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-10')
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(20, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 11 --}}
							<tr class="{{ background(21, 23, $disposisi) }}">
								<td><b>11</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-11')
								</td>
								<td class="text-center align-middle">
									{!! progress(21, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(22, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(23, $disposisi) !!}
								</td>
							</tr>

							{{-- Tahap 12 --}}
							<tr class="{{ background(24, 25, $disposisi) }}">
								<td><b>12</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-12')
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(24, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(25, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 13 --}}
							<tr class="{{ background(26, 27, $disposisi) }}">
								<td><b>13</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-13')
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 14 --}}
							<tr class="{{ background(28, 30, $disposisi) }}">
								<td><b>14</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-14')
								</td>
								<td class="text-center align-middle">
									{!! progress(28, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(29, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(30, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 15 --}}
							<tr class="{{ background(31, 32, $disposisi) }}">
								<td><b>15</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-15')
								</td>
								<td class="text-center align-middle">
									{!! progress(31, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle">
									{!! progress(32, $disposisi) !!}
								</td>
								<td class="text-center align-middle"></td>
							</tr>

							{{-- Tahap 16 --}}
							<tr class="{{ background(33, 35, $disposisi) }}">
								<td><b>16</b></td>
								<td colspan="4">
									@include('main.tga.disposisi.'.$folder.'.tahap-16')
								</td>
								<td class="text-center align-middle">
									{!! progress(33, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(34, $disposisi) !!}
								</td>
								<td class="text-center align-middle">
									{!! progress(35, $disposisi) !!}
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

		$("#daftar-mahasiswa").dataTable();
	</script>
@endsection