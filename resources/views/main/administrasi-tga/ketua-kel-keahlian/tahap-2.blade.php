<table width="100%" class="table table-bordered{{ formBackground(4, 4, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">Nama Pembimbing</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 4 && $administrasi_tga->value('progress') < 26)
					<select name="" id="" class="form-control">
						@foreach ($semua_dosen_bimbingan as $dosen)
							<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
						@endforeach
					</select>	
				@elseif ($administrasi_tga->value('progress') > 4 && $administrasi_tga->value('progress') < 26)
					<select name="" id="" class="form-control">
						@foreach ($semua_dosen_bimbingan as $dosen)
							<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
						@endforeach
					</select>
				@elseif ($administrasi_tga->value('progress') == 26)
					<input type="text" value="--" class="form-control bg-light" readonly="readonly">	
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td class="align-middle">Nama Co Pembimbing</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 4 && $administrasi_tga->value('progress') < 26)
					<select name="" id="" class="form-control">
						@foreach ($semua_dosen_co_bimbingan as $dosen)
							<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
						@endforeach
					</select>
				@elseif ($administrasi_tga->value('progress') > 4 && $administrasi_tga->value('progress') < 26)
					<select name="" id="" class="form-control">
						@foreach ($semua_dosen_co_bimbingan as $dosen)
							<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
						@endforeach
					</select>
				@elseif ($administrasi_tga->value('progress') == 26)
					<input type="text" value="--" class="form-control bg-light" readonly="readonly">	
				@else
					--
				@endif
			</td>
		</tr>
	
		@if ($administrasi_tga->value('progress') == 4)
			<tr>
				<td colspan="2" class="align-middle"></td>
				<td class="text-center align-middle">
					<button type="submit" class="btn btn-block btn-success mb-2">Tetapkan</button>
					<small>Catatan: <i>Pastikan dosen yang anda pilih telah <b>setuju</b> dijadikan pembimbing/co</i></small>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') > 4 && $administrasi_tga->value('progress') < 26)
			<tr>
				<td colspan="2" class="align-middle"></td>
				<td class="text-center align-middle">
					<button type="submit" class="btn btn-block btn-success">Ubah</button>
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

@if ($administrasi_tga->value('progress') >= 4 && $administrasi_tga->value('progress') < 26)
	<table class="table table-borderless{{ $administrasi_tga->value('progress') > 4 ? '' : ' table-light' }} mt-3">
		<tr>
			<td class="text-right align-middle">
				<i class="fa fa-question-circle text-info"></i>&nbsp;&nbsp;Bantuan :
			</td>
			<td class="text-right align-middle">
				<button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#usulkan-pembimbing-co">Usulkan Pembimbing dan Co</button>
				
			</td>
		</tr>
	</table>
@endif