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
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
				@elseif (in_array($administrasi_tga->value('progress'), range(32,32)))
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress') == 31)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@else
					--
				@endif
			</td>
		</tr>
		
		@if ($administrasi_tga->value('progress') == 32)
			<tr>
				<td colspan="3" class="text-right align-middle">
					<button type="submit" class="btn btn-success">Terima</button>
					<button type="submit" class="btn btn-danger">Tolak</button>
				</td>
			</tr>
		@endif
		
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