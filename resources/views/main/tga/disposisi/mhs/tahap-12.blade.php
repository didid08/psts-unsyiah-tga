<table width="100%" class="table table-bordered{{ formBackground(24, 25, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle font-weight-bold">SK Komisi Penguji Sidang Buku</td>
			<td class="align-middle text-center">
				@if ($disposisi->progress > 25)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">No</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(24,25)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 25)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle"></td>
			<td class="align-middle font-italic">Tgl</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(24,25)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 25)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle font-weight-bold">Undangan Sidang Buku</td>
			<td class="align-middle text-center">
				@if (in_array($disposisi->progress, range(24,25)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 25)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle font-weight-bold">Berkas Sidang Lainnya</td>
			<td class="align-middle text-center">
				@if (in_array($disposisi->progress, range(24,25)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 25)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@else
					--
				@endif
			</td>
		</tr>
		@if ($disposisi->progress > 25)
			<tr>
				<td colspan="3" class="align-middle text-center">
					<a href="#" class="btn btn-block btn-success">Unduh Semua</a>
				</td>
			</tr>
		@endif
	</tbody>
</table>