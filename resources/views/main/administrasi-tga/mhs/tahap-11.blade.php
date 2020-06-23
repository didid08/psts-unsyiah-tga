<table width="100%" class="table table-bordered{{ formBackground(21, 23, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Lembar Asistensi (Setuju Disidangkan)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 23)
					<span class="text-success">Telah disetujui</span>
				@elseif ($administrasi_tga->value('progress') > 23)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(22,22)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="lembar-asistensi-2" id="lembar-asistensi-2" onchange="showSelectedFile('#lembar-asistensi-2-label', event)" accept="application/pdf" {!! in_array($administrasi_tga->value('progress'), range(21,23)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="lembar-asistensi-2" id="lembar-asistensi-2-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Draft Buku TGA</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 23)
					<span class="text-success">Telah disetujui</span>
				@elseif ($administrasi_tga->value('progress') > 23)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(22,22)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<form class="">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="draft-buku-tga" id="draft-buku-tga" onchange="showSelectedFile('#draft-buku-tga-label', event)" accept="application/pdf" {!! in_array($administrasi_tga->value('progress'), range(21,23)) ? '' : 'disabled="disabled"' !!}>
								<label class="custom-file-label text-left" for="draft-buku-tga" id="draft-buku-tga-label">Pilih File</label>
							</div>
						</form>
					@endif
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') == 21)
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		@endif
		@if ($administrasi_tga->value('progress') > 23)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif
		@if ($administrasi_tga->value('progress') == 23)
			<tr class="bg-warning">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA sedang mengusulkan Komisi Penguji dan Jadwal Sidang Buku
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') > 23)
			<tr>
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA telah mengusulkan Komisi Penguji dan Jadwal Sidang Buku
				</td>
			</tr>
		@else
			<tr class="text-muted">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Sidang Buku
				</td>
			</tr>
		@endif
	</tbody>
</table>