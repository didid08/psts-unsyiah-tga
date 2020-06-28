<table width="100%" class="table table-bordered{{ formBackground(8, 10, $disposisi) }}">
	<tbody>
		@if ($disposisi->progress == 8)
			<tr>
				<td colspan="3" class="align-middle text-left">
					<a href="{{ route('main.tga.mahasiswa.input-usul-sempro') }}" class="btn btn-light">Input Usul Sempro</a>
				</td>
			</tr>
		@endif
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
					Koordinator TGA sedang mengusulkan Komisi Penguji dan Jadwal Seminar
				</td>
			</tr>
		@elseif ($disposisi->progress > 10)
			<tr>
				<td>3.</td>
				<td colspan="2" class="align-middle">
					<table class="table table-bordered table-striped table-light">
						<thead>
							<tr>
								<th colspan="2" class="align-middle text-center">Komisi Penguji</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="align-middle text-left text-bold">Ketua Penguji</td>
								<td class="align-middle text-left">
									{{ $data->ketua_penguji->content }}
								</td>
							</tr>
							<tr>
								<td class="align-middle text-left text-bold">Penguji 1</td>
								<td class="align-middle text-left">
									{{ $data->penguji_1->content }}
								</td>
							</tr>
							<tr>
								<td class="align-middle text-left text-bold">Penguji 2</td>
								<td class="align-middle text-left">
									{{ $data->penguji_2->content }}
								</td>
							</tr>
							<tr>
								<td class="align-middle text-left text-bold">Penguji 3</td>
								<td class="align-middle text-left">
									{{ $data->penguji_3->content }}
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered table-striped table-light mt-4">
						<thead>
							<tr>
								<th colspan="2" class="align-middle text-center">Jadwal Seminar</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="align-middle text-center text-bold">Hari</td>
								<td class="align-middle text-center">
									{{ \Carbon\Carbon::parse($data->tgl_seminar->content)->translatedFormat('l') }}
								</td>
							</tr>
							<tr>
								<td class="align-middle text-center text-bold">Tanggal</td>
								<td class="align-middle text-center">
									{{ \Carbon\Carbon::parse($data->tgl_seminar->content)->translatedFormat('d F Y') }}
								</td>
							</tr>
							<tr>
								<td class="align-middle text-center text-bold">Jam</td>
								<td class="align-middle text-center">
									{{ \Carbon\Carbon::parse($data->jam_seminar->content)->translatedFormat('H:i') }} WIB
								</td>
							</tr>
							<tr>
								<td class="align-middle text-center text-bold">Tempat</td>
								<td class="align-middle text-center">
									{{ $data->tempat_seminar->content }}
								</td>
							</tr>
						</tbody>
					</table>
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