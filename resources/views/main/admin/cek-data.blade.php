@extends('main.master')

@section('custom-script')
	<script>
		$("#select-nim").select2();

		$("input[type=checkbox]").attr('disabled', 'disabled');
		@if (!isset($mhs))
			$("tbody").addClass('text-muted');
			$(".cetak-btn").attr('disabled', 'disabled');
		@else
			$("#refresh-btn").click(function () {
				location.reload(false);
			});
		@endif
	</script>
@endsection

@section('breadcumb')
	@if (isset($mhs))
		<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
		<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
		<li class="breadcrumb-item active">Data {{ $mhs->nama }}</li>
	@else
		<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
		<li class="breadcrumb-item active">{{ $subtitle }}</li>
	@endif
@endsection

@section('content')
	@if (isset($mhs))
		<div class="modal fade" id="rubah-password" aria-modal="true">
			<div class="modal-dialog modal-lg">
		  		<div class="modal-content">
		    		<div class="modal-header">
		      			<h4 class="modal-title">Ubah Password {{ $mhs->nama }} ({{ $mhs->nomor_induk }})</h4>
		      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        			<span aria-hidden="true">×</span>
		      			</button>
		    		</div>
		    		<form action="{{ route('auth.password.change', ['for' => $mhs->nomor_induk]) }}" method="post">
			    		<div class="modal-body">
			    			@method('put')
		    				@csrf
		    				<table class="table table-light">
			    				<tr>
			    					<td class="align-middle text-center">
			    						<input type="password" class="form-control" name="password" placeholder="Masukkan password baru">
			    					</td>
			    					<td class="align-middle text-center">
			    						<input type="password" class="form-control" name="password-repeat" placeholder="Ulangi password baru">
			    					</td>
			    				</tr>
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
	@endif

	<div class="container">
	    <div class="card height-auto">
	    	<div class="card-body" style="overflow-x: auto;">
	    		<div class="row form-group">
	    			<div class="col">
	    				<table class="table table-bordered table-striped">
							<thead>
								<tr class="bg-light">
									<th class="align-middle text-center">
										<img src="{{ asset('dist/img/logo-unsyiah.png') }}" alt="Universitas Syiah Kuala" width="110em">
									</th>
									<th colspan="3" class="align-middle text-left">
										SISTEM ADMINISTRASI DAN DATABASE TUGAS AKHIR MAHASISWA DAN DOSEN<br>
										PROGRAM STUDI S1 TEKNIK SIPIL<br>
										FAKULTAS TEKNIK - UNIVERSITAS SYIAH KUALA
									</th>
								</tr>
								<form action="{{ route('main.admin.cek-data.with-data') }}" method="get" class="form-control">
									<tr class="bg-light">
										<th class="align-middle text-left">
											NIM Mahasiswa
										</th>
										<th colspan="2" class="align-middle text-left">
											<select name="nim" id="select-nim" style="width: 100%;">
												<option value="empty">Pilih NIM</option>
												@foreach ($semua_mahasiswa as $mahasiswa)
													<option{!! isset($mhs->nomor_induk) ? ($mahasiswa->nomor_induk == $mhs->nomor_induk ? ' selected="selected"' : '') : '' !!}>{{ $mahasiswa->nomor_induk }}</option>
												@endforeach
											</select>
										</th>
										<th colspan="2" class="align-middle text-center">
											<button type="submit" class="btn btn-info text-bold" id="panggil-data">Panggil Data</button>
										</th>
									</tr>
								</form>
								<tr class="bg-light">
									<th class="align-middle text-left">
										Nama Mahasiswa
									</th>
									<th colspan="2" class="align-middle text-left text-bold">
										<span id="nama-mahasiswa">{{ $mhs->nama ?? '--' }}</span>
									</th>
									<th class="align-middle text-center">
										@if (isset($mhs))
											<button type="button" class="btn btn-info text-bold" data-toggle="modal" data-target="#rubah-password">Ubah Password</button>
										@else
											<button class="btn btn-info text-bold" disabled="disabled">Ubah Password</button>
										@endif
									</th>
								</tr>
							</thead>
							<tbody>
								{{--<tr>
									<td class="align-middle text-left">User</td>
									<td colspan="3" class="align-middle text-left bg-white">{{ $nama }}</td>
								</tr>
								<tr>
									<td class="align-middle text-left" style="background-color: rgba(0,0,0,.05);">Tujuan</td>
									<td colspan="3" class="align-middle text-left bg-white">Mengisi Data Rencana TGA</td>
								</tr>--}}
								<tr>
									<td colspan="{{ isset($mhs) ? '3' : '4' }}"></td>
									@if (isset($mhs))
										<td class="align-middle text-center">
											<button type="button" class="btn btn-sm btn-outline-info" id="refresh-btn"><i class="fa fa-sync"></i>&nbsp;&nbsp;Refresh</button>
										</td>
									@endif
								</tr>
								<tr>
									<td colspan="4" class="align-middle text-center text-bold bg-primary">
										KONTROL KETERSEDIAAN DOK.TGA DALAM FOLDER
									</td>
								</tr>
								<tr>
									<td class="align-middle text-center bg-warning">
										Data Usul TGA
									</td>
									<td class="align-middle text-center bg-warning">
										Data Proposal
									</td>
									<td class="align-middle text-center bg-warning">
										Data Sidang
									</td>
									<td class="align-middle text-center bg-warning">
										Data Yudisium
									</td>
								</tr>

								<tr>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['foto'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;Photo
									</td>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['buku-proposal'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;Proposal
									</td>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['buku-tga'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;Buku_TGA
									</td>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['sk-penguji-sidang'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;SK_Penguji_Sid
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['khs'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;KHS_1
									</td>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['berita-acara-seminar-proposal'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;BA_Proposal
									</td>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['berita-acara-sidang-buku'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;BA_Sidang
									</td>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $progress > 35 ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;Disposisi
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['krs'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;KRS_1
									</td>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['daftar-hadir-seminar-proposal'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;Dhadir_Proposal
									</td>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['kelengkapan-dokumen-administrasi-sidang-buku'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;Dhadir_Sidang
									</td>
									<td class="align-middle text-left">
										<input type="checkbox" disabled="disabled">
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['transkrip-sementara'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;Transkrips_1
									</td>
									<td class="align-middle text-left">
										<input type="checkbox" disabled="disabled">&nbsp;&nbsp;
									</td>
									<td class="align-middle text-left">
										<input type="checkbox" disabled="disabled">&nbsp;&nbsp;
									</td>
									<td class="align-middle text-left">
										<input type="checkbox" disabled="disabled">&nbsp;&nbsp;
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['spp'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;SPP_Aktif
									</td>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['sk-pembimbing'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;SK_Pembimb
									</td>
									<td class="align-middle text-left">
										<input type="checkbox"{!! $check_data['sk-penguji-sempro'] == true ? ' checked="checked"' : '' !!}>&nbsp;&nbsp;SK_Penguji_Prop
									</td>
									<td class="align-middle text-left">
										<input type="checkbox" disabled="disabled">&nbsp;&nbsp;
									</td>
								</tr>
{{--
								<tr>
									<td colspan="4" class="align-middle text-center text-bold bg-primary">
										CETAK DOKUMEN ADM TGA
									</td>
								</tr>
								<tr>
									<td class="align-middle text-center bg-success">
										Data Usulan
									</td>
									<td class="align-middle text-center bg-success">
										Data Sem Prop
									</td>
									<td class="align-middle text-center bg-success">
										Data Sidang
									</td>
									<td class="align-middle text-center bg-success">
										Data Umum
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox" id="data-photo">&nbsp;&nbsp;SK_Kom_Pemb
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Und_Proposal
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Und_sidang
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;ctk_Transkrip
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox" id="data-photo">&nbsp;&nbsp;ctk_Disposisi
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;SK_Uji_Prop
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;SK_Uji_Sid
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;ctk_Biodata
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox" id="data-photo">&nbsp;&nbsp;Srt_Tugas/Lab
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;ctk_BA_Seminar
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;ctk_BA_Sidang
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;ctk_LembarS7
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox" id="data-photo">&nbsp;&nbsp;Berkas_lain_1
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Berkas_lain_2
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Berkas_lain_3
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;ctk_Berkas_Yudis
									</td>
								</tr>
								<tr>
									<td class="align-middle text-center">
										<button class="btn btn-block btn-info text-bold cetak-btn">Cetak_usulTGA</button>
									</td>
									<td class="align-middle text-center">
										<button class="btn btn-block btn-info text-bold cetak-btn">Cetak_Dtsem</button>
									</td>
									<td class="align-middle text-center">
										<button class="btn btn-block btn-info text-bold cetak-btn">Cetak_DtSid</button>
									</td>
									<td class="align-middle text-center">
										<button class="btn btn-block btn-info text-bold cetak-btn">Cetak_DtYud</button>
									</td>
								</tr>--}}
							</tbody>
	    				</table>
	    			</div>
	    		</div>

				{{-- <div class="row">
					<div class="col">
						<div class="row">
							<p>
								SISTEM ADMINISTRASI DAN DATABASE TUGAS AKHIR MAHASISWA DAN DOSEN<br>
								PROGRAM STUDI S1 TEKNIK SIPIL<br>
								FAKULTAS TEKNIK - UNIVERSITAS SYIAH KUALA
							</p>
							<div class="col">
								<div class="row p-2">
									<div class="col">NIM Mahasiswa</div>
									<div class="col">
										<select name="nim-mahasiswa" id="">
											@foreach ($semua_mahasiswa as $mahasiswa)
												<option>{{ $mahasiswa->nomor_induk }}</option>
											@endforeach
										</select>
									</div>
									<div class="col"><button class="btn btn-lg btn-primary">Panggil Data</button></div>
								</div>
								<div class="row p-2">
									<div class="col">Nama Mahasiswa</div>
									<div class="col"></div>
									<div class="col"><button class="btn btn-lg btn-secondary">Ubah Password</button></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						
					</div>
				</div> --}}
	    	</div>
	    </div>
	</div>
@endsection