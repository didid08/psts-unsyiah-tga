<table width="100%" class="table table-bordered{{ formBackground(5, 6, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle font-weight-bold">SK Penunjukan Pembimbing</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress > 6)
					<a class="btn btn-sm btn-success" target="_blank" href="{{ route('cetak.sk-pembimbing', ['nim' => $mahasiswa->nomor_induk]) }}">Unduh</a>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">No</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(5,6)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 6)
					<input type="text" class="form-control bg-light" readonly="readonly" value="{{ $data->sk_pembimbing->no }}">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">Tgl</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(5,6)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 6)
					<input type="text" class="form-control bg-light" readonly="readonly" value="{{ \Carbon\Carbon::parse($data->sk_pembimbing->tgl)->translatedFormat('d F Y') }}">
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>