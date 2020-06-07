<table width="100%" class="table table-bordered{{ $administrasi_tga->value('tahap') == 2 ? ' table-light' : '' }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle font-italic">Nama Pembimbing <span style="float: right;">:</span></td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('tahap') == 2)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('tahap') > 2)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle font-italic">Nama Co Pembimbing <span style="float: right;">:</span></td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('tahap') == 2)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('tahap') > 2)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle font-italic">Rencana Judul TGA <span style="float: right;">:</span></td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('tahap') >= 2)
					<textarea class="form-control bg-light" readonly="readonly">{{ $mahasiswa_data_tga->judul_tga->content }}</textarea>
				@else
					--
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('tahap') >= 2)
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<a href="#" class="btn btn-sm btn-light">Unduh Disposisi</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>