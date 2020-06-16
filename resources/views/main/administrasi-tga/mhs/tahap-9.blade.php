<table width="100%" class="table table-bordered{{ formBackground(18, 19, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Kelengkapan Dokumen Administrasi Seminar Proposal (Daftar Hadir Seminar)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 19)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(19,19)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="kelengkapan-dokumen-administrasi-seminar-proposal" id="kelengkapan-dokumen-administrasi-seminar-proposal" onchange="showSelectedFile('#kelengkapan-dokumen-administrasi-seminar-proposal-label', event)" accept="application/pdf" {!! in_array($administrasi_tga->value('progress'), range(18,19)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="kelengkapan-dokumen-administrasi-seminar-proposal" id="kelengkapan-dokumen-administrasi-seminar-proposal-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		
		@if ($administrasi_tga->value('progress') < 18)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="button" class="btn btn-sm btn-secondary" disabled="disabled">Kirim</button>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') == 18)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		@elseif (in_array($administrasi_tga->value('progress'), range(19, 19)) && $administrasi_tga->value('repeat'))
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="submit" class="btn btn-sm btn-warning">Perbaiki</button>
				</td>
			</tr>
		@endif
		
		<tr>
			<td class="align-middle">2.</td>
			<td colspan="2" class="align-middle text-left">
				Softcopy Administrasi Seminar Proposal dikirim ke: <br>
				<ul style="list-style-type: square;">
					<li>Nama File:&nbsp;&nbsp;<b>NIM_Proposal.zip</b></li>
					<li>Email Administrasi:&nbsp;&nbsp;<a href="mailto:jtspsts{!! '@' !!}gmail.com">jtspsts&commat;gmail.com</a></li>
				</ul>
			</td>
		</tr>
	</tbody>
</table>