<table width="100%" class="table table-bordered{{ formBackground(11, 12, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle font-weight-bold">SK Komisi Penguji Seminar Proposal</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress') > 12)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@elseif ($administrasi_tga->value('progress') == 11)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="sk-komisi-penguji-seminar-proposal" id="sk-komisi-penguji-seminar-proposal" onchange="showSelectedFile('#sk-komisi-penguji-seminar-proposal-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="sk-komisi-penguji-seminar-proposal" id="sk-komisi-penguji-seminar-proposal-label">Pilih File</label>
					</div>
				@elseif ($administrasi_tga->value('progress') == 12)
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@else
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="sk-komisi-penguji-seminar-proposal" id="sk-komisi-penguji-seminar-proposal" onchange="showSelectedFile('#sk-komisi-penguji-seminar-proposal-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="sk-komisi-penguji-seminar-proposal" id="sk-komisi-penguji-seminar-proposal-label">Pilih File</label>
					</div>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">No</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 11)
					<input type="text" placeholder="Masukkan nomor" class="form-control">
				@elseif ($administrasi_tga->value('progress') == 12)
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($administrasi_tga->value('progress') > 12)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					<input type="text" placeholder="Masukkan nomor" class="form-control" disabled="disabled">
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">Tgl</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 11)
					<input type="text" placeholder="Masukkan tanggal" class="form-control">
				@elseif ($administrasi_tga->value('progress') == 12)
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($administrasi_tga->value('progress') > 12)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					<input type="text" placeholder="Masukkan tanggal" class="form-control" disabled="disabled">
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle font-weight-bold">Undangan Seminar</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress') == 11)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="undangan-seminar" id="undangan-seminar" onchange="showSelectedFile('#undangan-seminar-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="undangan-seminar" id="undangan-seminar-label">Pilih File</label>
					</div>
				@elseif ($administrasi_tga->value('progress') == 12)
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($administrasi_tga->value('progress') > 12)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="undangan-seminar" id="undangan-seminar" onchange="showSelectedFile('#undangan-seminar-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="undangan-seminar" id="undangan-seminar-label">Pilih File</label>
					</div>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle font-weight-bold">Berkas Seminar Lainnya</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress') == 11)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="berkas-seminar-lainnya" id="berkas-seminar-lainnya" onchange="showSelectedFile('#berkas-seminar-lainnya-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="berkas-seminar-lainnya" id="berkas-seminar-lainnya-label">Pilih File</label>
					</div>
				@elseif ($administrasi_tga->value('progress') == 12)
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($administrasi_tga->value('progress') > 12)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="berkas-seminar-lainnya" id="berkas-seminar-lainnya" onchange="showSelectedFile('#berkas-seminar-lainnya-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="berkas-seminar-lainnya" id="berkas-seminar-lainnya-label">Pilih File</label>
					</div>
				@endif
			</td>
		</tr>

		@if ($administrasi_tga->value('progress') < 11)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<button class="btn btn-block btn-secondary" disabled="disabled">Kirim ke Koordinator Prodi</button>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') == 11)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<button class="btn btn-block btn-success">Kirim ke Koordinator Prodi</button>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') > 12)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>