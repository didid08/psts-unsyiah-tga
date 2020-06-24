<table width="100%" class="table table-bordered{{ formBackground(8, 10, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Lembar Asistensi (Setuju Diseminarkan)</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 8)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 8)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Draft Buku Proposal</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 8)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 8)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		@if ($disposisi->progress == 10)
			<tr class="bg-warning">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar
				</td>
			</tr>
		@elseif ($disposisi->progress > 10)
			<tr>
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar
				</td>
			</tr>
		@else
			<tr class="text-muted">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar
				</td>
			</tr>
		@endif
	</tbody>
</table>