<table width="230%" class="table table-bordered{{ formBackground(21, 23, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Lembar Asistensi (Setuju Disidangkan)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 23)
					<span class="text-success"><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Disetujui</span>
				@elseif ($administrasi_tga->value('progress') > 23)
					@if (isset($roles->koor_prodi))
						<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
					@else
						<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
					@endif
				@elseif ($administrasi_tga->value('progress') == 22)
					<span class="text-yellow">Sedang diperiksa oleh admin</span>
				@else
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Draft Buku TGA</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 23)
					<span class="text-success"><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Disetujui</span>
				@elseif ($administrasi_tga->value('progress') > 23)
					@if (isset($roles->koor_prodi))
						<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
					@else
						<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
					@endif
				@elseif ($administrasi_tga->value('progress') == 22)
					<span class="text-yellow">Sedang diperiksa oleh admin</span>
				@else
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') == 23)
			<tr class="bg-warning">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Sidang Buku
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') > 23)
			<tr>
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Sidang Buku
				</td>
			</tr>
		@else
			<tr class="text-muted">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Sidang Buku
				</td>
			</tr>
		@endif
	</tbody>
</table>