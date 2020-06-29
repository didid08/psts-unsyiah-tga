<table width="100%" class="table table-bordered{{ formBackground(20, 20, $disposisi) }}">
	<tbody>
		<tr>
			<td colspan="2" class="align-middle">
				Pembimbing (Co) telah menerima SK
			</td>
		</tr>
		<tr>
			<td class="align-middle font-italic">Jumlah Asistensi (min. 8 kali)</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(20,20)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 20)
					<input type="text" class="form-control bg-light" readonly="readonly" style="display: inline-block; width: 7em;" value="{{ $data->jumlah_asistensi_2->content }} kali">
				@else
					--
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle font-italic">Masa Pembimbingan Buku TGA</td>
			<td class="text-center align-middle">
				@if (in_array($disposisi->progress, range(20,20)))
					<span class="text-warning">sedang diproses</span>
				@elseif ($disposisi->progress > 20)
					<input type="text" class="form-control bg-light" readonly="readonly" style="display: inline-block; width: 7em;" value="{{ $data->masa_pembimbingan_buku_tga->content }} bulan">
				@else
					--
				@endif
			</td>
		</tr>
	</tbody>
</table>