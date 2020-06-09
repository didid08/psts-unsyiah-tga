<table width="100%" class="table table-bordered{{ formBackground(1, 3, $administrasi_tga) }}">
	<tbody>
		@if (in_array($administrasi_tga->value('progress'), range(2, 3)) && $administrasi_tga->value('repeat'))
			@php
				$penolak;
				if ($administrasi_tga->value('progress') == 2) {
					$penolak = 'Admin';
				} elseif ($administrasi_tga->value('progress') == 3) {
					$penolak = 'Koordinator Prodi';
				}
			@endphp
			<tr>
				<td colspan="3" class="text-center align-middle">
					<div class="alert alert-danger text-left font-italic" role="alert">
					  <b>Kesalahan!</b> Pengajuan anda ditolak oleh "{{ $penolak }}"
					</div>
				</td>
			</tr>
		@endif
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">SPP</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(2,3)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<input type="file">
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">KRS</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(2,3)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<input type="file">
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle">Transkrip Sementara</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(2,3)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<input type="file">
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">4.</td>
			<td class="align-middle">KHS</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') > 3)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if (in_array($administrasi_tga->value('progress'), range(2,3)) && $administrasi_tga->value('repeat') == false)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<input type="file">
					@endif
				@endif
			</td>
		</tr>
		@if ($administrasi_tga->value('progress') == 1)
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		@elseif (in_array($administrasi_tga->value('progress'), range(1, 3)) && $administrasi_tga->value('repeat'))
			<tr>
				<td colspan="2"></td>
				<td class="text-center align-middle">
					<button type="submit" class="btn btn-sm btn-warning">Perbaiki</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>