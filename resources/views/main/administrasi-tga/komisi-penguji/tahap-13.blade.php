<table width="100%" class="table table-bordered{{ formBackground(26, 27, $administrasi_tga) }}">
	<tbody>
		<tr>
			@if ($administrasi_tga->value('progress') < 26)
				<td class="align-middle">
					Pelaksanaan Sidang Buku TGA
				</td>
			@elseif ($administrasi_tga->value('progress') == 26)
				<td class="align-middle">
					<div class="alert alert-info text-left" role="alert" style="margin: 0;">
						<u><b>Pelaksanaan Sidang Buku TGA.</b></u>
						<ul>
							<li>Sidang Buku TGA dilaksanakan secara langsung maupun secara online.</li>
							<li>Apabila ingin dilakukan secara online, maka mahasiswa dapat mengakses zoom melalui link berikut: <a href="http://zoom.us">zoom.us</a>.</li>
							<li>Apabila sidang sudah selesai maka mahasiswa dapat mengunggah <b>Data Sidang</b> agar dapat lanjut ke tahap selanjutnya.</li>
						</ul>
					</div>
				</td>
			@elseif ($administrasi_tga->value('progress') == 27)
				<td class="align-middle">
					<div class="alert alert-success text-left" role="alert"  style="margin: 0;">
						<b>Pelaksanaan Sidang Buku TGA sudah selesai.</b> <br>
						<i>Menunggu mahasiswa untuk mengunggah <b>Data Sidang</b></i>
					</div>
				</td>
			@elseif ($administrasi_tga->value('progress') > 27)
				<td class="align-middle">
					<div class="alert alert-success text-left" role="alert" style="margin: 0;">
						<b>Pelaksanaan Sidang Buku TGA sudah selesai.</b>
					</div>
				</td>
			@endif
		</tr>

		@if ($administrasi_tga->value('progress') == 26 && $is_ketua_penguji)
			<tr>
				<td>
					<button class="btn btn-block btn-success"><i class="fa fa-check-circle text-white"></i>&nbsp;&nbsp;Jadikan selesai</button>
				</td>
			</tr>
		@endif			
	</tbody>
</table>