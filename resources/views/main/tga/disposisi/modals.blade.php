@if (isset($roles->ketua_kel_keahlian))
	<div class="modal fade" id="usulkan-pembimbing-co" aria-modal="true">
		<div class="modal-dialog modal-lg">
	  		<div class="modal-content">
	    		<div class="modal-header">
	      			<h4 class="modal-title">Usulkan Pembimbing & Co untuk <b>{{ $mahasiswa->nama }}</b> ({{ $nim }})</h4>
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        			<span aria-hidden="true">×</span>
	      			</button>
	    		</div>
	    		<div class="modal-body">
	    			<table class="table table-light">
	    				<tr>
	    					<td class="align-middle text-center">
	    						<select name="" id="" class="form-control">
									@foreach ($semua_dosen_bimbingan as $dosen)
										<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
									@endforeach
								</select>
	    					</td>
	    					<td class="align-middle text-center">
	    						<select name="" id="" class="form-control">
									@foreach ($semua_dosen_co_bimbingan as $dosen)
										<option value="{{ $dosen->nama }}">{{ $dosen->nama }}</option>
									@endforeach
								</select>
	    					</td>
	    				</tr>
	    			</table>
	    		</div>
	    		<div class="modal-footer justify-content-between">
	      			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
	      			<a target="_blank" href="{{ route('main.info-dosen', ['category' => $category]) }}" class="btn btn-outline-secondary">Lihat Info Dosen</a>
	      			<button type="button" class="btn btn-success">Kirim</button>
		        </div>
	    	</div>
		</div>
	</div>
@endif

@if (isset($roles->koor_tga))
	<div class="modal fade" id="usulkan-komisi-penguji" aria-modal="true">
    	<div class="modal-dialog modal-lg">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title">Usulkan Komisi Penguji dan Jadwal Seminar untuk <b>{{ $mahasiswa->nama }}</b> ({{ $nim }})</h4>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
        		</div>
        		<div class="modal-body">
        			<span class="font-italic">Catatan:&nbsp;&nbsp;Centang yang mau diusulkan</span>
        			<table class="table table-bordered table-striped mt-3">
						<thead>
							<tr>
								<th colspan="4" class="text-center">Komisi Penguji</th>
							</tr>
							<tr>
								<th class="text-center">Ketua Penguji <input type="checkbox" class="ml-2"></th>
								<th class="text-center">Penguji 1 <input type="checkbox" class="ml-2"></th>
								<th class="text-center">Penguji 2 <input type="checkbox" class="ml-2"></th>
								<th class="text-center">Penguji 3 <input type="checkbox" class="ml-2"></th>
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
					<table class="table table-bordered table-striped mt-3">
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
        		</div>
        		<div class="modal-footer justify-content-between">
          			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          			<button type="button" class="btn btn-success">Kirim</button>
		        </div>
	    	</div>
    	</div>
  	</div>
  	<div class="modal fade" id="usulkan-komisi-penguji-2" aria-modal="true">
    	<div class="modal-dialog modal-lg">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title">Usulkan Komisi Penguji dan Jadwal Sidang Buku untuk <b>{{ $mahasiswa->nama }}</b> ({{ $nim }})</h4>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
        		</div>
        		<div class="modal-body">
        			<span class="font-italic">Catatan:&nbsp;&nbsp;Centang yang mau diusulkan</span>
        			<table class="table table-bordered table-striped mt-3">
						<thead>
							<tr>
								<th colspan="4" class="text-center">Komisi Penguji</th>
							</tr>
							<tr>
								<th class="text-center">Ketua Penguji <input type="checkbox" class="ml-2"></th>
								<th class="text-center">Penguji 1 <input type="checkbox" class="ml-2"></th>
								<th class="text-center">Penguji 2 <input type="checkbox" class="ml-2"></th>
								<th class="text-center">Penguji 3 <input type="checkbox" class="ml-2"></th>
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
					<table class="table table-bordered table-striped mt-3">
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
        		</div>
        		<div class="modal-footer justify-content-between">
          			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          			<button type="button" class="btn btn-success">Kirim</button>
		        </div>
	    	</div>
    	</div>
  	</div>
@endif