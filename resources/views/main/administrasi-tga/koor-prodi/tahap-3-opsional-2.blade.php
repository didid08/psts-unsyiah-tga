<table width="100%" class="table table-bordered table-striped{{ ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26) ? '' : formBackgroundOptional(4, 5, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle"><b>Surat Tugas Pengambilan Data Lab/Lapangan</b></td>
			<td class="align-middle text-center">
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">No</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress_optional') < 4)
					<span class="text-muted">--</span>
				@elseif ($administrasi_tga->value('progress_optional') == 4  && $administrasi_tga->value('progress') < 26)
					<span class="text-warning">Sedang diproses oleh Admin</span>
				@elseif ($administrasi_tga->value('progress_optional') == 5 && $administrasi_tga->value('progress') < 26)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@elseif ($administrasi_tga->value('progress_optional') > 5)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">	
				@elseif ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26)
					<span class="text-muted">--</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">Tgl</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress_optional') < 4)
					<span class="text-muted">--</span>
				@elseif ($administrasi_tga->value('progress_optional') == 4  && $administrasi_tga->value('progress') < 26)
					<span class="text-warning">Sedang diproses oleh Admin</span>
				@elseif ($administrasi_tga->value('progress_optional') == 5 && $administrasi_tga->value('progress') < 26)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@elseif ($administrasi_tga->value('progress_optional') > 5)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">	
				@elseif ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26)
					<span class="text-muted">--</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">Berkas</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress_optional') < 4)
					<span class="text-muted">--</span>
				@elseif ($administrasi_tga->value('progress_optional') == 4 && $administrasi_tga->value('progress') < 26)
					<span class="text-warning">Sedang diproses oleh Admin</span>
				@elseif ($administrasi_tga->value('progress_optional') == 5 && $administrasi_tga->value('progress') < 26)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress_optional') > 5)
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
				@elseif ($administrasi_tga->value('progress_optional') < 6 && $administrasi_tga->value('progress') >= 26)
					<span class="text-muted">--</span>
				@endif
			</td>
		</tr>

		@if ($administrasi_tga->value('progress_optional') == 5 && $administrasi_tga->value('progress') < 26)
			<tr>
				<td colspan="2"></td>
				<td class="align-middle text-center">
					<button class="btn btn-sm btn-success">Terima</button>
					<button class="btn btn-sm btn-danger">Tolak</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>