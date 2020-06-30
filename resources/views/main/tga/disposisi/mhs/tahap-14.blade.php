<table width="100%" class="table table-bordered{{ formBackground(28, 30, $disposisi) }}">
	<tbody>
		@if ($disposisi->progress == 28)
			<form action="{{ route('main.tga.mahasiswa.upload-disposisi', ['progress' => 28]) }}" method="post" enctype="multipart/form-data">
				@csrf
		@endif
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Berita Acara Sidang Buku</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 30)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					@if (in_array($disposisi->progress, range(29,30)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="berita-acara-sidang-buku" id="berita-acara-sidang-buku" onchange="showSelectedFile('#berita-acara-sidang-buku-label', event)" accept="application/pdf" {!! in_array($disposisi->progress, range(28,30)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="berita-acara-sidang-buku" id="berita-acara-sidang-buku-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Buku TGA</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 30)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					@if (in_array($disposisi->progress, range(29,30)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="buku-tga" id="buku-tga" onchange="showSelectedFile('#buku-tga-label', event)" accept="application/pdf" {!! in_array($disposisi->progress, range(28,30)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="buku-tga" id="buku-tga-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		
		@if ($disposisi->progress < 28)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="button" class="btn btn-sm btn-secondary" disabled="disabled">Kirim</button>
				</td>
			</tr>
		@elseif ($disposisi->progress == 28)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		</form>
		@endif
	</tbody>
</table>