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
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(32,32)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="lembar-pengesahan-dan-buku-laporan-kp" id="lembar-pengesahan-dan-buku-laporan-kp" onchange="showSelectedFile('#lembar-pengesahan-dan-buku-laporan-kp-label', event)" accept="application/zip" {!! in_array($administrasi_tga->value('progress'), range(31,32)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="lembar-pengesahan-dan-buku-laporan-kp" id="lembar-pengesahan-dan-buku-laporan-kp-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		
		@if ($administrasi_tga->value('progress') < 31)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="button" class="btn btn-sm btn-secondary" disabled="disabled">Kirim</button>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') == 31)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
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
	</tbody>
</table>