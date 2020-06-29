<table width="230%" class="table table-bordered{{ formBackground(21, 23, $disposisi) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Lembar Asistensi (Setuju Disidangkan)</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 21)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 21)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Draft Buku TGA</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 21)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 21)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle">Ijazah</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 21)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 21)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">3.</td>
			<td class="align-middle">Bukti Nilai Toefl</td>
			<td class="text-center align-middle">
				@if ($disposisi->progress > 21)
					<i class="fa fa-check-circle text-green"></i><span class="ml-3">Ada</span>
				@elseif ($disposisi->progress < 21)
					<i class="fa fa-exclamation-triangle text-muted"></i><span class="ml-3 text-muted">Belum ada</span>
				@else
					<i class="fa fa-exclamation-triangle text-yellow"></i><span class="ml-3">Belum ada</span>
				@endif
			</td>
		</tr>
		@if ($disposisi->progress == 23)
			<tr class="bg-warning">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Sidang
				</td>
			</tr>
		@elseif ($disposisi->progress > 23)
			@if (isset($roles->admin) | isset($roles->koor_prodi))
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
										{{ $mahasiswa_data_tga->ketua_penguji_2->content }}
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left text-bold">Penguji 1</td>
									<td class="align-middle text-left">
										{{ $mahasiswa_data_tga->penguji_1_2->content }}
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left text-bold">Penguji 2</td>
									<td class="align-middle text-left">
										{{ $mahasiswa_data_tga->penguji_2_2->content }}
									</td>
								</tr>
								<tr>
									<td class="align-middle text-left text-bold">Penguji 3</td>
									<td class="align-middle text-left">
										{{ $mahasiswa_data_tga->penguji_3_2->content }}
									</td>
								</tr>
							</tbody>
						</table>
						<table class="table table-bordered table-striped table-light mt-4">
							<thead>
								<tr>
									<th colspan="2" class="align-middle text-center">Jadwal Sidang</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="align-middle text-center text-bold">Hari</td>
									<td class="align-middle text-center">
										{{ \Carbon\Carbon::parse($mahasiswa_data_tga->tgl_sidang->content)->translatedFormat('l') }}
									</td>
								</tr>
								<tr>
									<td class="align-middle text-center text-bold">Tanggal</td>
									<td class="align-middle text-center">
										{{ \Carbon\Carbon::parse($mahasiswa_data_tga->tgl_sidang->content)->translatedFormat('d F Y') }}
									</td>
								</tr>
								<tr>
									<td class="align-middle text-center text-bold">Jam</td>
									<td class="align-middle text-center">
										{{ \Carbon\Carbon::parse($mahasiswa_data_tga->jam_sidang->content)->translatedFormat('H:i') }} WIB
									</td>
								</tr>
								<tr>
									<td class="align-middle text-center text-bold">Tempat</td>
									<td class="align-middle text-center">
										{{ $mahasiswa_data_tga->tempat_sidang->content }}
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			@else
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA telah menetapkan Komisi Penguji dan Jadwal Sidang
				</td>
			@endif
		@else
			<tr class="text-muted">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Sidang
				</td>
			</tr>
		@endif
	</tbody>
</table>