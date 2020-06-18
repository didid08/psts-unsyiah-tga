<table width="100%" class="table table-bordered{{ formBackground(34, 36, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Kelengkapan Dokumen Administrasi Sidang Buku (Lembar Pengesahan, Lembar Acc)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 36)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(35,36)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="kelengkapan-dokumen-administrasi-sidang-buku" id="kelengkapan-dokumen-administrasi-sidang-buku" onchange="showSelectedFile('#kelengkapan-dokumen-administrasi-sidang-buku-label', event)" accept="application/zip" {!! in_array($administrasi_tga->value('progress'), range(34,36)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="kelengkapan-dokumen-administrasi-sidang-buku" id="kelengkapan-dokumen-administrasi-sidang-buku-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>

		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Kelengkapan Dokumen Yudisium dan Wisuda</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 36)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(35,36)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="kelengkapan-dokumen-yudisium-dan-wisuda" id="kelengkapan-dokumen-yudisium-dan-wisuda" onchange="showSelectedFile('#kelengkapan-dokumen-yudisium-dan-wisuda-label', event)" accept="application/zip" {!! in_array($administrasi_tga->value('progress'), range(34,36)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="kelengkapan-dokumen-yudisium-dan-wisuda" id="kelengkapan-dokumen-yudisium-dan-wisuda-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		
		@if ($administrasi_tga->value('progress') < 34)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="button" class="btn btn-sm btn-secondary" disabled="disabled">Kirim</button>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') == 34)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		@endif
		
		<tr>
			<td class="align-middle">3.</td>
			<td colspan="2" class="align-middle text-left">
				Softcopy Dokumen Administrasi Sidang Buku dikirim ke: <br>
				<ul style="list-style-type: square;">
					<li>Nama File:&nbsp;&nbsp;<b>NIM_Proposal.zip</b></li>
					<li>Email Administrasi:&nbsp;&nbsp;<a href="mailto:jtspsts{!! '@' !!}gmail.com">jtspsts&commat;gmail.com</a></li>
				</ul>
			</td>
		</tr>
	</tbody>
</table>