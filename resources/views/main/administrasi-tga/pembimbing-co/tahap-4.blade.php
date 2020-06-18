<table width="100%" class="table table-bordered{{ formBackground(7, 7, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td colspan="2" class="align-middle">
				Pembimbing (Co) telah menerima SK
			</td>
		</tr>
		<tr>
			<td class="align-middle font-italic">Jumlah Asistensi (min. 8 kali)</td>
			<td class="text-center align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(7,7)))
					<input type="number" min="8" class="form-control" placeholder="Masukkan jumlah asistensi">
				@elseif ($administrasi_tga->value('progress') > 7)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle font-italic">Masa Pembimbingan Proposal</td>
			<td class="text-left align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(7,7)))
					Dari <input type="date" class="form-control ml-2" style="display: inline-block; width: 10em;"><br>sampai <input type="date" class="form-control ml-2 mt-3" style="display: inline-block; width: 10em;">
				@elseif ($administrasi_tga->value('progress') > 7)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>

		@if ($administrasi_tga->value('progress') == 7)
			<tr>
				<td></td>
				<td class="align-middle text-center">
					<button class="btn btn-sm btn-success">Tetapkan</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>