<table width="100%" class="table table-bordered table-striped{{ ($disposisi->progress_optional < 6 && $disposisi->progress >= 26) ? '' : formBackgroundOptional(1, 3, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="3" class="align-middle">Pengajuan Surat Tugas Pengambilan Data Lab/Lapangan (<span class="text-red">opsional</span>)</td>
		</tr>
		<tr>
			<td class="align-middle">Surat Permohonan Tugas Pengambilan Data</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress_optional == 0 || ($disposisi->progress_optional < 6 && $disposisi->progress >= 26))
					--
				@elseif ($disposisi->progress_optional == 1)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif (in_array($disposisi->progress_optional, [2,3]))
					<span class="text-yellow">sedang diproses</span>
				@else
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Ada</span>
				@endif
			</td>
		</tr>
	</tbody>
</table>