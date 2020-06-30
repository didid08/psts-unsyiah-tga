@extends('main.master')

@section('content')
	<div class="container">
		<div class="card height-auto">
			<div class="card-title text-bold pl-4 pr-4 pt-4" style="font-size: 1.2em;">
				LEMBAR INPUT DATA USUL YUDISIUM MAHASISWA<br>
				PRODI S1 TEKNIK SIPIL - UNSYIAH
			</div>
			<div class="card-body" style="overflow-x: auto;">
				<form action="{{ route('main.tga.mahasiswa.input-usul-yudisium.process') }}" method="post" enctype="multipart/form-data">
					@csrf
						<table class="table table-bordered table-striped form-gorup">
							<thead>
								<tr class="bg-info">
									<th scope="col" class="align-middle text-center">Biodata</th>
									<th scope="col" class="align-middle text-center">Transkrip</th>
									<th scope="col" class="align-middle text-center">Bukti Bebas Lab</th>
									<th scope="col" class="align-middle text-center">Artikel JIM</th>
									@if ($progress == 33 && !$cek_berkas_yudisium)
										<th scope="col" class="align-middle text-center">Opsi</th>
									@endif
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="align-middle text-center">
										@if ($progress == 33)
											@if ($cek_berkas_yudisium)
												<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada (Belum dikirim)
											@else
												<input type="file" name="biodata" accept="application/pdf">
											@endif
										@elseif ($progress > 33)
											<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada
										@endif
									</td>
									<td class="align-middle text-center">
										@if ($progress == 33)
											@if ($cek_berkas_yudisium)
												<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada (Belum dikirim)
											@else
												<input type="file" name="transkrip" accept="application/pdf">
											@endif
										@elseif ($progress > 33)
											<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada											
										@endif
									</td>
									<td class="align-middle text-center">
										@if ($progress == 33)
											@if ($cek_berkas_yudisium)
												<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada (Belum dikirim)
											@else
												<input type="file" name="bukti-bebas-lab" accept="application/pdf">
											@endif
										@elseif ($progress > 33)
											<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada											
										@endif
									</td>
									<td class="align-middle text-center">
										@if ($progress == 33)
											@if ($cek_berkas_yudisium)
												<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada (Belum dikirim)
											@else
												<input type="file" name="artikel-jim" accept="application/pdf">
											@endif
										@elseif ($progress > 33)
											<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada
										@endif
									</td>
									@if ($progress == 33 && !$cek_berkas_yudisium)
										<td class="align-middle text-center">
											<button type="submit" class="btn btn-block btn-success text-bold">Simpan</button>
										</td>
									@endif
								</tr>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection