<table width="100%" class="table table-bordered{{ formBackground(8, 10, $administrasi_tga) }}">
	<tbody>
		<tr>
			<td class="align-middle">1.</td>
			<td class="align-middle">Lembar Asistensi (Setuju Diseminarkan)</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 10)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Lihat</a>)</span>
				@elseif ($administrasi_tga->value('progress') > 10)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@elseif ($administrasi_tga->value('progress') == 9)
					<span class="text-yellow">Sedang diproses oleh Admin</span>
				@else
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@endif
			</td>
		</tr>
		<tr>
			<td class="align-middle">2.</td>
			<td class="align-middle">Draft Buku Proposal</td>
			<td class="text-center align-middle">
				@if ($administrasi_tga->value('progress') == 10)
					<span><i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;Ada (<a href="#">Lihat</a>)</span>
				@elseif ($administrasi_tga->value('progress') > 10)
					<a href="#" class="btn btn-sm btn-success">Unduh</a>
				@elseif ($administrasi_tga->value('progress') == 9)
					<span class="text-yellow">Sedang diproses oleh Admin</span>
				@else
					<span><i class="fa fa-times-circle text-secondary"></i>&nbsp;&nbsp;Belum diunggah</span>
				@endif
			</td>
		</tr>

		@if ($administrasi_tga->value('progress') == 10)
			<tr>
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar<br>
					<table class="table table-bordered mt-3">
						<thead>
							<tr>
								<th colspan="4" class="text-center">Komisi Penguji</th>
							</tr>
							<tr>
								<th class="text-center">Ketua Penguji</th>
								<th class="text-center">Penguji 1</th>
								<th class="text-center">Penguji 2</th>
								<th class="text-center">Penguji 3</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">
									<select name="" id="" class="form-control">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered mt-3">
						<thead>
							<tr>
								<th colspan="3" class="text-center">Jadwal Seminar</th>
							</tr>
							<tr>
								<th class="text-center">Jam</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Tempat</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">
									<input type="time" class="form-control">
								</td>
								<td class="text-center">
									<input type="date" class="form-control">
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control">
										<option>Ruang Seminar 1</option>
										<option>Ruang Seminar 2</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<button class="btn btn-block btn-success font-weight-bold">Tetapkan komisi penguji dan jadwal seminar</button>
				</td>
			</tr>
		@elseif ($administrasi_tga->value('progress') > 10)
			<tr>
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar<br>
					<table class="table table-bordered mt-3">
						<thead>
							<tr>
								<th colspan="4" class="text-center">Komisi Penguji</th>
							</tr>
							<tr>
								<th class="text-center">Ketua Penguji</th>
								<th class="text-center">Penguji 1</th>
								<th class="text-center">Penguji 2</th>
								<th class="text-center">Penguji 3</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">
									<select name="" id="" class="form-control">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered mt-3">
						<thead>
							<tr>
								<th colspan="3" class="text-center">Jadwal Seminar</th>
							</tr>
							<tr>
								<th class="text-center">Jam</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Tempat</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">
									<input type="time" class="form-control">
								</td>
								<td class="text-center">
									<input type="date" class="form-control">
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control">
										<option>Ruang Seminar 1</option>
										<option>Ruang Seminar 2</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<button class="btn btn-block btn-outline-success font-weight-bold">Ubah komisi penguji dan jadwal seminar</button>
				</td>
				</td>
			</tr>
		@else
			<tr class="text-muted">
				<td>3.</td>
				<td colspan="2" class="align-middle">
					Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar<br>
					<table class="table table-bordered mt-3">
						<thead>
							<tr>
								<th colspan="4" class="text-center">Komisi Penguji</th>
							</tr>
							<tr>
								<th class="text-center">Ketua Penguji</th>
								<th class="text-center">Penguji 1</th>
								<th class="text-center">Penguji 2</th>
								<th class="text-center">Penguji 3</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">
									<select name="" id="" class="form-control" disabled="disabled">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control" disabled="disabled">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control" disabled="disabled">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control" disabled="disabled">
										@foreach ($semua_dosen as $dosen)
											<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
										@endforeach
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<table class="table table-bordered mt-3">
						<thead>
							<tr>
								<th colspan="3" class="text-center">Jadwal Seminar</th>
							</tr>
							<tr>
								<th class="text-center">Jam</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Tempat</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center">
									<input type="time" class="form-control" disabled="disabled">
								</td>
								<td class="text-center">
									<input type="date" class="form-control" disabled="disabled">
								</td>
								<td class="text-center">
									<select name="" id="" class="form-control" disabled="disabled">
										<option>Ruang Seminar 1</option>
										<option>Ruang Seminar 2</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<button class="btn btn-block btn-secondary font-weight-bold" disabled="disabled">Tetapkan komisi penguji dan jadwal seminar</button>
				</td>
			</tr>
		@endif
	</tbody>
</table>