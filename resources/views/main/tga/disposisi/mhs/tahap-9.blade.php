<table width="100%" class="table table-bordered{{ formBackground(18, 19, $disposisi) }}">
	<tbody>
		@if ($disposisi->progress == 18)
			<form action="{{ route('main.tga.mahasiswa.upload-disposisi', ['progress' => 18]) }}" method="post" enctype="multipart/form-data">
				@csrf
		@endif
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Kelengkapan Dokumen Administrasi Seminar Proposal (Daftar Hadir Seminar)</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 19)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@else
					@if (in_array($disposisi->progress, range(19,19)))
						<span class="text-warning">sedang diperiksa</span>
					@else
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="daftar-hadir-seminar-proposal" id="daftar-hadir-seminar-proposal" onchange="showSelectedFile('#daftar-hadir-seminar-proposal-label', event)" accept="application/pdf" {!! in_array($disposisi->progress, range(18,19)) ? '' : 'disabled="disabled"' !!}>
							<label class="custom-file-label text-left" for="daftar-hadir-seminar-proposal" id="daftar-hadir-seminar-proposal-label">Pilih File</label>
						</div>
					@endif
				@endif
			</td>
		</tr>
		
		@if ($disposisi->progress < 18)
			<tr>
				<td></td>
				<td></td>
				<td class="text-right align-middle">
					<button type="button" class="btn btn-sm btn-secondary" disabled="disabled">Kirim</button>
				</td>
			</tr>
		@elseif ($disposisi->progress == 18)
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
			<td class="align-middle">2.</td>
			<td colspan="2" class="align-middle text-left">
				Softcopy Administrasi Seminar Proposal dikirim ke: <br>
				<ul style="list-style-type: square;">
					<li>Nama File:&nbsp;&nbsp;<b>NIM_Proposal.zip</b></li>
					<li>Email Administrasi:&nbsp;&nbsp;<a href="mailto:jtspsts{!! '@' !!}gmail.com">jtspsts&commat;gmail.com</a></li>
				</ul>
			</td>
		</tr>
	</tbody>
</table>