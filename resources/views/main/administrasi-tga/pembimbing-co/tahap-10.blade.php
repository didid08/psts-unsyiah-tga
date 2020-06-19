<table width="100%" class="table table-bordered{{ formBackground(20, 20, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td colspan="2" class="align-middle">
				Pembimbing (Co) telah menerima SK
			</td>
		</tr>
		<tr>
			<td class="align-middle font-italic">Jumlah Asistensi (min. 8 kali)</td>
			<td class="text-center align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(20,20)))
					<input type="number" min="8" class="form-control" placeholder="--" style="width: 5em; display: inline;">&nbsp;&nbsp;Kali
				@elseif ($administrasi_tga->value('progress') > 20)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle font-italic">Masa Pembimbingan Buku TGA</td>
			<td class="text-center align-middle">
				@if (in_array($administrasi_tga->value('progress'), range(20,20)))
					<input type="number" class="form-control" placeholder="--" style="width: 5em; display: inline;">&nbsp;&nbsp;Bulan
				@elseif ($administrasi_tga->value('progress') > 20)
					<input type="text" class="form-control bg-light" readonly="readonly" value="#">
				@else
					--
				@endif
			</td>
		</tr>

		@if ($administrasi_tga->value('progress') == 20)
			<tr>
				<td></td>
				<td class="align-middle text-center">
					<button class="btn btn-success">Tetapkan</button>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') < 20)
			<tr>
				<td></td>
				<td class="align-middle text-center">
					<button class="btn btn-secondary" disabled="disabled">Tetapkan</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>