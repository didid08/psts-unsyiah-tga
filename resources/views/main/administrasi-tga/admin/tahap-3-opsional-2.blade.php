<table width="100%" class="table table-bordered table-striped{{ ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26) ? '' : formBackgroundOptional(4, 5, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle"><b>Surat Tugas Pengambilan Data Lab/Lapangan</b></td>
			<td class="align-middle text-center">
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">No</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress_optional') < 4)
					<span class="text-muted">--</span>
				@elseif ($administrasi_tga->value('progress_optional') == 4 && $administrasi_tga->value('progress') < 26)
					<input type="text" class="form-control bg-light" placeholder="Masukkan nomor">	
				@elseif ($administrasi_tga->value('progress_optional') > 5)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">	
				@elseif ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26)
					<span class="text-muted">--</span>
				@else
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">Tgl</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress_optional') < 4)
					<span class="text-muted">--</span>
				@elseif ($administrasi_tga->value('progress_optional') == 4 && $administrasi_tga->value('progress') < 26)
					<input type="text" class="form-control bg-light" placeholder="Masukkan tanggal">	
				@elseif ($administrasi_tga->value('progress_optional') > 5)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">	
				@elseif ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26)
					<span class="text-muted">--</span>
				@else
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">Berkas</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress_optional') < 4)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="stpd" id="stpd" onchange="showSelectedFile('#stpd-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="stpd" id="stpd-label">Pilih File</label>
					</div>
				@elseif ($administrasi_tga->value('progress_optional') == 4 && $administrasi_tga->value('progress') < 26)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="stpd" id="stpd" onchange="showSelectedFile('#stpd-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="stpd" id="stpd-label">Pilih File</label>
					</div>
				@elseif ($administrasi_tga->value('progress_optional') > 5)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@elseif ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="stpd" id="stpd" onchange="showSelectedFile('#stpd-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="stpd" id="stpd-label">Pilih File</label>
					</div>
				@else
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@endif
			</td>
		</tr>

		@if ($administrasi_tga->value('progress_optional') < 4 | ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26))
			<tr>
				<td colspan="2"></td>
				<td class="align-middle text-center">
					<button class="btn btn-sm btn-secondary" disabled="disabled">Kirim ke Koordinator Prodi</button>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress_optional') == 4 && $administrasi_tga->value('progress') < 26)
			<tr>
				<td colspan="2"></td>
				<td class="align-middle text-center">
					<button class="btn btn-sm btn-success">Kirim ke Koordinator Prodi</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>