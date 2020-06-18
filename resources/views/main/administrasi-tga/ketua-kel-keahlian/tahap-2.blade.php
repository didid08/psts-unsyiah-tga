<table width="100%" class="table table-bordered{{ formBackground(4, 4, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">Nama Pembimbing</td>
			<td class="text-center align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(4,4)))
					<select name="" id="" class="form-control">
						@foreach ($semua_dosen_bimbingan as $dosen)
							<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
						@endforeach
					</select>
				@elseif ($administrasi_tga->value('progress') > 4)
					<select name="" id="" class="form-control">
						@foreach ($semua_dosen_bimbingan as $dosen)
							<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
						@endforeach
					</select>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td class="align-middle">Nama Co Pembimbing</td>
			<td class="text-center align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(4,4)))
					<select name="" id="" class="form-control">
						@foreach ($semua_dosen_co_bimbingan as $dosen)
							<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
						@endforeach
					</select>
				@elseif ($administrasi_tga->value('progress') > 4)
					<select name="" id="" class="form-control">
						@foreach ($semua_dosen_bimbingan as $dosen)
							<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
						@endforeach
					</select>
				@else
					--
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') == 4)
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<a target="_blank" href="{{ route('main.info-dosen', ['category' => $category]) }}" class="btn btn-sm btn-outline-secondary">Lihat Info Dosen</a>
					<button type="submit" class="btn btn-sm btn-success">Tetapkan</button>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') > 4)
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<a target="_blank" href="{{ route('main.info-dosen', ['category' => $category]) }}" class="btn btn-sm btn-outline-success">Lihat Info Dosen</a>
					<button type="submit" class="btn btn-sm btn-success">Ubah</button>
				</td>
			</tr>
		@endif
		<tr>
			<td class="align-middle text-center">3.</td>
			<td class="align-middle">Rencana Judul TGA</td>
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