@extends('main.master')

@section('custom-style')
	<style>
		.nonactive {
			color: rgba(0,0,0,0.1);
		}
		.icon-size {
			font-size: 1.8em;
		}
	</style>
@endsection

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	@if ($category != 'mahasiswa' && $nim != null)
		<li class="breadcrumb-item"><a href="{{ route('main.administrasi-tga', ['category' => $category]) }}">{{ $subtitle }}</a></li>
	@endif
	<li class="breadcrumb-item active">{{ $category != 'mahasiswa' ? ($nim != null ? $mahasiswa->nama : $subtitle) : $subtitle }}</li>
@endsection

@section('content')
	<div class="container">
		@if ($category != 'mahasiswa' && $nim == null)
			<div class="card">
				<div class="card-body">
					Halaman Daftar Mahasiswa
				</div>
			</div>
		@else
			<div class="card">
				<div class="card-body" style="overflow-x: auto;">
					<table class="table table-bordered table-striped table-responsive">
						<thead>
							<tr class="bg-info">
								<th rowspan="2" class="text-center align-middle">#</th>
								<th class="text-center align-middle">Nama</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa->nama }}</th>
								<th class="text-center align-middle">Bidang</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa_data_tga->bidang->content }}</th>
								<th colspan="6" class="text-center align-middle">Progress</th>
							</tr>
							<tr class="bg-info">
								<th class="text-center align-middle">NIM</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa->nomor_induk }}</th>
								<th class="text-center align-middle">Nomor HP</th>
								<th class="align-middle font-weight-normal">{{ $mahasiswa_data_tga->no_hp->content }}</th>
								<th class="text-center align-middle">Mhs</th>
								<th class="text-center align-middle">Admin</th>
								<th class="text-center align-middle">Koor Prodi</th>
								<th class="text-center align-middle">Ketua Kel.Keahlian</th>
								<th class="text-center align-middle">Pembimbing (Co)</th>
								<th class="text-center align-middle">Koor TGA</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><b>1</b></td>
								<td colspan="4">
									<table width="100%" class="table-borderless">
										<tbody>
											<tr>
												<td class="align-middle">1.</td>
												<td class="align-middle">SPP</td>
												<td class="align-middle"><input type="file"></td>
											</tr>
											<tr>
												<td class="align-middle">2.</td>
												<td class="align-middle">KRS</td>
												<td class="align-middle"><input type="file"></td>
											</tr>
											<tr>
												<td class="align-middle">3.</td>
												<td class="align-middle">Transkrip Sementara</td>
												<td class="align-middle"><input type="file"></td>
											</tr>
											<tr>
												<td class="align-middle">4.</td>
												<td class="align-middle">KHS</td>
												<td class="align-middle"><input type="file"></td>
											</tr>
											<tr>
												<td colspan="2"></td>
												<td class="text-right align-middle">
													<button type="submit" class="btn btn-sm btn-success">Kirim</button>
													<a href="#" class="btn btn-sm btn-light">Unduh Disposisi</a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td class="text-center align-middle"><i class="fa fa-circle nonactive icon-size"></i></td>
								<td class="text-center align-middle"><i class="fa fa-circle nonactive icon-size"></i></td>
								<td class="text-center align-middle"><i class="fa fa-circle nonactive icon-size"></i></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr>
								<td><b>2</b></td>
								<td colspan="4">
									<table width="100%" class="table-borderless">
										<tbody>
											<tr>
												<td class="align-middle">1.</td>
												<td class="align-middle">Nama Pembimbing <span style="float: right;">:</span></td>
												<td class="align-middle"></td>
											</tr>
											<tr>
												<td class="align-middle">2.</td>
												<td class="align-middle">Nama Co Pembimbing <span style="float: right;">:</span></td>
												<td class="align-middle"></td>
											</tr>
											<tr>
												<td class="align-middle">3.</td>
												<td class="align-middle">Rencana Judul TGA <span style="float: right;">:</span></td>
												<td class="align-middle">{{ $mahasiswa_data_tga->judul_tga->content }}</td>
											</tr>
											<tr>
												<td colspan="2"></td>
												<td class="text-right align-middle">
													<a href="#" class="btn btn-sm btn-light">Unduh Disposisi</a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"><i class="fa fa-circle nonactive icon-size"></i></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr>
								<td><b>3</b></td>
								<td colspan="4">
									<table width="100%" class="table-borderless">
										<tbody>
											<tr>
												<td class="align-middle">1.</td>
												<td class="align-middle">SK Penunjukan Pembimbing</td>
												<td class="align-middle"></td>
											</tr>
											<tr>
												<td class="align-middle"></td>
												<td class="align-middle">No <span style="float: right;">:</span></td>
												<td class="align-middle"></td>
											</tr>
											<tr>
												<td class="align-middle"></td>
												<td class="align-middle">Tgl <span style="float: right;">:</span></td>
												<td class="align-middle"></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td class="align-middle text-right">
													<a href="#" class="btn btn-sm btn-light">Unduh SK</a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td class="text-center align-middle">
								</td>
								<td class="text-center align-middle">
									<i class="fa fa-circle nonactive icon-size"></i>
								</td>
								<td class="text-center align-middle">
									<i class="fa fa-circle nonactive icon-size"></i>
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="4">
									<table width="100%" class="table-borderless">
										<tbody>
											<tr>
												<td colspan="3" class="align-middle">Pengajuan Surat Tugas Pengambilan Data Lab/Lapangan (<span class="text-red">opsional</span>)</td>
											</tr>
											<tr>
												<td class="align-middle">Surat Permohonan Tugas Pengambilan Data</td>
												<td class="text-center align-middle"><input type="file"></td>
												<td class="text-center align-middle"><button class="btn btn-sm btn-success">Kirim</button></td>
											</tr>
										</tbody>
									</table>
								</td>
								<td class="text-center align-middle">
									<i class="fa fa-circle nonactive icon-size"></i>
								</td>
								<td class="text-center align-middle">
									<i class="fa fa-circle nonactive icon-size"></i>
								</td>
								<td class="text-center align-middle">
									<i class="fa fa-circle nonactive icon-size"></i>
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="4">
									<table width="100%" class="table-borderless">
										<tbody>
											<tr>
												<td class="align-middle">2.</td>
												<td class="align-middle">Surat Tugas Pengambilan Data Lab/Lapangan</td>
												<td class="align-middle"></td>
											</tr>
											<tr>
												<td class="align-middle"></td>
												<td class="align-middle">No <span style="float: right;">:</span></td>
												<td class="align-middle"></td>
											</tr>
											<tr>
												<td class="align-middle"></td>
												<td class="align-middle">Tgl <span style="float: right;">:</span></td>
												<td class="align-middle"></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td class="align-middle text-right">
													<a href="#" class="btn btn-sm btn-light">Unduh Surat Tugas Pengambilan Data & Disposisi</a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td class="text-center align-middle">
								</td>
								<td class="text-center align-middle">
									<i class="fa fa-circle nonactive icon-size"></i>
								</td>
								<td class="text-center align-middle">
									<i class="fa fa-circle nonactive icon-size"></i>
								</td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
								<td class="text-center align-middle"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		@endif
	</div>
@endsection