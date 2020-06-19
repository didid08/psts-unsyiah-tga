<table width="100%" class="table table-bordered{{ formBackground(13, 14, $administrasi_tga) }}">
	<tbody>
		<tr>
			@if ($administrasi_tga->value('progress') < 13)
				<td class="align-middle">
					Pelaksanaan Seminar Proposal
				</td>
			@elseif ($administrasi_tga->value('progress') == 13)
				<td class="align-middle">
					<div class="alert alert-info text-left" role="alert" style="margin: 0;">
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
					<div class="alert alert-success text-left" role="alert"  style="margin: 0;">
						<b>Pelaksanaan Seminar Proposal sudah selesai.</b> <br>
						<i>Menunggu mahasiswa untuk mengunggah <b>Data Proposal</b></i>
					</div>
				</td>
			@elseif ($administrasi_tga->value('progress') > 14)
				<td class="align-middle">
					<div class="alert alert-success text-left" role="alert" style="margin: 0;">
						<b>Pelaksanaan Seminar Proposal sudah selesai.</b>
					</div>
				</td>
			@endif
		</tr>

		@if ($administrasi_tga->value('progress') == 13 && $is_ketua_penguji)
			<tr>
				<td>
					<button class="btn btn-block btn-success"><i class="fa fa-check-circle text-white"></i>&nbsp;&nbsp;Jadikan selesai</button>
				</td>
			</tr>
		@endif			
	</tbody>
</table>