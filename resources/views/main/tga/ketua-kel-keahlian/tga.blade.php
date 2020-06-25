@extends('main.master')

@section('custom-script')
	<script>
		$("#usul-pembimbing").dataTable();
		$("#tetapkan-pembimbing").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<h5>Usul Pembimbing</h5>
				<table class="table table-bordered table-striped" id="usul-pembimbing">
					<thead>
						<tr class="bg-green">
							<th class="align-middle text-center">No</th>
							<th class="align-middle text-left">Nama</th>
							<th class="align-middle text-center">NIM</th>
							<th class="align-middle text-center">Pembimbing</th>
							<th class="align-middle text-center">Co Pembimbing</th>
							<th class="align-middle text-center">Rencana Judul TGA</th>
							<th class="align-middle text-center">Opsi</th>
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
								<form action="{{ route('usul.pembimbing-co', ['nim' => $mahasiswa->user->nomor_induk]) }}" method="post">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										@csrf
										<select name="pembimbing" id="" class="form-control">
											<option value="empty">Pilih pembimbing</option>
											@foreach ($dosen_pembimbing as $nip => $dosen)
												<option value="{{ $nip }}">{{ $dosen }}</option>
											@endforeach
										</select>
									</td>
									<td class="align-middle text-center">
										<select name="co-pembimbing" id="" class="form-control">
											<option value="empty">Pilih Co Pembimbing</option>
											@foreach ($dosen_co_pembimbing as $nip => $dosen)
												<option value="{{ $nip }}">{{ $dosen }}</option>
											@endforeach
										</select>
									</td>
									<td class="align-middle text-center">
										<textarea class="form-control bg-light" readonly="readonly">{{ $judul_tga->$mhsId->content }}</textarea>
									</td>
									<td class="align-middle text-center">
										<button type="submit" class="btn btn-sm btn-success text-bold">Kirim ke email dosen</button>
										{{--<a href="#" class="btn btn-sm btn-danger mt-2">Tolak judul</a>--}}
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
				<h5 class="mt-4">Jika Pembimbing Sudah Setuju</h5>
				<table class="table table-bordered table-striped" id="tetapkan-pembimbing">
					<thead>
						<tr class="bg-green">
							<th class="align-middle text-center">No</th>
							<th class="align-middle text-left">Nama</th>
							<th class="align-middle text-center">NIM</th>
							<th class="align-middle text-center">Pembimbing</th>
							<th class="align-middle text-center">Co Pembimbing</th>
							<th class="align-middle text-center">Rencana Judul TGA</th>
							<th class="align-middle text-center">Opsi</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty2 = true;
						@endphp

						@foreach ($semua_mahasiswa as $index => $mahasiswa)
							@php
								$isEmpty2= false;
								$mhsId2 = $mahasiswa->user_id;
							@endphp
							<tr>
								<td class="align-middle text-center">{{ $index+1 }}</td>
								<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
								<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
								<td class="align-middle text-center">
									<input type="text" class="form-control bg-light" value="" readonly="readonly">
								</td>
								<td class="align-middle text-center">
									<input type="text" class="form-control bg-light" value="" readonly="readonly">
								</td>
								<td class="align-middle text-center">
									<textarea class="form-control bg-light" readonly="readonly">{{ $judul_tga->$mhsId2->content }}</textarea>
								</td>
								<td class="align-middle text-center">
									<a href="#" class="btn btn-sm btn-success text-bold">Kirim ke admin</a>
								</td>
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
								<td class="align-middle text-center">--</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection