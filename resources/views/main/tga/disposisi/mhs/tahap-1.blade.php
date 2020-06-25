<table width="100%" class="table table-bordered{{ formBackground(1, 3, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="3" class="align-middle text-left">
				<a href="{{ route('main.tga.mahasiswa.input-usul') }}" class="btn btn-light">Input Usul TGA</a>
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">1.</td>
			<td class="align-middle">SPP</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 1)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 1)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td class="align-middle">KRS</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 1)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 1)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">3.</td>
			<td class="align-middle">KHS</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 1)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 1)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">4.</td>
			<td class="align-middle">Transkrip Sementara</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 1)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 1)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">5.</td>
			<td class="align-middle">Foto</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 1)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 1)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
	</tbody>
</table>