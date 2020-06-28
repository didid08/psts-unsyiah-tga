<table width="100%" class="table table-bordered table-striped{{ ($disposisi->progress_optional < 6 && $disposisi->progress >= 26) ? '' : formBackgroundOptional(4, 5, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle"><b>Surat Tugas Pengambilan Data Lab/Lapangan</b></td>
			<td class="align-middle text-center">
			@if ($disposisi->progress_optional > 5)
					<a href="{{ route('main.file', ['filename' => $data->stpd->content]) }}" class="btn btn-sm btn-success">Unduh</a>
			@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">No</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress_optional < 4)
					<span class="text-muted">--</span>
				@elseif ($disposisi->progress_optional > 5)
					<input type="text" class="form-control bg-light" readonly="readonly" value="{{ $data->stpd->no }}">	
				@elseif ($disposisi->progress_optional < 6 && $disposisi->progress >= 26)
					<span class="text-muted">--</span>
				@else
					<span class="text-warning">sedang diproses</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle">Tgl</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress_optional < 4)
					<span class="text-muted">--</span>
				@elseif ($disposisi->progress_optional > 5)
					<input type="text" class="form-control bg-light" readonly="readonly" value="{{ date('d-m-Y', strtotime($data->stpd->tgl)) }}">	
				@elseif ($disposisi->progress_optional < 6 && $disposisi->progress >= 26)
					<span class="text-muted">--</span>
				@else
					<span class="text-warning">sedang diproses</span>
				@endif
			</td>
		</tr>
	</tbody>
</table>