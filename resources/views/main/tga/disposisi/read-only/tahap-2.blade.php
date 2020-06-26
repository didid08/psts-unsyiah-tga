<table width="100%" class="table table-bordered{{ formBackground(4, 4, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">Nama Pembimbing</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(4,4)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 4)
					@if (isset($mahasiswa_data_tga->pembimbing))
						@if ($mahasiswa_data_tga->pembimbing->verified == true)
							<input type="text" class="form-control bg-light" readonly="readonly" value="{{ $mahasiswa_data_tga->pembimbing->content }}">
						@else
							<span class="text-warning">sedang diubah</span>
						@endif
					@else
						<span class="text-warning">sedang diubah</span>
					@endif
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
					@if (isset($mahasiswa_data_tga->co_pembimbing))
						@if ($mahasiswa_data_tga->co_pembimbing->verified == true)
							<input type="text" class="form-control bg-light" readonly="readonly" value="{{ $mahasiswa_data_tga->co_pembimbing->content }}">
						@else
							<span class="text-warning">sedang diubah</span>
						@endif
					@else
						<span class="text-warning">sedang diubah</span>
					@endif
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
					<textarea class="form-control bg-light" readonly="readonly">{{ $mahasiswa_data_tga->judul_tga->content }}</textarea>
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>