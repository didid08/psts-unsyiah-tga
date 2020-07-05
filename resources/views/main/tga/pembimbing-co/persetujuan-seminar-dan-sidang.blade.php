@extends('main.master')

@section('custom-script')
	<script>
		$("#persetujuan-diseminarkan").dataTable();
		$("#persetujuan-disidangkan").dataTable();
		$("#penerimaan-berkas-hasil-sidang").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<h5 class="mb-4">Persetujuan Diseminarkan</h5>
				<table class="table table-bordered table-striped" id="persetujuan-diseminarkan">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Jumlah Asistensi</th>
							<th scope="col" class="align-middle text-center">Masa Pembimbingan Proposal</th>
							<th scope="col" class="align-middle text-center">Opsi</th>
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
								<form action="{{ route('main.tga.pembimbing-co.persetujuan-seminar-dan-sidang.process', ['nim' => $mahasiswa->user->nomor_induk, 'type' => 'proposal']) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<input type="number" name="jumlah-asistensi" class="form-control" min="8" style="display: inline-block; width: 5em;"><span class="ml-2">kali</span>
									</td>
									<td class="align-middle text-center">
										<input type="number" name="masa-pembimbingan-proposal" class="form-control" style="display: inline-block; width: 5em;"><span class="ml-2">bulan</span>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success">Simpan</button>
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
								</tr>
							@endif
					</tbody>
				</table>

				<h5 class="mt-4 mb-4">Persetujuan Disidangkan</h5>
				<table class="table table-bordered table-striped" id="persetujuan-disidangkan">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Jumlah Asistensi</th>
							<th scope="col" class="align-middle text-center">Masa Pembimbingan Buku TGA</th>
							<th scope="col" class="align-middle text-center">Opsi</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty2 = true;
						@endphp

						@foreach ($semua_mahasiswa_2 as $index => $mahasiswa)
							@php
								$isEmpty2 = false;
								$mhsId2 = $mahasiswa->user_id;
							@endphp
							<tr>
								<form action="{{ route('main.tga.pembimbing-co.persetujuan-seminar-dan-sidang.process', ['nim' => $mahasiswa->user->nomor_induk, 'type' => 'buku-tga']) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<input type="number" name="jumlah-asistensi-2" class="form-control" min="8" style="display: inline-block; width: 5em;"><span class="ml-2">kali</span>
									</td>
									<td class="align-middle text-center">
										<input type="number" name="masa-pembimbingan-buku-tga" class="form-control" style="display: inline-block; width: 5em;"><span class="ml-2">bulan</span>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success">Simpan</button>
									</td>
								</form>
							</tr>
							@endforeach

							@if ($isEmpty2)
								<tr>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-left">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
								</tr>
							@endif
					</tbody>
				</table>

				<h5 class="mt-4 mb-4">Penerimaan Berkas Hasil Sidang</h5>
				<table class="table table-bordered table-striped" id="penerimaan-berkas-hasil-sidang">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">SK</th>
							<th scope="col" class="align-middle text-center">Lembar Pengesahan</th>
							<th scope="col" class="align-middle text-center">Buku TGA</th>
							<th scope="col" class="align-middle text-center">Opsi 1</th>
							<th scope="col" class="align-middle text-center">Opsi 2</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty3 = true;
						@endphp

						@foreach ($semua_mahasiswa_3 as $index => $mahasiswa)
							@php
								$isEmpty3 = false;
								$mhsId3 = $mahasiswa->user_id;
							@endphp
							<tr>
								<form action="{{ route('main.tga.pembimbing-co.persetujuan-seminar-dan-sidang.process', ['nim' => $mahasiswa->user->nomor_induk, 'type' => 'lembar-pengesahan', 'opsi' => 'accept']) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										
										<a target="_blank" href="{{ route('main.file', ['filename' => $sk_penguji_sidang->$mhsId3->content]) }}" class="text-green">Lihat</a>
									</td>
									<td class="align-middle text-center">
										
										<a target="_blank" href="{{ route('main.file', ['filename' => $lembar_pengesahan->$mhsId3->content]) }}" class="text-green">Periksa</a>
									</td>
									<td class="align-middle text-center">
										
										<a target="_blank" href="{{ route('main.file', ['filename' => $buku_tga->$mhsId3->content]) }}" class="text-green">Lihat</a>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success">Terima</button>
									</td>
								</form>
								<td class="align-middle text-center">
									<form action="{{ route('main.tga.pembimbing-co.persetujuan-seminar-dan-sidang.process', ['nim' => $mahasiswa->user->nomor_induk, 'type' => 'lembar-pengesahan', 'opsi' => 'decline']) }}" method="post" style="display: inline;">
										@csrf
										<button type="submit" class="btn btn-sm btn-danger">Tolak</button>
									</form>
								</td>
							</tr>
							@endforeach

							@if ($isEmpty3)
								<tr>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-left">--</td>
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