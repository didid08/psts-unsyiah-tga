<table width="100%" class="table table-bordered{{ formBackground(31, 32, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td colspan="2" class="align-middle text-left">
				Pembimbing dan Pembahas telah menerima Hard/Softcopy SK
			</td>
		</tr>

		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Lembar Pengesahan dan Buku Laporan KP (jika diperlukan)</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 32)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif (in_array($disposisi->progress, range(32,32)))
					<span class="text-warning">Sedang diproses</span>
				@elseif ($disposisi->progress == 31)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@else
					--
				@endif
			</td>
		</tr>
		
		<tr>
			<td class="align-middle"></td>
			<td colspan="2" class="align-middle text-left">
				Email Pembimbing dan Pembahas cek di: <br>
				<a href="https://unsyiah.ac.id/faculty-and-staff" target="_blank">https://unsyiah.ac.id/faculty-and-staff</a>
			</td>
		</tr>
	</tbody>
</table>