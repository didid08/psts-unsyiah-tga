<table width="100%" class="table table-bordered{{ formBackground(1, 3, $administrasi_tga) }}">
	<tbody>
		@if (in_array($administrasi_tga->value('progress'), range(2, 3)) && $administrasi_tga->value('repeat'))
			@php
				$penolak;
				if ($administrasi_tga->value('progress') == 2) {
					$penolak = 'Admin';
				} elseif ($administrasi_tga->value('progress') == 3) {
					$penolak = 'Koordinator Prodi';
				}
			@endphp
			<tr>
				<td colspan="3" class="text-center align-middle">
					<div class="alert alert-danger text-left font-italic" role="alert">
					  <b>Kesalahan!</b> Pengajuan anda ditolak oleh "{{ $penolak }}"
					</div>
				</td>
			</tr>
		@endif
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">SPP</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(2,3)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="spp" id="spp" onchange="showSelectedFile('#spp-label', event)" accept="application/pdf">
							<label class="custom-file-label text-left" for="spp" id="spp-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">KRS</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(2,3)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="krs" id="krs" onchange="showSelectedFile('#krs-label', event)" accept="application/pdf">
							<label class="custom-file-label text-left" for="krs" id="krs-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle">Transkrip Sementara</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(2,3)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="transkrip-sementara" id="transkrip-sementara" onchange="showSelectedFile('#transkrip-sementara-label', event)" accept="application/pdf">
							<label class="custom-file-label text-left" for="transkrip-sementara" id="transkrip-sementara-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">4.</td>
			<td class="align-middle">KHS</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(2,3)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="khs" id="khs" onchange="showSelectedFile('#khs-label', event)" accept="application/pdf">
							<label class="custom-file-label text-left" for="khs" id="khs-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') == 1)
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		@elseif (in_array($administrasi_tga->value('progress'), range(2, 3)) && $administrasi_tga->value('repeat'))
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<button type="submit" class="btn btn-sm btn-warning">Perbaiki</button>
				</td>
			</tr>
		@endif

		@if ($administrasi_tga->value('progress') > 3)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>