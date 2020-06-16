<table width="100%" class="table table-bordered{{ formBackground(1, 3, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">SPP</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 1)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 2 && $administrasi_tga->value('repeat') == false)
					<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 3 && $administrasi_tga->value('repeat') == false)
					<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh koor prodi</span>
				@elseif ($administrasi_tga->value('repeat') == true)
					<span><i class="fa fa-times-circle text-danger"></i>&nbsp;&nbsp;Belum diperbaiki</span>
				@else
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td class="align-middle">KRS</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 1)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 2 && $administrasi_tga->value('repeat') == false)
					<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 3 && $administrasi_tga->value('repeat') == false)
					<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh koor prodi</span>
				@elseif ($administrasi_tga->value('repeat') == true)
					<span><i class="fa fa-times-circle text-danger"></i>&nbsp;&nbsp;Belum diperbaiki</span>
				@else
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">3.</td>
			<td class="align-middle">Transkrip Sementara</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 1)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 2 && $administrasi_tga->value('repeat') == false)
					<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 3 && $administrasi_tga->value('repeat') == false)
					<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh koor prodi</span>
				@elseif ($administrasi_tga->value('repeat') == true)
					<span><i class="fa fa-times-circle text-danger"></i>&nbsp;&nbsp;Belum diperbaiki</span>
				@else
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">4.</td>
			<td class="align-middle">KHS</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 1)
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@elseif ($administrasi_tga->value('progress') == 2 && $administrasi_tga->value('repeat') == false)
					<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh Admin</span>
				@elseif ($administrasi_tga->value('progress') == 3 && $administrasi_tga->value('repeat') == false)
					<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh koor prodi</span>
				@elseif ($administrasi_tga->value('repeat') == true)
					<span><i class="fa fa-times-circle text-danger"></i>&nbsp;&nbsp;Belum diperbaiki</span>
				@else
					<span><i class="fa fa-check-circle text-success"></i>&nbsp;&nbsp;Selesai</span>
				@endif
			</td>
		</tr>
	</tbody>
</table>