<table width="100%" class="table table-bordered{{ formBackground(1, 3, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">SPP</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if ($administrasi_tga->value('progress') == 2 && $administrasi_tga->value('repeat') == false)
						<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
					@elseif ($administrasi_tga->value('progress') == 3 && $administrasi_tga->value('repeat') == false)
						<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh koor prodi</span>
					@elseif ($administrasi_tga->value('repeat') == true)
						<span><i class="fa fa-times-circle text-danger"></i>&nbsp;&nbsp;Belum diperbaiki</span>
					@else
						<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td class="align-middle">KRS</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if ($administrasi_tga->value('progress') == 2 && $administrasi_tga->value('repeat') == false)
						<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
					@elseif ($administrasi_tga->value('progress') == 3 && $administrasi_tga->value('repeat') == false)
						<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh koor prodi</span>
					@elseif ($administrasi_tga->value('repeat') == true)
						<span><i class="fa fa-times-circle text-danger"></i>&nbsp;&nbsp;Belum diperbaiki</span>
					@else
						<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">3.</td>
			<td class="align-middle">Transkrip Sementara</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if ($administrasi_tga->value('progress') == 2 && $administrasi_tga->value('repeat') == false)
						<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
					@elseif ($administrasi_tga->value('progress') == 3 && $administrasi_tga->value('repeat') == false)
						<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh koor prodi</span>
					@elseif ($administrasi_tga->value('repeat') == true)
						<span><i class="fa fa-times-circle text-danger"></i>&nbsp;&nbsp;Belum diperbaiki</span>
					@else
						<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">4.</td>
			<td class="align-middle">KHS</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if ($administrasi_tga->value('progress') == 2 && $administrasi_tga->value('repeat') == false)
						<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
					@elseif ($administrasi_tga->value('progress') == 3 && $administrasi_tga->value('repeat') == false)
						<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh koor prodi</span>
					@elseif ($administrasi_tga->value('repeat') == true)
						<span><i class="fa fa-times-circle text-danger"></i>&nbsp;&nbsp;Belum diperbaiki</span>
					@else
						<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
					@endif
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') == 2 && $administrasi_tga->value('repeat') == false)
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim ke Koordinator Prodi</button>
					<button type="submit" class="btn btn-sm btn-danger">Tolak</button>
				</td>
			</tr>
		@endif

		@if ($administrasi_tga->value('progress') > 3)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>