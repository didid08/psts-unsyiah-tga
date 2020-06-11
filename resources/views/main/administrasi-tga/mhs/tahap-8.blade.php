<table width="100%" class="table table-bordered{{ formBackground(15, 17, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Berita Acara Seminar Proposal</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 17)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(16,17)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="berita-acara-seminar-proposal" id="berita-acara-seminar-proposal" onchange="showSelectedFile('#berita-acara-seminar-proposal-label', event)" accept="application/pdf">
							<label class="custom-file-label text-left" for="spp" id="berita-acara-seminar-proposal-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Buku Proposal</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 17)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(16,17)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="buku-proposal" id="buku-proposal" onchange="showSelectedFile('#buku-proposal-label', event)" accept="application/pdf">
							<label class="custom-file-label text-left" for="krs" id="buku-proposal-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		
		@if ($administrasi_tga->value('progress') < 15)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="button" class="btn btn-sm btn-secondary" disabled="disabled">Kirim</button>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') == 15)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		@elseif (in_array($administrasi_tga->value('progress'), range(16, 17)) && $administrasi_tga->value('repeat'))
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="submit" class="btn btn-sm btn-warning">Perbaiki</button>
				</td>
			</tr>
		@endif

		@if ($administrasi_tga->value('progress') > 17)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>