<table width="100%" class="table table-bordered{{ formBackground(11, 12, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle font-weight-bold">SK Komisi Penguji Seminar Proposal</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress') > 12)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">No</td>
			<td class="text-center align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(11,12)) && $administrasi_tga->value('repeat') == false)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('progress') > 12)
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
				@if (in_array($administrasi_tga->value('progress'), range(11,12)) && $administrasi_tga->value('repeat') == false)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('progress') > 12)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle font-weight-bold">Undangan Seminar</td>
			<td class="align-middle text-center">
				@if (in_array($administrasi_tga->value('progress'), range(11,12)) && $administrasi_tga->value('repeat') == false)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('progress') > 12)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle font-weight-bold">Berkas Seminar Lainnya</td>
			<td class="align-middle text-center">
				@if (in_array($administrasi_tga->value('progress'), range(11,12)) && $administrasi_tga->value('repeat') == false)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('progress') > 12)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					--
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') > 12)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>