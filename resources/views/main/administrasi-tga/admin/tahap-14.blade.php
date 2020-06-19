<table width="100%" class="table table-bordered{{ formBackground(28, 30, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Berita Acara Sidang Buku</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 28)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 29)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress') == 30)
					<span class="text-yellow">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($administrasi_tga->value('progress') > 30)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Buku TGA</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 28)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 29)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress') == 30)
					<span class="text-yellow">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($administrasi_tga->value('progress') > 30)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					--
				@endif
			</td>
		</tr>
		
		@if ($administrasi_tga->value('progress') == 29)
			<tr>
				<td colspan="3" class="text-right align-middle">
					<button type="submit" class="btn btn-success">Kirim ke Koordinator Prodi</button>
					<button type="submit" class="btn btn-danger">Tolak</button>
				</td>
			</tr>
		@endif

		@if ($administrasi_tga->value('progress') > 30)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>