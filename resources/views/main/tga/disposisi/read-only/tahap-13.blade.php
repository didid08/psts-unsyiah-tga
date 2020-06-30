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
						</ul>
					</div>
				</td>
			@elseif ($disposisi->progress == 27)
				<td class="align-middle">
					<div class="alert alert-success text-left" role="alert"  style="margin: 0;">
						<b>Pelaksanaan Sidang Buku TGA sudah selesai.</b> <br>
						<i>Menunggu mahasiswa untuk mengisi peserta sidang buku tga</i>
					</div>
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