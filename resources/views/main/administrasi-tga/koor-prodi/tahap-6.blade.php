<table width="100%" class="table table-bordered{{ formBackground(11, 12, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle font-weight-bold">SK Komisi Penguji Seminar Proposal</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress') > 12)
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
				@elseif ($administrasi_tga->value('progress') == 11)
					<span class="text-warning">Sedang diproses oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 12)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">No</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 11)
					<span class="text-warning">Sedang diproses oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 12)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
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
				@if ($administrasi_tga->value('progress') == 11)
					<span class="text-warning">Sedang diproses oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 12)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
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
				@if ($administrasi_tga->value('progress') > 12)
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
				@elseif ($administrasi_tga->value('progress') == 11)
					<span class="text-warning">Sedang diproses oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 12)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle font-weight-bold">Berkas Seminar Lainnya</td>
			<td class="align-middle text-center">
				@if ($administrasi_tga->value('progress') > 12)
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
				@elseif ($administrasi_tga->value('progress') == 11)
					<span class="text-warning">Sedang diproses oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 12)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@else
					--
				@endif
			</td>
		</tr>

		@if ($administrasi_tga->value('progress') == 12)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<button class="btn btn-success">Terima</button>
					<button class="btn btn-danger">Tolak</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>