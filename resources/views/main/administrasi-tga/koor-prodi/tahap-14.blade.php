<table width="100%" class="table table-bordered{{ formBackground(28, 30, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Berita Acara Sidang Buku</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 28)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 29)
					<span class="text-yellow">Sedang diperiksa oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 30)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress') > 30)
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
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
					<span class="text-yellow">Sedang diperiksa oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 30)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress') > 30)
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
				@else
					--
				@endif
			</td>
		</tr>
		
		@if ($administrasi_tga->value('progress') == 30)
			<tr>
				<td colspan="3" class="text-right align-middle">
					<button type="submit" class="btn btn-success">Terima</button>
					<button type="submit" class="btn btn-danger">Tolak</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>