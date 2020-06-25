<table width="100%" class="table table-bordered{{ formBackground(4, 4, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">Nama Pembimbing</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(4,4)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 4)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td class="align-middle">Nama Co Pembimbing</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(4,4)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 4)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">3.</td>
			<td class="align-middle">Rencana Judul TGA</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress >= 4)
					<textarea class="form-control bg-light" readonly="readonly">{{ $data->judul_tga->content }}</textarea>
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>