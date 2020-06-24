<table width="100%" class="table table-bordered{{ formBackground(1, 3, $disposisi) }}">
	<tbody>
		@if ($disposisi->progress == 1)
			<form action="#" method="post" enctype="multipart/form-data">
		@endif
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
					<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i>&nbsp;&nbsp;&nbsp;&nbsp;Belum ada
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">2.</td>
			<td class="align-middle">KRS</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 1)
					<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i>&nbsp;&nbsp;&nbsp;&nbsp;Belum ada
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">3.</td>
			<td class="align-middle">KHS</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 1)
					<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i>&nbsp;&nbsp;&nbsp;&nbsp;Belum ada
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle text-center">4.</td>
			<td class="align-middle">Transkrip Sementara</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 1)
					<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i>&nbsp;&nbsp;&nbsp;&nbsp;Belum ada
				@endif
			</td>
		</tr>

		@if ($disposisi->progress > 3)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif

		@if ($disposisi->progress == 1)
			</form>
		@endif
	</tbody>
</table>