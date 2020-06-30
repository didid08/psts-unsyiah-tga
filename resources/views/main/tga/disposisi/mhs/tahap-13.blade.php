<table width="100%" class="table table-bordered{{ formBackground(26, 27, $disposisi) }}">
	<tbody>
		<tr>
			@if ($disposisi->progress < 26)
				<td class="align-middle">
					Pelaksanaan Sidang Buku TGA
				</td>
			@elseif ($disposisi->progress == 26)
				<td class="align-middle">
					<div class="alert alert-info text-left" role="alert" style="margin: 0;">
						<u><b>Pelaksanaan Sidang Buku TGA.</b></u>
						<ul>
							<li>Sidang Buku TGA dilaksanakan secara langsung maupun secara online.</li>
							<li>Apabila ingin dilakukan secara online, maka mahasiswa dapat mengakses zoom melalui link berikut: <a href="http://zoom.us">zoom.us</a>.</li>
							<li>Apabila sidang sudah selesai maka mahasiswa dapat mengisi peserta sidang agar dapat lanjut ke tahap selanjutnya.</li>
						</ul>
					</div>
				</td>
			@elseif ($disposisi->progress == 27)
				<td class="align-middle">
					<h5 class="mb-2 ml-2">Isi Peserta Sidang</h5>
					<form action="{{ route('main.tga.mahasiswa.upload-disposisi', ['progress' => 27]) }}" method="post">
						@csrf
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th colspan="3" class="align-middle text-center">Peserta Sidang</th>
								</tr>
								<tr>
									<th class="align-middle text-center">No</th>
									<th class="align-middle text-center">Nama</th>
									<th class="align-middle text-center">NIM</th>
								</tr>
							</thead>
							<tbody>
								@for ($i = 1; $i <= 10; $i++)
									<tr>
										<td class="align-middle text-center">{{ $i }}</td>
										<td class="align-middle text-center">
											<input type="text" class="form-control" name="peserta-sidang-{{ $i }}-nama" placeholder="Masukkan Nama" value="a">
										</td>
										<td class="align-middle text-center">
											<input type="text" class="form-control" name="peserta-sidang-{{ $i }}-nim" placeholder="Masukkan NIM" value="1">
										</td>
									</tr>
								@endfor
								<tr>
									<td colspan="3" class="align-middle text-center">
										<button type="submit" class="btn btn-block btn-success text-bold">Simpan</button>
									</td>
								</tr>
							</tbody>
						</table>
					</form>
				</td>
			@elseif ($disposisi->progress > 27)
				<td class="align-middle">
					<div class="alert alert-success text-left" role="alert" style="margin: 0;">
						<b>Pelaksanaan Sidang Buku TGA sudah selesai.</b>
					</div>
				</td>
			@endif
		</tr>
	</tbody>
</table>