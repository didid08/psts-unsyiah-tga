<table width="100%" class="table table-bordered{{ formBackground(4, 4, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Nama Pembimbing <span style="float: right;">:</span></td>
			<td class="text-center align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(4,4)) && $administrasi_tga->value('repeat') == false)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('progress') > 4)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Nama Co Pembimbing <span style="float: right;">:</span></td>
			<td class="text-center align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(4,4)) && $administrasi_tga->value('repeat') == false)
					<span class="text-warning">sedang diproses</span>
				@elseif ($administrasi_tga->value('progress') > 4)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle">Rencana Judul TGA <span style="float: right;">:</span></td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') >= 4)
					<textarea class="form-control bg-light" readonly="readonly">{{ $mahasiswa_data_tga->judul_tga->content }}</textarea>
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>