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
				@if ($administrasi_tga->value('progress') == 5)
					<input type="text" class="form-control bg-light" placeholder="Masukkan nomor">
				@elseif ($administrasi_tga->value('progress') == 6)
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
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
				@if ($administrasi_tga->value('progress') == 5)
					<input type="date" class="form-control bg-light">
				@elseif ($administrasi_tga->value('progress') == 6)
					<span class="text-warning">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($administrasi_tga->value('progress') > 6)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') == 5)
			<tr>
				<td colspan="2" class="align-middle"></td>
				<td class="text-center align-middle">
					<button class="btn btn-sm btn-success">Kirim ke Koordinator Prodi</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>