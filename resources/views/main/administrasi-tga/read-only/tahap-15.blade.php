<table width="100%" class="table table-bordered{{ formBackground(31, 32, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td colspan="2" class="align-middle text-left">
				Pembimbing dan Pembahas telah menerima Hard/Softcopy SK
			</td>
		</tr>

		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Lembar Pengesahan dan Buku Laporan KP (jika diperlukan)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 32)
					@if (isset($roles->koor_prodi))
						<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
					@else
						<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
					@endif
				@elseif (in_array($administrasi_tga->value('progress'), range(32,32)))
					<span class="text-warning">Sedang diproses</span>
				@elseif ($administrasi_tga->value('progress') == 31)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@else
					--
				@endif
			</td>
		</tr>
		
		<tr>
			<td class="align-middle"></td>
			<td colspan="2" class="align-middle text-left">
				Email Pembimbing dan Pembahas cek di: <br>
				<a href="https://unsyiah.ac.id/faculty-and-staff" target="_blank">https://unsyiah.ac.id/faculty-and-staff</a>
			</td>
		</tr>

		@if ($administrasi_tga->value('progress') == 33)
			<tr>
				<td colspan="3">
					<div class="alert alert-success text-left" role="alert" style="margin: 0;">
						<i>Menunggu mahasiswa untuk mengunggah <b>Data Yudisium</b></i>
					</div>
				</td>
			</tr>
		@endif
	</tbody>
</table>