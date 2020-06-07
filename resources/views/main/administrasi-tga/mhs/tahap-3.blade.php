<table width="100%" class="table table-bordered{{ $administrasi_tga->value('tahap') == 3 ? ' table-light' : '' }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle font-weight-bold">SK Penunjukan Pembimbing</td>
			<td class="align-middle"></td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">No <span style="float: right;">:</span></td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('tahap') == 3)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('tahap') > 3)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">Tgl <span style="float: right;">:</span></td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('tahap') == 3)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('tahap') > 3)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('tahap') >= 3)
			<tr>
				<td></td>
				<td class="align-middle text-center">
					<a href="#" class="btn btn-sm btn-success">Unduh SK</a>
				</td>
				<td class="align-middle text-center">
					<a href="#" class="btn btn-sm btn-light">Unduh Disposisi</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>