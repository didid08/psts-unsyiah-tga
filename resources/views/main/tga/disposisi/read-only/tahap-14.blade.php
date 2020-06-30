<table width="100%" class="table table-bordered{{ formBackground(28, 30, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Berita Acara Sidang Buku</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 28)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($disposisi->progress == 29)
					<span class="text-yellow">Sedang diperiksa oleh Admin</span>
				@elseif ($disposisi->progress == 30)
					<span class="text-yellow">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($disposisi->progress > 30)
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Buku TGA</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 28)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($disposisi->progress == 29)
					<span class="text-yellow">Sedang diperiksa oleh Admin</span>
				@elseif ($disposisi->progress == 30)
					<span class="text-yellow">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($disposisi->progress > 30)
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>