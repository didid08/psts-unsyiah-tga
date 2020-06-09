<table width="100%" class="table table-bordered table-striped{{ formBackgroundOptional(4, 5, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Surat Tugas Pengambilan Data Lab/Lapangan</td>
			<td class="align-middle"></td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">No <span style="float: right;">:</span></td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress_optional') < 4)
					--
				@elseif ($administrasi_tga->value('progress_optional') > 5)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">	
				@else
					<span class="text-warning">sedang diproses</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">Tgl <span style="float: right;">:</span></td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress_optional') < 4)
					--
				@elseif ($administrasi_tga->value('progress_optional') > 5)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">	
				@else
					<span class="text-warning">sedang diproses</span>
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress_optional') > 5)
			<tr>
				<td></td>
				<td class="align-middle text-center">
					<a href="#" class="btn btn-sm btn-success">Unduh Surat Tugas Pengambilan Data</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>