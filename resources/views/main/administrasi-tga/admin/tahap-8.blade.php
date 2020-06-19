<table width="100%" class="table table-bordered{{ formBackground(15, 17, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Berita Acara Seminar Proposal</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 15)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 16)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress') == 17)
					<span class="text-yellow">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($administrasi_tga->value('progress') > 17)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Buku Proposal</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 15)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 16)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
				@elseif ($administrasi_tga->value('progress') == 17)
					<span class="text-yellow">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($administrasi_tga->value('progress') > 17)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					--
				@endif
			</td>
		</tr>
		
		@if ($administrasi_tga->value('progress') == 16)
			<tr>
				<td colspan="3" class="text-right align-middle">
					<button type="submit" class="btn btn-success">Kirim ke Koordinator Prodi</button>
					<button type="submit" class="btn btn-danger">Tolak</button>
				</td>
			</tr>
		@endif

		@if ($administrasi_tga->value('progress') > 17)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>