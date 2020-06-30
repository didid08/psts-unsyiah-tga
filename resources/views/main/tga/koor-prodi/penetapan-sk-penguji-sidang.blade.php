@extends('main.master')

@section('custom-script')
	<script>
		$("#penetapan-sk-penguji-sidang").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="penetapan-sk-penguji-sidang">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Jumlah Asistensi</th>
							<th scope="col" class="align-middle text-center">Masa Pembimbingan Buku TGA</th>
							<th scope="col" class="align-middle text-center">Lembar Asistensi</th>
							<th scope="col" class="align-middle text-center">Draft Buku TGA</th>
							<th scope="col" class="align-middle text-center">SK Penguji Sidang</th>
							<th scope="col" class="align-middle text-center">Undangan Sidang</th>
							<th scope="col" class="align-middle text-center">Berkas Sidang Lainnya</th>
							<th scope="col" class="align-middle text-center">Opsi 1</th>
							<th scope="col" class="align-middle text-center">Opsi 2</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty = true;
						@endphp

						@foreach ($semua_mahasiswa as $index => $mahasiswa)
							@php
								$isEmpty = false;
								$mhsId = $mahasiswa->user_id;
							@endphp
							<tr>
								<form action="{{ route('main.tga.koor-prodi.penetapan-sk-penguji-sidang.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'accept']) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<input type="text" class="form-control bg-light" readonly="readonly" style="display: inline-block; width: 7em;" value="{{ $jumlah_asistensi_2->$mhsId->content }} kali">
									</td>
									<td class="align-middle text-center">
										<input type="text" class="form-control bg-light" readonly="readonly" style="display: inline-block; width: 7em;" value="{{ $masa_pembimbingan_buku_tga->$mhsId->content }} bulan">
									</td>
									<td class="align-middle text-center">
										<i class="fa fa-check-circle text-green mr-2"></i>
										<a target="_blank" href="{{ route('main.file', ['filename' => $lembar_asistensi_2->$mhsId->content]) }}" class="text-green">Periksa</a>
									</td>
									<td class="align-middle text-center">
										<i class="fa fa-check-circle text-green mr-2"></i>
										<a target="_blank" href="{{ route('main.file', ['filename' => $draft_buku_tga->$mhsId->content]) }}" class="text-green">Periksa</a>
									</td>
									<td class="align-middle text-center">
										<i class="fa fa-check-circle text-green mr-2"></i>
										<a target="_blank" href="{{ route('main.file', ['filename' => $sk_penguji_sidang->$mhsId->content]) }}" class="text-green">Periksa</a>
									</td>
									<td class="align-middle text-center">
										<i class="fa fa-check-circle text-green mr-2"></i>
										<a target="_blank" href="{{ route('main.file', ['filename' => $undangan_sidang->$mhsId->content]) }}" class="text-green">Periksa</a>
									</td>
									<td class="align-middle text-center">
										<i class="fa fa-check-circle text-green mr-2"></i>
										<a target="_blank" href="{{ route('main.file', ['filename' => $berkas_sidang_lainnya->$mhsId->content]) }}" class="text-green">Periksa</a>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success">Terima</button>
									</td>
								</form>
								<form action="{{ route('main.tga.koor-prodi.penetapan-sk-penguji-sidang.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'decline']) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-danger">Tolak</button>
									</td>
								</form>
							</tr>
							@endforeach

							@if ($isEmpty)
								<tr>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-left">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
								</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection