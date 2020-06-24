@extends('main.master')

@section('custom-script')
	<script>
		$("#usulan-tga").dataTable();
	</script>
@endsection

@section('content')
	<div class="container">
		<div class="card">
			<div class="card-body" style="overflow-x: auto;">
				<table class="table table-bordered table-striped" width="100%" id="usulan-tga">
					<thead>
						<tr class="bg-green">
							<th class="align-middle text-center">No</th>
							<th class="align-middle text-left">Nama</th>
							<th class="align-middle text-center">NIM</th>
							<th class="align-middle text-center">Foto</th>
							<th class="align-middle text-center">SPP</th>
							<th class="align-middle text-center">KRS</th>
							<th class="align-middle text-center">Transkrip</th>
							<th class="align-middle text-center">KHS</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							@php
								$isEmpty = true;
							@endphp

							@foreach ($semua_mahasiswa as $index => $mahasiswa)
								@php
									$isEmpty = false;
									$mhsId = $mahasiswa->user_id;
								@endphp
								<td class="align-middle text-center">{{ $index+1 }}</td>
								<td class="align-middle text-left">{{ $mahasiswa->user->nama }}</td>
								<td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
								<td class="align-middle text-center"><i class="fa fa-check-circle text-green mr-2"></i><a href="#" class="text-green">Periksa</a></td>
								<td class="align-middle text-center"><i class="fa fa-check-circle text-green mr-2"></i><a href="#" class="text-green">Periksa</a></td>
								<td class="align-middle text-center"><i class="fa fa-check-circle text-green mr-2"></i><a href="#" class="text-green">Periksa</a></td>
								<td class="align-middle text-center"><i class="fa fa-check-circle text-green mr-2"></i><a href="#" class="text-green">Periksa</a></td>
								<td class="align-middle text-center"><i class="fa fa-check-circle text-green mr-2"></i><a href="#" class="text-green">Periksa</a></td>
							@endforeach

							@if ($isEmpty)
								<td class="align-middle text-center">--</td>
								<td class="align-middle text-left">--</td>
								<td class="align-middle text-center">--</td>
								<td class="align-middle text-center">--</td>
								<td class="align-middle text-center">--</td>
								<td class="align-middle text-center">--</td>
								<td class="align-middle text-center">--</td>
								<td class="align-middle text-center">--</td>
							@endif
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection