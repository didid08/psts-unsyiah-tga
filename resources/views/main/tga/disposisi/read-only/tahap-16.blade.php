<table width="100%" class="table table-bordered{{ formBackground(33, 35, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Kelengkapan Dokumen Administrasi Sidang Buku (Lembar Pengesahan, Lembar Acc)</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 33)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress == 33)
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>

		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Kelengkapan Dokumen Yudisium dan Wisuda</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 33)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress == 33)
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3">Belum ada</span>
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