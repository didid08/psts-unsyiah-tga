@extends('main.master')

@section('custom-script')
	<script>
		$("#usulan-sk-pembimbing").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" id="usulan-sk-pembimbing">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Pembimbing</th>
							<th scope="col" class="align-middle text-center">Co Pembimbing</th>
							<th scope="col" class="align-middle text-center">SK Penunjukan Pembimbing</th>
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
								<form action="{{ route('main.tga.update-progress', ['nim' => $mahasiswa->user->nomor_induk]) }}" method="post" style="display: inline;" enctype="multipart/form-data">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<input type="text" class="form-control bg-light" value="{{ $co_pembimbing->$mhsId->content }}" readonly="readonly">
									</td>
									<td class="align-middle text-center">
										<input type="text" class="form-control bg-light" value="{{ $pembimbing->$mhsId->content }}" readonly="readonly">
									</td>
									<td class="align-middle text-center">
										<input type="file" name="sk-pembimbing" accept="application/pdf">
									</td>
									<td class="align-middle text-center">	
										@method('PUT')
										@csrf
										<input type="hidden" name="progress" value="6">
										<input type="hidden" name="bypass-key" value="{{ $mahasiswa->bypass_key }}">
										<button type="submit" class="btn btn-sm btn-success">Kirim ke Koor Prodi</button>
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
								</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection