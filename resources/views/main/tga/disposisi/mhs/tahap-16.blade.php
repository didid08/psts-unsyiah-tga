<table width="100%" class="table table-bordered{{ formBackground(33, 35, $disposisi) }}">
	<tbody>
		@if ($disposisi->progress == 33)
			<form action="{{ route('main.tga.mahasiswa.upload-disposisi', ['progress' => 33]) }}" method="post" enctype="multipart/form-data">
				@csrf
		@endif
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Kelengkapan Dokumen Administrasi Sidang Buku (Lembar Pengesahan, Lembar Acc)</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 33)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress == 33)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="kelengkapan-dokumen-administrasi-sidang-buku" id="kelengkapan-dokumen-administrasi-sidang-buku" onchange="showSelectedFile('#kelengkapan-dokumen-administrasi-sidang-buku-label', event)" accept="application/zip" {!! in_array($disposisi->progress, range(33,35)) ? '' : 'disabled="disabled"' !!}>
						<label class="custom-file-label text-left" for="kelengkapan-dokumen-administrasi-sidang-buku" id="kelengkapan-dokumen-administrasi-sidang-buku-label">Pilih File</label>
					</div>
				@else
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>

		@if ($disposisi->progress == 33)
			<tr>
				<td colspan="3" class="align-middle text-left">
					<a href="{{ route('main.tga.mahasiswa.input-usul-yudisium') }}" class="btn btn-outline-secondary text-bold">Input Usul Yudisium</a>
				</td>
			</tr>
		@endif

		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Kelengkapan Dokumen Yudisium dan Wisuda</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 33)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress == 33)
					@if ($cek_berkas_yudisium)
						<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada (Menunggu untuk dikirim)</span>
					@else
						<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
					@endif
				@else
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		
		@if ($disposisi->progress < 33)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="button" class="btn btn-sm btn-secondary" disabled="disabled">Kirim</button>
				</td>
			</tr>
		@elseif ($disposisi->progress == 33)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			</tr>
		</form>
		@endif
		
		<tr>
			<td class="align-middle">3.</td>
			<td colspan="2" class="align-middle text-left">
				Softcopy Dokumen Administrasi Sidang Buku dikirim ke: <br>
				<ul style="list-style-type: square;">
					<li>Nama File:&nbsp;&nbsp;<b>NIM_Proposal.zip</b></li>
					<li>Email Administrasi:&nbsp;&nbsp;<a href="mailto:jtspsts{!! '@' !!}gmail.com">jtspsts&commat;gmail.com</a></li>
				</ul>
			</td>
		</tr>
	</tbody>
</table>