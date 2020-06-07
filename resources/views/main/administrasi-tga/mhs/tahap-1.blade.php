<table width="100%" class="table table-bordered{{ $administrasi_tga->value('tahap') == 1 ? ' table-light' : '' }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">SPP</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('tahap') > 1)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if ($administrasi_tga->value('disposition') != 1)
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
				@if ($administrasi_tga->value('tahap') > 1)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if ($administrasi_tga->value('disposition') != 1)
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
				@if ($administrasi_tga->value('tahap') > 1)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if ($administrasi_tga->value('disposition') != 1)
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
				@if ($administrasi_tga->value('tahap') > 1)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					@if ($administrasi_tga->value('disposition') != 1)
						<span class="text-warning">sedang diperiksa</span>
					@else
						<input type="file">
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('tahap') == 1)
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				@endif
				<a href="#" class="btn btn-sm btn-light">Unduh Disposisi</a>
			</td>
		</tr>
	</tbody>
</table>