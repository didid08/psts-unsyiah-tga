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
						</ul>
					</div>
				</td>
			@elseif ($disposisi->progress == 14)
				<td class="align-middle">
					<div class="alert alert-success text-left" role="alert" style="margin: 0;">
						<b>Pelaksanaan Seminar Proposal sudah selesai.</b> <br>
						<i>Menunggu mahasiswa untuk mengisi peserta seminar proposal</i>
					</div>
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