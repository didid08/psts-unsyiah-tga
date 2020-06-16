<table width="100%" class="table table-bordered table-striped{{ ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26) ? '' : formBackgroundOptional(1, 3, $administrasi_tga) }}">
	<tbody>
		@if (in_array($administrasi_tga->value('progress_optional'), range(2, 3)) && $administrasi_tga->value('repeat_optional'))
			@php
				$penolak;
				if ($administrasi_tga->value('progress_optional') == 2) {
					$penolak = 'Admin';
				} elseif ($administrasi_tga->value('progress_optional') == 3) {
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
			<td colspan="3" class="align-middle">Pengajuan Surat Tugas Pengambilan Data Lab/Lapangan (<span class="text-red">opsional</span>)</td>
		</tr>
		<tr>
			<td class="align-middle">Surat Permohonan Tugas Pengambilan Data</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress_optional') == 0 || ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26))
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="sptpd" id="sptpd" onchange="showSelectedFile('#sptpd-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="sptpd" id="sptpd-label">Pilih File</label>
					</div>
				@elseif ($administrasi_tga->value('progress_optional') == 1)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="sptpd" id="sptpd" onchange="showSelectedFile('#sptpd-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="sptpd" id="sptpd-label">Pilih File</label>
					</div>
				@elseif (in_array($administrasi_tga->value('progress_optional'), range(2,3)))
					@if ($administrasi_tga->value('repeat_optional'))
						<input type="file">
					@else
						<span class="text-yellow">sedang diperiksa</span>
					@endif
				@else
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@endif
			</td>
			@if ($administrasi_tga->value('progress_optional') == 0 || ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26))
				<td class="text-center align-middle">
					<button class="btn btn-sm btn-secondary" disabled="disabled">Kirim</button>
				</td>
			@elseif ($administrasi_tga->value('progress_optional') == 1)
				<td class="text-center align-middle">
					<button class="btn btn-sm btn-success">Kirim</button>
				</td>
			@elseif (in_array($administrasi_tga->value('progress_optional'), range(2,3)) && $administrasi_tga->value('repeat_optional'))
				<td class="text-center align-middle">
					<button class="btn btn-sm btn-warning">Perbaiki</button>
				</td>
			@endif
		</tr>
	</tbody>
</table>