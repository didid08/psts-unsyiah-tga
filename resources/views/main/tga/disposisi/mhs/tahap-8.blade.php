<table width="100%" class="table table-bordered{{ formBackground(15, 17, $disposisi) }}">
	<tbody>
		@if ($disposisi->progress == 15)
			<form action="{{ route('main.tga.mahasiswa.upload-disposisi', ['progress' => 15]) }}" method="post" enctype="multipart/form-data">
				@csrf
		@endif
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Berita Acara Seminar Proposal</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 17)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					@if (in_array($disposisi->progress, range(16,17)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="berita-acara-seminar-proposal" id="berita-acara-seminar-proposal" onchange="showSelectedFile('#berita-acara-seminar-proposal-label', event)" accept="application/pdf" {!! in_array($disposisi->progress, range(15,17)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="berita-acara-seminar-proposal" id="berita-acara-seminar-proposal-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Buku Proposal</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 17)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					@if (in_array($disposisi->progress, range(16,17)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="buku-proposal" id="buku-proposal" onchange="showSelectedFile('#buku-proposal-label', event)" accept="application/pdf" {!! in_array($disposisi->progress, range(15,17)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="buku-proposal" id="buku-proposal-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		
		@if ($disposisi->progress < 15)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="button" class="btn btn-sm btn-secondary" disabled="disabled">Kirim</button>
				</td>
			</tr>
		@elseif ($disposisi->progress == 15)
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