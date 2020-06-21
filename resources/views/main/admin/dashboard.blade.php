@extends('main.master')

@section('custom-script')
	<script>
		$("#select-nim").select2();
		$("tbody").addClass('text-muted');
		$("input[type=checkbox]").attr('disabled', 'disabled');
		$(".cetak-btn").attr('disabled', 'disabled');
	</script>
@endsection

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	<li class="breadcrumb-item active">{{ $subtitle }}</li>
@endsection

@section('content')
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
								<tr class="bg-light">
									<th class="align-middle text-left">
										NIM Mahasiswa
									</th>
									<th class="align-middle text-left">
										<select name="nim-mahasiswa" id="select-nim" style="width: 100%;">
											<option value="empty">Pilih NIM</option>
											@foreach ($semua_mahasiswa as $mahasiswa)
												<option>{{ $mahasiswa->nomor_induk }}</option>
											@endforeach
										</select>
									</th>
									<th colspan="2" class="align-middle text-center">
										<button class="btn btn-info text-bold">Panggil Data</button>
									</th>
								</tr>
								<tr class="bg-light">
									<th class="align-middle text-left">
										Nama Mahasiswa
									</th>
									<th class="align-middle text-left text-bold">
										<span id="nama-mahasiswa">--</span>
									</th>
									<th colspan="2" class="align-middle text-center">
										<button class="btn btn-info text-bold" disabled="disabled">Rubah Password</button>
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
									<td colspan="4"></td>
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
										<input type="checkbox" id="data-photo">&nbsp;&nbsp;Photo
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Proposal
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Buku_TGA
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;SK_Penguji_Sid
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox" id="data-photo">&nbsp;&nbsp;KHS_1
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;BA_Proposal
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;BA_Sidang
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Disposisi
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox" id="data-photo">&nbsp;&nbsp;KRS_1
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Dhadir_Proposal
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Dhadir_Sidang
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Lembar_S7
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox" id="data-photo">&nbsp;&nbsp;Transkrips_1
									</td>
									<td class="align-middle text-left">
										<input type="checkbox" disabled="disabled">&nbsp;&nbsp;
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Publ_Ilmiah
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;P'sahan_TGA
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left">
										<input type="checkbox" id="data-photo">&nbsp;&nbsp;SPP_Aktif
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;SK_Pembimb
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;SK_Penguji_Prop
									</td>
									<td class="align-middle text-left">
										<input type="checkbox">&nbsp;&nbsp;Lembar_ACC
									</td>
								</tr>

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
								</tr>
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