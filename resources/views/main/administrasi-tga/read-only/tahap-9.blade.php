<table width="100%" class="table table-bordered{{ formBackground(18, 19, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Kelengkapan Dokumen Administrasi Seminar Proposal (Daftar Hadir Seminar)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 18)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 19)
					<span class="text-yellow">Sedang diperiksa oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') > 19)
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
				@else
					--
				@endif
			</td>
		</tr>
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