<table width="100%" class="table table-bordered{{ formBackground(5, 6, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle font-weight-bold">SK Penunjukan Pembimbing</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress') > 6)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">No</td>
			<td class="text-center align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(5,6)) && $administrasi_tga->value('repeat') == false)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('progress') > 6)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">Tgl</td>
			<td class="text-center align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(5,6)) && $administrasi_tga->value('repeat') == false)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('progress') > 6)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>