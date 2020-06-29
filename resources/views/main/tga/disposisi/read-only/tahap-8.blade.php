<table width="100%" class="table table-bordered{{ formBackground(15, 17, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Berita Acara Seminar Proposal</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 15)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($disposisi->progress == 16)
					<span class="text-yellow">Sedang diperiksa oleh Admin</span>
				@elseif ($disposisi->progress == 17)
					<span class="text-yellow">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($disposisi->progress > 17)
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Buku Proposal</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress == 15)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($disposisi->progress == 16)
					<span class="text-yellow">Sedang diperiksa oleh Admin</span>
				@elseif ($disposisi->progress == 17)
					<span class="text-yellow">Sedang diperiksa oleh Koordinator Prodi</span>
				@elseif ($disposisi->progress > 17)
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Ada</span>
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>