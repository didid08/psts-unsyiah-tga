<table width="100%" class="table table-bordered{{ formBackground(1, 3, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">SPP</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
				@else
					@if ($administrasi_tga->value('progress') == 2)
						<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh Admin</span>
					@elseif ($administrasi_tga->value('progress') == 3)
						<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
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
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
				@else
					@if ($administrasi_tga->value('progress') == 2)
						<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh Admin</span>
					@elseif ($administrasi_tga->value('progress') == 3)
						<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
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
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
				@else
					@if ($administrasi_tga->value('progress') == 2)
						<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh Admin</span>
					@elseif ($administrasi_tga->value('progress') == 3)
						<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
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
					<a href="#" class="btn btn-sm btn-outline-success">Lihat</a>
				@else
					@if ($administrasi_tga->value('progress') == 2)
						<span><i class="fa fa-sync-alt text-yellow"></i>&nbsp;&nbsp;Sedang diperiksa oleh Admin</span>
					@elseif ($administrasi_tga->value('progress') == 3)
						<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Periksa</a>)</span>
					@else
						<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
					@endif
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') == 3)
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<button type="submit" class="btn btn-sm btn-success">Terima</button>
					<button type="submit" class="btn btn-sm btn-danger">Tolak</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>