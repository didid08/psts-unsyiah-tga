@extends('main.master')

@section('content')
	<div class="container">
		<div class="card height-auto">
			<div class="card-title text-bold pl-4 pr-4 pt-4" style="font-size: 1.2em;">
				LEMBAR INPUT DATA USUL SIDANG BUKU TGA MAHASISWA<br>
				PRODI S1 TEKNIK SIPIL - UNSYIAH
			</div>
			<div class="card-body" style="overflow-x: auto;">
				<form action="{{ route('main.tga.mahasiswa.input-usul-sidang.process') }}" method="post" enctype="multipart/form-data">
					@csrf
						<table class="table table-bordered table-striped form-gorup">
							<thead>
								<tr class="bg-info">
									<th scope="col" class="align-middle text-center">Jumlah Asistensi</th>
									<th scope="col" class="align-middle text-center">Masa Pembimbingan Buku TGA</th>
									<th scope="col" class="align-middle text-center">Lembar Asistensi</th>
									<th scope="col" class="align-middle text-center">Draft Buku TGA</th>
									<th scope="col" class="align-middle text-center">Ijazah</th>
									<th scope="col" class="align-middle text-center">Bukti Nilai Toefl</th>
									@if ($progress == 21)
										<th scope="col" class="align-middle text-center">Opsi</th>
									@endif
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="align-middle text-center">
										<input type="text" class="form-control bg-light" style="width: 7em; display: inline-block;" readonly="readonly" placeholder="Diisi oleh pembimbing" value="{{ $input_value['jumlah-asistensi-2'] }} kali">
									</td>
									<td class="align-middle text-center">
										<input type="text" class="form-control bg-light" style="width: 7em; display: inline-block;" readonly="readonly" placeholder="Diisi oleh pembimbing" value="{{ $input_value['masa-pembimbingan-buku-tga'] }} bulan">
									</td>
									<td class="align-middle text-center">
										@if ($progress == 21)
											<input type="file" name="lembar-asistensi-2" accept="application/pdf">
										@elseif ($progress > 21)
											<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada											
										@endif
									</td>
									<td class="align-middle text-center">
										@if ($progress == 21)
											<input type="file" name="draft-buku-tga" accept="application/pdf">
										@elseif ($progress > 21)
											<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada											
										@endif
									</td>
									<td class="align-middle text-center">
										@if ($progress == 21)
											<input type="file" name="ijazah" accept="application/pdf">
										@elseif ($progress > 21)
											<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada											
										@endif
									</td>
									<td class="align-middle text-center">
										@if ($progress == 21)
											<input type="file" name="bukti-nilai-toefl" accept="application/pdf">
										@elseif ($progress > 21)
											<i class="fa fa-check-circle text-green"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ada											
										@endif
									</td>
									@if ($progress == 21)
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