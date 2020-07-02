@if ($disposisi->progress_optional == 1)
	<form action="{{ route('main.tga.mahasiswa.upload-disposisi', ['progress' => 1, 'optional' => 'optional']) }}" method="post" style="display: inline;" enctype="multipart/form-data">
@endif
<table width="100%" class="table table-bordered table-striped{{ ($disposisi->progress_optional < 6 && $disposisi->progress >= 26) ? '' : formBackgroundOptional(1, 3, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="3" class="align-middle">Pengajuan Surat Tugas Pengambilan Data Lab/Lapangan (<span class="text-red">opsional</span>)</td>
		</tr>
		<tr>
			<td class="align-middle">Surat Permohonan Tugas Pengambilan Data</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress_optional == 0 || ($disposisi->progress_optional < 6 && $disposisi->progress >= 26))
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="sptpd" id="sptpd" onchange="showSelectedFile('#sptpd-label', event)" accept="application/pdf" disabled="disabled">
						<label class="custom-file-label text-left" for="sptpd" id="sptpd-label">Pilih File</label>
					</div>
				@elseif ($disposisi->progress_optional == 1)
					<div class="custom-file">
						<input type="file" class="custom-file-input" name="sptpd" id="sptpd" onchange="showSelectedFile('#sptpd-label', event)" accept="application/pdf">
						<label class="custom-file-label text-left" for="sptpd" id="sptpd-label">Pilih File</label>
					</div>
				@elseif (in_array($disposisi->progress_optional, range(2,3)))
					<span class="text-yellow">sedang diperiksa</span>
				@else
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@endif
			</td>
			@if ($disposisi->progress_optional == 0 || ($disposisi->progress_optional < 6 && $disposisi->progress >= 26))
				<td class="text-center align-middle">
					<button class="btn btn-sm btn-secondary" disabled="disabled">Kirim</button>
				</td>
			@elseif ($disposisi->progress_optional == 1)
				<td class="text-center align-middle">
					@csrf
					<button type="submit" class="btn btn-sm btn-success">Kirim</button>
				</td>
			@endif
		</tr>
	</tbody>
</table>
@if ($disposisi->progress_optional == 1)
	</form>
@endif