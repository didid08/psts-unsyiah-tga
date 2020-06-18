<table width="100%" class="table table-bordered table-striped{{ ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26) ? '' : formBackgroundOptional(1, 3, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td colspan="3" class="align-middle">Pengajuan Surat Tugas Pengambilan Data Lab/Lapangan (<span class="text-red">opsional</span>)</td>
		</tr>
		<tr>
			<td class="align-middle">Surat Permohonan Tugas Pengambilan Data</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress_optional') == 0 || ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26))
					--
				@elseif ($administrasi_tga->value('progress_optional') == 1)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress_optional') == 2)
					<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh admin</span>
				@elseif ($administrasi_tga->value('progress_optional') == 3)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@else
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
				@endif
			</td>
			@if ($administrasi_tga->value('progress_optional') == 3)
				<td class="text-center align-middle">
					<button class="btn btn-sm btn-success">Terima</button>
				</td>
			@endif
		</tr>
	</tbody>
</table>