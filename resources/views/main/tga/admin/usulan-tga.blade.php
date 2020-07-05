@extends('main.master')

@section('custom-script')
	<script>
		$("#usulan-tga").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="usulan-tga">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Foto</th>
							<th scope="col" class="align-middle text-center">SPP</th>
							<th scope="col" class="align-middle text-center">KRS</th>
							<th scope="col" class="align-middle text-center">Transkrip</th>
							<th scope="col" class="align-middle text-center">KHS</th>
							<th scope="col" colspan="2" class="align-middle text-center">Opsi</th>
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
								<td class="align-middle text-center">{{ $index+1 }}</td>
								<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
								<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
								<td class="align-middle text-center">
									
									<a target="_blank" href="{{ route('main.file', ['filename' => $foto->$mhsId->content]) }}" class="text-green">Periksa</a>
								</td>
								<td class="align-middle text-center">
									
									<a target="_blank" href="{{ route('main.file', ['filename' => $spp->$mhsId->content]) }}" class="text-green">Periksa</a>
								</td>
								<td class="align-middle text-center">
									
									<a target="_blank" href="{{ route('main.file', ['filename' => $krs->$mhsId->content]) }}" class="text-green">Periksa</a>
								</td>
								<td class="align-middle text-center">
									
									<a target="_blank" href="{{ route('main.file', ['filename' => $khs->$mhsId->content]) }}" class="text-green">Periksa</a>
								</td>
								<td class="align-middle text-center">
									
									<a target="_blank" href="{{ route('main.file', ['filename' => $transkrip_sementara->$mhsId->content]) }}" class="text-green">Periksa</a>
								</td>
								<td class="align-middle text-center">
									<form action="{{ route('main.tga.admin.usulan-tga.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'accept']) }}" method="post" style="display: inline;">
										@csrf
										<button type="submit" class="btn btn-sm btn-success">Kirim ke Koor Prodi</button>
									</form>
								</td>
								<td class="align-middle text-center">
									<form action="{{ route('main.tga.admin.usulan-tga.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'decline']) }}" method="post" style="display: inline;">
										@csrf
										<button type="submit" class="btn btn-sm btn-danger">Tolak</button>
									</form>
								</td>
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
								</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection