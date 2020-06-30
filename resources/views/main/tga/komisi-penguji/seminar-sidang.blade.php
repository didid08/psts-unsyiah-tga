@extends('main.master')

@section('custom-script')
	<script>
		$("#seminar").dataTable();
		$("#sidang").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<h5 class="mb-4">Seminar</h5>
				<table class="table table-bordered table-striped" id="seminar">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Komisi Penguji</th>
							<th scope="col" class="align-middle text-center">Jadwal Seminar</th>
							<th scope="col" class="align-middle text-center">Opsi</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty = true;
						@endphp

						@foreach ($semua_mahasiswa_1 as $index => $mahasiswa)
							@php
								$mhsId = $mahasiswa->user_id;
							@endphp
							@php
								$isEmpty = false;
							@endphp
							<tr>
								<form action="{{ route('main.tga.komisi-penguji.seminar-sidang.mark-done', ['nim' => $mahasiswa->user->nomor_induk, 'type' => 'seminar']) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<table class="table table-bordered table-striped table-light">
											<tr>
												<td class="align-middle text-left text-bold">Ketua Penguji</td>
												<td class="align-middle text-left">
													{{ $daftar_ketua_penguji->$mhsId->content }}
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Penguji 1</td>
												<td class="align-middle text-left">
													{{ $daftar_penguji_1->$mhsId->content }}
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Penguji 2</td>
												<td class="align-middle text-left">
													{{ $daftar_penguji_2->$mhsId->content }}
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Penguji 3</td>
												<td class="align-middle text-left">
													{{ $daftar_penguji_3->$mhsId->content }}
												</td>
											</tr>
										</table>
									</td>
									<td class="align-middle text-center">
										<table class="table table-bordered table-striped table-light">
											<tr>
												<td class="align-middle text-left text-bold">Hari</td>
												<td class="align-middle text-left">
													{{ \Carbon\Carbon::parse($tgl_seminar->$mhsId->content)->translatedFormat('l') }}
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Tgl</td>
												<td class="align-middle text-left">
													{{ \Carbon\Carbon::parse($tgl_seminar->$mhsId->content)->translatedFormat('d F Y') }}
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Jam</td>
												<td class="align-middle text-left">
													{{ \Carbon\Carbon::parse($jam_seminar->$mhsId->content)->translatedFormat('H:i') }} WIB
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Tempat</td>
												<td class="align-middle text-left">
													{{ $tempat_seminar->$mhsId->content }}
												</td>
											</tr>
										</table>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success text-bold">Jadikan Selesai</button>
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

				<h5 class="mt-4 mb-4">Sidang</h5>
				<table class="table table-bordered table-striped" id="sidang">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Komisi Penguji</th>
							<th scope="col" class="align-middle text-center">Jadwal Sidang</th>
							<th scope="col" class="align-middle text-center">Opsi</th>
						</tr>
					</thead>
					<tbody>
						@php
							$isEmpty2 = true;
						@endphp

						@foreach ($semua_mahasiswa_2 as $index => $mahasiswa)
							@php
								$mhsId2 = $mahasiswa->user_id;
							@endphp
							@php
								$isEmpty2 = false;
							@endphp
							<tr>
								<form action="{{ route('main.tga.komisi-penguji.seminar-sidang.mark-done', ['nim' => $mahasiswa->user->nomor_induk, 'type' => 'sidang']) }}" method="post" style="display: inline;">
									<td class="align-middle text-center">{{ $index+1 }}</td>
									<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
									<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
									<td class="align-middle text-center">
										<table class="table table-bordered table-striped table-light">
											<tr>
												<td class="align-middle text-left text-bold">Ketua Penguji</td>
												<td class="align-middle text-left">
													{{ $daftar_ketua_penguji_2->$mhsId2->content }}
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Penguji 1</td>
												<td class="align-middle text-left">
													{{ $daftar_penguji_1_2->$mhsId2->content }}
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Penguji 2</td>
												<td class="align-middle text-left">
													{{ $daftar_penguji_2_2->$mhsId2->content }}
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Penguji 3</td>
												<td class="align-middle text-left">
													{{ $daftar_penguji_3_2->$mhsId2->content }}
												</td>
											</tr>
										</table>
									</td>
									<td class="align-middle text-center">
										<table class="table table-bordered table-striped table-light">
											<tr>
												<td class="align-middle text-left text-bold">Hari</td>
												<td class="align-middle text-left">
													{{ \Carbon\Carbon::parse($tgl_sidang->$mhsId2->content)->translatedFormat('l') }}
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Tgl</td>
												<td class="align-middle text-left">
													{{ \Carbon\Carbon::parse($tgl_sidang->$mhsId2->content)->translatedFormat('d F Y') }}
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Jam</td>
												<td class="align-middle text-left">
													{{ \Carbon\Carbon::parse($jam_sidang->$mhsId2->content)->translatedFormat('H:i') }} WIB
												</td>
											</tr>
											<tr>
												<td class="align-middle text-left text-bold">Tempat</td>
												<td class="align-middle text-left">
													{{ $tempat_sidang->$mhsId2->content }}
												</td>
											</tr>
										</table>
									</td>
									<td class="align-middle text-center">
										@csrf
										<button type="submit" class="btn btn-sm btn-success text-bold">Jadikan Selesai</button>
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
			</div>
		</div>
	</div>
@endsection