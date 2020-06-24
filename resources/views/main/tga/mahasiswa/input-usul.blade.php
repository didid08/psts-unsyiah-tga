@extends('main.master')

@section('content')
	<div class="container">
		<div class="card height-auto">
			<div class="card-title text-bold pl-4 pr-4 pt-4" style="font-size: 1.2em;">
				LEMBAR INPUT DATA USULAN SKRIPSI/TGA (TUGAS AKHIR) MAHASISWA<br>
				PRODI S1 TEKNIK SIPIL - UNSYIAH
			</div>
			<div class="card-body" style="overflow-x: auto;">
				<form action="{{ route('main.tga.mahasiswa.input-usul.process') }}" method="post" enctype="multipart/form-data">
					@method('PUT')
					@csrf

					<div class="row form-group">
						<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
							<table class="table table-bordered table-striped">
								<thead>
									<tr class="bg-info">
										<th scope="col">NIM</th>
										<th scope="col" class="align-middle">{{ $nim }}</th>
									</tr>
									<tr class="bg-info">
										<th scope="col">Nama Mahasiswa</th>
										<th scope="col" class="align-middle">{{ $nama }}</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Bidang Konsentrasi</td>
										<td>
											<select name="bidang" class="form-control">
												@foreach ($semua_bidang as $bidang)
													<option{{ $input_value['bidang'] != null ? ($input_value['bidang'] == $bidang->nama ? ' selected' : '') : '' }}>{{ $bidang->nama }}</option>
												@endforeach
											</select>
										</td>
									</tr>
									<tr>
										<td>Tempat Lahir</td>
										<td><input type="text" name="tempat-lahir" class="form-control"{!! $input_value['tempat-lahir'] != null ? ' value="'.$input_value['tempat-lahir'].'"' : '' !!} placeholder="Masukkan Tempat Lahir"></td>
									</tr>
									<tr>
										<td>Tanggal Lahir</td>
										<td><input type="date" name="tgl-lahir" class="form-control"{!! $input_value['tgl-lahir'] != null ? ' value="'.$input_value['tgl-lahir'].'"' : '' !!} placeholder="Masukkan Tanggal Lahir"></td>
									</tr>
									<tr>
										<td>Agama</td>
										<td>
											<select name="agama" class="form-control">
												<option{{ $input_value['agama'] != null ? ($input_value['agama'] == 'Islam' ? ' selected' : '') : '' }}>Islam</option>
												<option{{ $input_value['agama'] != null ? ($input_value['agama'] == 'Kristen Protestan' ? ' selected' : '') : '' }}>Kristen Protestan</option>
												<option{{ $input_value['agama'] != null ? ($input_value['agama'] == 'Katolik' ? ' selected' : '') : '' }}>Katolik</option>
												<option{{ $input_value['agama'] != null ? ($input_value['agama'] == 'Hindu' ? ' selected' : '') : '' }}>Hindu</option>
												<option{{ $input_value['agama'] != null ? ($input_value['agama'] == 'Buddha' ? ' selected' : '') : '' }}>Buddha</option>
												<option{{ $input_value['agama'] != null ? ($input_value['agama'] == 'Kong Hu Cu' ? ' selected' : '') : '' }}>Kong Hu Cu</option>
												<option{{ $input_value['agama'] != null ? ($input_value['agama'] == 'Lainnya' ? ' selected' : '') : '' }}>Lainnya</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Jenis Kelamin</td>
										<td>
											<select name="gender" class="form-control">
												<option{{ $input_value['gender'] != null ? ($input_value['gender'] == 'Laki-laki' ? ' selected' : '') : '' }}>Laki-laki</option>
												<option{{ $input_value['gender'] != null ? ($input_value['gender'] == 'Perempuan' ? ' selected' : '') : '' }}>Perempuan</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>No HP Aktif</td>
										<td><input type="text" name="no-hp" class="form-control"{!! $input_value['no-hp'] != null ? ' value="'.$input_value['no-hp'].'"' : '' !!} placeholder="Masukkan Nomor HP"></td>
									</tr>
									<tr>
										<td>Email Aktif</td>
										<td><input type="email" name="email" class="form-control"{!! $input_value['email'] != null ? ' value="'.$input_value['email'].'"' : '' !!} placeholder="Masukkan Email"></td>
									</tr>
									<tr>
										<td>Judul TGA</td>
										<td>
											<textarea name="judul-tga" class="form-control" placeholder="Masukkan Judul TGA">{{ $input_value['judul-tga'] != null ? $input_value['judul-tga'] : '' }}</textarea>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="co-xl-7 col-lg-7 col-md-7 col-sm-12">
							<table class="table table-bordered table-striped">
								<tbody>
									<tr>
										<td>Tahun Ajaran</td>
										<td colspan="3">
											<select name="tahun-ajaran" class="form-control">
												<option{{ $input_value['tahun-ajaran'] != null ? ($input_value['tahun-ajaran'] == '2018/2019' ? ' selected' : '') : '' }}>2018/2019</option>
												<option{{ $input_value['tahun-ajaran'] != null ? ($input_value['tahun-ajaran'] == '2019/2020' ? ' selected' : '') : '' }}>2019/2020</option>
												<option{{ $input_value['tahun-ajaran'] != null ? ($input_value['tahun-ajaran'] == '2020/2021' ? ' selected' : '') : '' }}>2020/2021</option>
											</select>
										</td>
									</tr>
									<!--<tr>
										<td>Nama Pembimbing</td>
										<td colspan="3">
											<select name="nama-pembimbing" class="form-control">
												@foreach ($semua_dosen as $dosen)
													<option{{ $input_value['nama-pembimbing'] != null ? ($input_value['nama-pembimbing'] == $dosen->nama ? ' selected' : '') : '' }}>{{ $dosen->nama }}</option>
												@endforeach
											</select>
										</td>
									</tr>
									<tr>
										<td>Nama Co. Pembimbing</td>
										<td colspan="3">
											<select name="nama-co-pembimbing" class="form-control">
												@foreach ($semua_dosen as $dosen)
													<option{{ $input_value['nama-co-pembimbing'] != null ? ($input_value['nama-co-pembimbing'] == $dosen->nama ? ' selected' : '') : '' }}>{{ $dosen->nama }}</option>
												@endforeach
											</select>
										</td>
									</tr>-->

									<tr>
										<td>Nama Pembimbing</td>
										<td colspan="3">
											<input type="text" class="form-control" value="{{ $input_value['nama-pembimbing'] }}" placeholder="Diisi oleh admin" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td>Nama Co. Pembimbing</td>
										<td colspan="3">
											<input type="text" class="form-control" value="{{ $input_value['nama-co-pembimbing'] }}" placeholder="Diisi oleh admin" readonly="readonly">
										</td>
									</tr>

									<tr>
										<td>Dosen Wali (PA)</td>
										<td colspan="3">
											<select name="dosen-wali" class="form-control">
												@foreach ($semua_dosen as $dosen)
													<option{{ $input_value['dosen-wali'] != null ? ($input_value['dosen-wali'] == $dosen->nama ? ' selected' : '') : '' }}>{{ $dosen->nama }}</option>
												@endforeach
											</select>
										</td>
									</tr>
									<tr>
										<td>Ketua Bidang</td>
										<td colspan="3">
											<select name="ketua-bidang" class="form-control">
												@foreach ($semua_dosen as $dosen)
													@if ($dosen->bidang_id != null)
														<option{{ $input_value['ketua-bidang'] != null ? ($input_value['ketua-bidang'] == $dosen->nama ? ' selected' : '') : '' }}>{{ $dosen->nama }}</option>
													@endif
												@endforeach
											</select>
										</td>
									</tr>
									<tr>
										<td>Dana Pendidikan</td>
										<td>
											<select name="dana-pendidikan" class="form-control" id="dana-pendidikan">
												<option{{ $input_value['dana-pendidikan'] != null ? ($input_value['dana-pendidikan'] == 'Dana Sendiri' ? ' selected' : '') : '' }}>Biaya Sendiri</option>
												<option{{ $input_value['dana-pendidikan'] != null ? ($input_value['dana-pendidikan'] == 'Beasiswa' ? ' selected' : '') : '' }}>Beasiswa</option>
											</select>
										</td>
										<td>Nama Beasiswa</td>
										<td><input type="text" class="form-control" id="nama-beasiswa"{!! $input_value['dana-pendidikan'] == 'Beasiswa' ? ' value="'.$input_value['nama-beasiswa'].'" name="nama-beasiswa" placeholder="Masukkan Nama Beasiswa"' : ' disabled="disabled"' !!}></td>
									</tr>
									<tr style="background-color: rgba(255,0,0,0.1);">
										<td>No. Disposisi</td>
										<td>
											<input type="text" class="form-control" placeholder="Diisi oleh admin" readonly="readonly">
										</td>
										<td>Tgl Disposisi</td>
										<td>
											<input type="text" class="form-control" placeholder="Diisi oleh admin" readonly="readonly">
										</td>
									</tr>
									<tr style="background-color: rgba(255,0,0,0.1);">
										<td>No. SK Pembimbing</td>
										<td>
											<input type="text" class="form-control" placeholder="Diisi oleh admin" readonly="readonly">
										</td>
										<td>Tgl SK Pembimbing</td>
										<td>
											<input type="text" class="form-control" placeholder="Diisi oleh admin" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td colspan="3" class="align-middle text-center">
											<table width="100%">
												<tr>
													<td class="align-middle text-center">
														SPP
													</td>
													<td class="align-middle text-center">
														@if ($progress == 1)
															<input type="file" name="spp" id="spp" accept="application/pdf">															
														@else
															<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada
														@endif
													</td>
												</tr>
												<tr>
													<td class="align-middle text-center">
														KRS
													</td>
													<td class="align-middle text-center">
														@if ($progress == 1)
															<input type="file" name="krs" id="krs" accept="application/pdf">
														@else
															<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada
														@endif
													</td>
												</tr>
												<tr>
													<td class="align-middle text-center">
														KHS
													</td>
													<td class="align-middle text-center">
														@if ($progress == 1)
															<input type="file" name="khs" id="khs" accept="application/pdf">
														@else
															<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada
														@endif
													</td>
												</tr>
												<tr>
													<td class="align-middle text-center">
														Transkrip Sementara
													</td>
													<td class="align-middle text-center">
														@if ($progress == 1)
															<input type="file" name="transkrip-sementara" id="transkrip-sementara" accept="application/pdf">
														@else
															<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada
														@endif
													</td>
												</tr>
											</table>	
										</td>
										<td class="align-top text-center">
											<button type="submit" class="btn btn-block btn-success text-bold">Simpan</button>
											<a href="{{ route('main.tga.disposisi') }}" class="btn btn-block btn-secondary">Kembali ke disposisi</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('custom-script')
	<script>
		var nama_beasiswa = null
		@if ($input_value['nama-beasiswa'] != null)
			nama_beasiswa = '{{ $input_value['nama-beasiswa'] }}'
		@endif
		$("#dana-pendidikan").on('change', function () {
			if (this.value == 'Beasiswa') {
				$("#nama-beasiswa").attr('name', 'nama-beasiswa');

				if (nama_beasiswa != null) {
					$("#nama-beasiswa").attr('value', nama_beasiswa);
				}

				$("#nama-beasiswa").attr('placeholder', 'Masukkan Nama Beasiswa');				

				$("#nama-beasiswa").removeAttr('disabled');
			}else {
				$("#nama-beasiswa").attr('disabled', 'disabled');
				$("#nama-beasiswa").removeAttr('name');
				$("#nama-beasiswa").removeAttr('value');
				$("#nama-beasiswa").removeAttr('placeholder');
			}
		});
	</script>
@endsection