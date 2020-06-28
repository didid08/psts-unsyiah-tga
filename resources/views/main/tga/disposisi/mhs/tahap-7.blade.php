<table width="100%" class="table table-bordered{{ formBackground(13, 14, $disposisi) }}">
	<tbody>
		<tr>
			@if ($disposisi->progress < 13)
				<td class="align-middle">
					Pelaksanaan Seminar Proposal
				</td>
			@elseif ($disposisi->progress == 13)
				<td class="align-middle">
					<div class="alert alert-info text-left" role="alert" style="margin: 0;">
						<u><b>Pelaksanaan Seminar Proposal.</b></u>
						<ul>
							<li>Seminar proposal dilaksanakan secara langsung maupun secara online.</li>
							<li>Apabila ingin dilakukan secara online, maka mahasiswa dapat mengakses zoom melalui link berikut: <a href="http://zoom.us">zoom.us</a>.</li>
							<li>Apabila seminar sudah selesai maka mahasiswa dapat mengisi peserta seminar agar dapat lanjut ke tahap selanjutnya.</li>
						</ul>
					</div>
				</td>
			@elseif ($disposisi->progress == 14)
				<td class="align-middle">
					<h5 class="mb-2 ml-2">Isi Peserta Seminar</h5>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th colspan="3" class="align-middle text-center">Peserta Seminar</th>
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
										<input type="text" class="form-control" name="peserta-seminar-{{ $i }}-nama" placeholder="Masukkan Nama">
									</td>
									<td class="align-middle text-center">
										<input type="text" class="form-control" name="peserta-seminar-{{ $i }}-nim" placeholder="Masukkan NIM">
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
				</td>
			@elseif ($disposisi->progress > 14)
				<td class="align-middle">
					<div class="alert alert-success text-left" role="alert" style="margin: 0;">
						<b>Pelaksanaan Seminar Proposal sudah selesai.</b>
					</div>
				</td>
			@endif
		</tr>
	</tbody>
</table>