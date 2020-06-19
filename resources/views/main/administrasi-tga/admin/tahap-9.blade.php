<table width="100%" class="table table-bordered{{ formBackground(18, 19, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Kelengkapan Dokumen Administrasi Seminar Proposal (Daftar Hadir Seminar)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 18)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 19)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress') > 19)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					--
				@endif
			</td>
		</tr>
		
		@if ($administrasi_tga->value('progress') == 19)
			<tr>
				<td colspan="3" class="text-right align-middle">
					<button class="btn btn-success">Terima</button>
					<button class="btn btn-danger">Tolak</button>
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