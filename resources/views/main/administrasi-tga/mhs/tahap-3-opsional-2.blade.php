<table width="100%" class="table table-bordered table-striped{{ ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26) ? '' : formBackgroundOptional(4, 5, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Surat Tugas Pengambilan Data Lab/Lapangan</td>
			<td class="align-middle text-center">
			@if ($administrasi_tga->value('progress_optional') > 5)
				<a href="#" class="btn btn-sm btn-success">Unduh</a>
			@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">No</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress_optional') < 4)
					<span class="text-muted">--</span>
				@elseif ($administrasi_tga->value('progress_optional') > 5)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">	
				@elseif ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26)
					<span class="text-muted">--</span>
				@else
					<span class="text-warning">sedang diproses</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">Tgl</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress_optional') < 4)
					<span class="text-muted">--</span>
				@elseif ($administrasi_tga->value('progress_optional') > 5)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">	
				@elseif ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26)
					<span class="text-muted">--</span>
				@else
					<span class="text-warning">sedang diproses</span>
				@endif
			</td>
		</tr>
	</tbody>
</table>