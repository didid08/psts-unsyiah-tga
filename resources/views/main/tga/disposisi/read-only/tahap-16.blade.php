<table width="100%" class="table table-bordered{{ formBackground(34, 36, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Kelengkapan Dokumen Administrasi Sidang Buku (Lembar Pengesahan, Lembar Acc)</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 36)
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
				@elseif ($disposisi->progress == 34)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($disposisi->progress == 35)
					<span class="text-warning">Sedang diperiksa oleh Admin</span>
				@elseif ($disposisi->progress == 36)
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
				@if ($disposisi->progress > 36)
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
				@elseif ($disposisi->progress == 34)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($disposisi->progress == 35)
					<span class="text-warning">Sedang diperiksa oleh Admin</span>
				@elseif ($disposisi->progress == 36)
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@else
					--
				@endif
			</td>
		</tr>
		
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