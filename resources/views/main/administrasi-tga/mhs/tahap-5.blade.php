<table width="100%" class="table table-bordered{{ formBackground(8, 10, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Lembar Asistensi (Setuju Diseminarkan)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 10)
					<span class="text-success">Telah disetujui</span>
				@elseif ($administrasi_tga->value('progress') > 10)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(9,9)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="lembar-asistensi" id="lembar-asistensi" onchange="showSelectedFile('#lembar-asistensi-label', event)" accept="application/pdf" {!! in_array($administrasi_tga->value('progress'), range(8,10)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="lembar-asistensi" id="lembar-asistensi-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Draft Buku Proposal</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 10)
					<span class="text-success">Telah disetujui</span>
				@elseif ($administrasi_tga->value('progress') > 10)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(9,9)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<form class="">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="draft-buku-proposal" id="draft-buku-proposal" onchange="showSelectedFile('#draft-buku-proposal-label', event)" accept="application/pdf" {!! in_array($administrasi_tga->value('progress'), range(8,10)) ? '' : 'disabled="disabled"' !!}>
								<label class="custom-file-label text-left" for="draft-buku-proposal" id="draft-buku-proposal-label">Pilih File</label>
							</div>
						</form>
					@endif
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') == 8)
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		@endif
		@if ($administrasi_tga->value('progress') > 10)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif
		@if ($administrasi_tga->value('progress') == 10)
			<tr class="bg-warning">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA sedang mengusulkan Komisi Penguji dan Jadwal Seminar
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') > 10)
			<tr>
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA telah mengusulkan Komisi Penguji dan Jadwal Seminar
				</td>
			</tr>
		@else
			<tr class="text-muted">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar
				</td>
			</tr>
		@endif
	</tbody>
</table>