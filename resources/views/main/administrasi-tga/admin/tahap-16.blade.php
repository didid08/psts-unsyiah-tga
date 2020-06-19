<table width="100%" class="table table-bordered{{ formBackground(34, 36, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Kelengkapan Dokumen Administrasi Sidang Buku (Lembar Pengesahan, Lembar Acc)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 36)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@elseif ($administrasi_tga->value('progress') == 34)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 35)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress') == 36)
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@else
					--
				@endif
			</td>
		</tr>

		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Kelengkapan Dokumen Yudisium dan Wisuda</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 36)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@elseif ($administrasi_tga->value('progress') == 34)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 35)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress') == 36)
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@else
					--
				@endif
			</td>
		</tr>
		
		@if ($administrasi_tga->value('progress') == 35)
			<tr>
				<td colspan="3" class="text-right align-middle">
					<button type="submit" class="btn btn-success">Kirim ke Koordinator Prodi</button>
					<button type="submit" class="btn btn-danger">Tolak</button>
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