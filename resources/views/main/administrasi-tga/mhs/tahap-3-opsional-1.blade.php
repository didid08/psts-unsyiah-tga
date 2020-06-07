<table width="100%" class="table table-bordered table-striped{{ in_array($administrasi_tga->value('disposition_optional'), [1,2,3]) ? ' table-light' : '' }}">
	<tbody>
		<tr>
			<td colspan="3" class="align-middle">Pengajuan Surat Tugas Pengambilan Data Lab/Lapangan (<span class="text-red">opsional</span>)</td>
		</tr>
		<tr>
			<td class="align-middle">Surat Permohonan Tugas Pengambilan Data</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('disposition_optional') == 0)
					<input type="file" disabled="disabled">
				@elseif ($administrasi_tga->value('disposition_optional') == 1)
					<input type="file">
				@elseif (in_array($administrasi_tga->value('disposition_optional'), [2,3]))
					<span class="text-yellow">sedang diperiksa</span>
				@else
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@endif
			</td>
			@if ($administrasi_tga->value('disposition_optional') == 0)
				<td class="text-center align-middle">
					<button class="btn btn-sm btn-success" disabled="disabled">Kirim</button>
				</td>
			@elseif ($administrasi_tga->value('disposition_optional') == 1)
				<td class="text-center align-middle">
					<button class="btn btn-sm btn-success">Kirim</button>
				</td>
			@endif
		</tr>
	</tbody>
</table>