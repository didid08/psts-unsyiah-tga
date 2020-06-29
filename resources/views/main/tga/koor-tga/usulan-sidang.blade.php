@extends('main.master')

@section('custom-script')
	<script>
		$("#usulan-sidang").dataTable();
		$("#tetapkan-komisi-penguji").dataTable();
	</script>
@endsection

@section('content')
	@foreach ($semua_mahasiswa as $index => $mahasiswa)
		<div class="modal fade" id="usulkan-komisi-penguji-{{ $mahasiswa->user->nomor_induk }}" aria-modal="true">
	    	<div class="modal-dialog modal-lg">
	      		<div class="modal-content">
	        		<div class="modal-header">
	          			<h4 class="modal-title">Pengusulan Komisi Penguji dan Jadwal Sidang untuk <b>{{ $mahasiswa->user->nama }}</b> ({{ $mahasiswa->user->nomor_induk }})</h4>
	          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	            			<span aria-hidden="true">×</span>
	          			</button>
	        		</div>
	        		<form action="{{ route('main.tga.koor-tga.usulan-sidang.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'usulkan-komisi-penguji']) }}" method="post">
		        		<div class="modal-body">
		        			@csrf
		        			<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th colspan="4" class="text-center">Komisi Penguji</th>
									</tr>
									<tr>
										<th class="text-center">Ketua Penguji</th>
										<th class="text-center">Penguji 1</th>
										<th class="text-center">Penguji 2</th>
										<th class="text-center">Penguji 3</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="text-center">
											<select name="ketua-penguji-2" id="" class="form-control">
												@foreach ($semua_dosen as $dosen)
													<option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
												@endforeach
											</select>
										</td>
										<td class="text-center">
											<select name="penguji-1-2" id="" class="form-control">
												@foreach ($semua_dosen as $dosen)
													<option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
												@endforeach
											</select>
										</td>
										<td class="text-center">
											<select name="penguji-2-2" id="" class="form-control">
												@foreach ($semua_dosen as $dosen)
													<option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
												@endforeach
											</select>
										</td>
										<td class="text-center">
											<select name="penguji-3-2" id="" class="form-control">
												@foreach ($semua_dosen as $dosen)
													<option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
												@endforeach
											</select>
										</td>
									</tr>
								</tbody>
							</table>
							<table class="table table-bordered table-striped mt-3">
								<thead>
									<tr>
										<th colspan="3" class="text-center">Jadwal Sidang</th>
									</tr>
									<tr>
										<th class="text-center">Jam</th>
										<th class="text-center">Tanggal</th>
										<th class="text-center">Tempat</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="text-center">
											<input type="time" class="form-control" name="jam-sidang">
										</td>
										<td class="text-center">
											<input type="date" class="form-control" name="tgl-sidang">
										</td>
										<td class="text-center">
											<select name="tempat-sidang" id="" class="form-control">
												<option>Ruang Sidang 1</option>
												<option>Ruang Sidang 2</option>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
		        		</div>
		        		<div class="modal-footer justify-content-between">
		          			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
		          			<button type="submit" class="btn btn-success">Kirim</button>
				        </div>
			    	</form>
		    	</div>
	    	</div>
	  	</div>
	@endforeach
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<h5 class="mb-4">Periksa Pendaftaran Sidang</h5>
				<table class="table table-bordered table-striped" id="usulan-sidang">
					<thead>
						<tr class="bg-green">
							<th scope="col" class="align-middle text-center">No</th>
							<th scope="col" class="align-middle text-left">Nama</th>
							<th scope="col" class="align-middle text-center">NIM</th>
							<th scope="col" class="align-middle text-center">Jumlah Asistensi</th>
							<th scope="col" class="align-middle text-center">Masa Pembimbingan Buku TGA</th>
							<th scope="col" class="align-middle text-center">Lembar Asistensi</th>
							<th scope="col" class="align-middle text-center">Draft Buku TGA</th>
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
								$mhsId = $mahasiswa->user_id;
							@endphp
							@if (!isset($daftar_ketua_penguji_2->$mhsId) | !isset($daftar_penguji_1_2->$mhsId) | !isset($daftar_penguji_2_2->$mhsId) | !isset($daftar_penguji_3_2->$mhsId))
								@php
									$isEmpty = false;
								@endphp
								<tr>
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
										@csrf
										<button type="button" class="btn btn-sm btn-success text-bold" data-toggle="modal" data-target="#usulkan-komisi-penguji-{{ $mahasiswa->user->nomor_induk }}">Usulkan Komisi Penguji</button>
									</td>
									<td class="align-middle text-center">
										<form action="{{ route('main.tga.koor-tga.usulan-sidang.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'decline']) }}" method="post" style="display: inline;">
											@csrf
											<button type="submit" class="btn btn-sm btn-danger">Tolak</button>
										</form>
									</td>
								</tr>
							@endif
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
							</tr>
						@endif
					</tbody>
				</table>
				
				<h5 class="mt-4 mb-4">Tetapkan Komisi Penguji dan Jadwal Sidang <i>(Sudah disetujui oleh komisi penguji)</i></h5>
				<table class="table table-bordered table-striped" id="tetapkan-komisi-penguji">
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

						@foreach ($semua_mahasiswa as $index => $mahasiswa)
							@php
								$mhsId2 = $mahasiswa->user_id;
							@endphp
							@if (isset($daftar_ketua_penguji_2->$mhsId2) && isset($daftar_penguji_1_2->$mhsId2) && isset($daftar_penguji_2_2->$mhsId2) && isset($daftar_penguji_3_2->$mhsId2))
								@if ($daftar_ketua_penguji_2->$mhsId2->verified == true && $daftar_penguji_1_2->$mhsId2->verified == true && $daftar_penguji_2_2->$mhsId2->verified == true && $daftar_penguji_3_2->$mhsId2->verified == true)
									@php
										$isEmpty2 = false;
									@endphp
									<tr>
										<form action="{{ route('main.tga.koor-tga.usulan-sidang.process', ['nim' => $mahasiswa->user->nomor_induk, 'opsi' => 'tetapkan-komisi-penguji']) }}" method="post" style="display: inline;">
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
												<button type="submit" class="btn btn-sm btn-success text-bold">Tetapkan</button>
											</td>
										</form>
									</tr>
								@endif
							@endif
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