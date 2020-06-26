<table width="100%" class="table table-bordered{{ formBackground(7, 7, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="2" class="align-middle">
				Pembimbing (Co) telah menerima SK
			</td>
		</tr>
		<tr>
			<td class="align-middle font-italic">Jumlah Asistensi (min. 8 kali)</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(7,7)))
					<span class="text-warning">Sedang diproses</span>
				@elseif ($disposisi->progress > 7)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle font-italic">Masa Pembimbingan Proposal</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(7,7)))
					<span class="text-warning">Sedang diproses</span>
				@elseif ($disposisi->progress > 7)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>