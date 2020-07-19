@extends('main.master')

@section('custom-script')
	<script>
		$("#data-mahasiswa").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				@if (isset($get_data))
					<table class="table table-bordered table-striped" id="data-mahasiswa">
						<thead>
							<tr class="bg-light">
								<th scope="col" class="align-middle text-center">No</th>
								<th scope="col" class="align-middle text-center">Kategori</th>
								<th scope="col" class="align-middle text-left">Nama Data</th>
								<th scope="col" class="align-middle text-center">Isi</th>
								<th scope="col" class="align-middle text-center">Terakhir Diperbarui</th>
							</tr>
						</thead>
						<tbody>
							@php
								$isEmpty = true;
							@endphp

							@foreach ($semua_data as $index => $value)
								@php
									$isEmpty = false;
								@endphp
								<tr>
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ ucwords(str_replace('_', ' ', $value->category)) }}</td>
									<td class="align-middle text-left">{{ $value->display_name }}</td>
									<td class="align-middle text-center">
										@if ($value->type == 'file')
											<a class="btn btn-sm btn-info" href="{{ route('main.file', ['filename' => $value->content]) }}">Unduh</a>
										@else
											{{ $value->content }}
										@endif
									</td>
									<td class="align-middle text-center">{{ \Carbon\Carbon::parse($value->updated_at)->translatedFormat('d/m/Y H:i') }}</td>
								</tr>
							@endforeach

							@if ($isEmpty)
								<tr>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-left">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
								</tr>
							@endif
						</tbody>
					</table>
				@else
					<table class="table table-bordered table-striped" id="data-mahasiswa">
						<thead>
							<tr class="bg-info">
								<th scope="col" class="align-middle text-center">No</th>
								<th scope="col" class="align-middle text-left">Nama</th>
								<th scope="col" class="align-middle text-center">NIM</th>
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
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->nomor_induk }}</td>
									<td class="align-middle text-center"><a target="_blank" class="btn btn-sm btn-info" href="{{ route('main.admin.data-mahasiswa', ['nim' => $mahasiswa->nomor_induk]) }}">Lihat Data</a></td>
								</tr>
							@endforeach

							@if ($isEmpty)
								<tr>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-left">--</td>
									<td class="align-middle text-center">--</td>
									<td class="align-middle text-center">--</td>
								</tr>
							@endif
						</tbody>
					</table>
				@endif
			</div>
		</div>
	</div>
@endsection