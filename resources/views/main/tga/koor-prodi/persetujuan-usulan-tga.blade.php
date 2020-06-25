@extends('main.master')

@section('custom-script')
	<script>
		$("#persetujuan-usulan-tga").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="persetujuan-usulan-tga">
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
									<i class="fa fa-check-circle text-green mr-2"></i>
									<a target="_blank" href="{{ route('main.file', ['filename' => $foto->$mhsId->content]) }}" class="text-green">Periksa</a>
								</td>
								<td class="align-middle text-center">
									<i class="fa fa-check-circle text-green mr-2"></i>
									<a target="_blank" href="{{ route('main.file', ['filename' => $spp->$mhsId->content]) }}" class="text-green">Periksa</a>
								</td>
								<td class="align-middle text-center">
									<i class="fa fa-check-circle text-green mr-2"></i>
									<a target="_blank" href="{{ route('main.file', ['filename' => $krs->$mhsId->content]) }}" class="text-green">Periksa</a>
								</td>
								<td class="align-middle text-center">
									<i class="fa fa-check-circle text-green mr-2"></i>
									<a target="_blank" href="{{ route('main.file', ['filename' => $khs->$mhsId->content]) }}" class="text-green">Periksa</a>
								</td>
								<td class="align-middle text-center">
									<i class="fa fa-check-circle text-green mr-2"></i>
									<a target="_blank" href="{{ route('main.file', ['filename' => $transkrip_sementara->$mhsId->content]) }}" class="text-green">Periksa</a>
								</td>
								<td class="align-middle text-center">
									<a href="{{ route('main.tga.ubah-progress', ['nim' => $mahasiswa->user->nomor_induk, 'progress' => 4, 'opsi' => 'verified']) }}" class="btn btn-sm btn-success">Terima</a>
								</td>
								<td class="align-middle text-center">
									<a href="{{ route('main.tga.ubah-progress', ['nim' => $mahasiswa->user->nomor_induk, 'progress' => 1]) }}" class="btn btn-sm btn-danger">Tolak</a>
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