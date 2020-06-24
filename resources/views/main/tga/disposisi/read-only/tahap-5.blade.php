<table width="100%" class="table table-bordered{{ formBackground(8, 10, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Lembar Asistensi (Setuju Diseminarkan)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 10)
					<span class="text-success"><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Disetujui</span>
				@elseif ($administrasi_tga->value('progress') > 10)
					@if (isset($roles->koor_prodi))
						<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
					@else
						<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
					@endif
				@elseif ($administrasi_tga->value('progress') == 9)
					<span class="text-yellow">Sedang diperiksa oleh admin</span>
				@else
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Draft Buku Proposal</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 10)
					<span class="text-success"><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Disetujui</span>
				@elseif ($administrasi_tga->value('progress') > 10)
					@if (isset($roles->koor_prodi))
						<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
					@else
						<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
					@endif
				@elseif ($administrasi_tga->value('progress') == 9)
					<span class="text-yellow">Sedang diperiksa oleh admin</span>
				@else
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') == 10)
			<tr class="bg-warning">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') > 10)
			<tr>
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar
				</td>
			</tr>
		@else
			<tr class="text-muted">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar
				</td>
			</tr>
		@endif
	</tbody>
</table>