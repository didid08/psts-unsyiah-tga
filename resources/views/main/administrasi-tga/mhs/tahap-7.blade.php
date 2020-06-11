<table width="100%" class="table table-bordered{{ formBackground(13, 13, $administrasi_tga) }}">
	<tbody>
		<tr>
			@if ($administrasi_tga->value('progress') < 13)
				<td class="align-middle">
					Pelaksanaan Seminar Proposal
				</td>
			@elseif ($administrasi_tga->value('progress') == 13)
				<td class="align-middle">
					<div class="alert alert-info text-left" role="alert">
						<u><b>Pelaksanaan Seminar Proposal.</b></u>
						<ul>
							<li>Seminar proposal dilaksanakan secara langsung maupun secara online.</li>
							<li>Apabila ingin dilakukan secara online, maka mahasiswa dapat mengakses zoom melalui link berikut: <a href="http://zoom.us">zoom.us</a>.</li>
							<li>Apabila seminar sudah selesai maka mahasiswa dapat mengunggah <b>Data Proposal</b> agar dapat lanjut ke tahap selanjutnya.</li>
						</ul>
					</div>
				</td>
			@elseif ($administrasi_tga->value('progress') == 14)
				<td class="align-middle">
					<div class="alert alert-success text-left" role="alert">
						<b>Pelaksanaan Seminar Proposal sudah selesai.</b> <br>
						Silahkan mengunggah <b>Data Proposal</b> melalui link berikut: <a href="#">Unggah Data Proposal</a> untuk membuka tahap selanjutnya
					</div>
				</td>
			@elseif ($administrasi_tga->value('progress') > 14)
				<td class="align-middle">
					<div class="alert alert-success text-left" role="alert">
						<b>Pelaksanaan Seminar Proposal sudah selesai.</b>
					</div>
				</td>
			@endif
		</tr>
	</tbody>
</table>