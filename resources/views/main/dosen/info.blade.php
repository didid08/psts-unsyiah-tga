@extends('main.master')

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	<li class="breadcrumb-item active">{{ $subtitle }}</li>
@endsection

@section('custom-script')
	<script>
		$("#info-dosen").dataTable()
	</script>
@endsection

@section('content')
	<div class="container">
	    <div class="card height-auto">
	    	<div class="card-body" style="overflow-x: auto;">
	    		<style>
	    			#info-dosen {
	    				table-layout: auto;
	    				width: 200%;
	    			}
	    			#info-dosen th, #info-dosen td {
	    				text-align: center;
	    				vertical-align: middle;
	    			}
	    		</style>
	    		<table class="table table-bordered table-striped" id="info-dosen">
	    			<thead>
	    				<tr>
	    					<th colspan="4" rowspan="2">DOSEN</th>
	    					<th colspan="11">Tahun Ajaran 2019/2020</th>
	    					<th colspan="11">Tahun Ajaran 2020/2021</th>
	    				</tr>
	    				<tr>
	    					<th colspan="3">PEMBIMBING</th>
	    					<th colspan="3">CO PEMBIMBING</th>
	    					<th colspan="4">PENGUJI</th>
	    					<th></th>
	    					<th colspan="3">PEMBIMBING</th>
	    					<th colspan="3">CO PEMBIMBING</th>
	    					<th colspan="4">PENGUJI</th>
	    					<th></th>
	    				</tr>
	    				<tr>
	    					<th scope="col">NO</th>
	    					<th scope="col">NAMA</th>
	    					<th scope="col">NIP</th>
	    					<th scope="col">BIDANG</th>
	    					<th scope="col">Bimbing</th>
	    					<th scope="col">Selesai Bimb</th>
	    					<th scope="col">Total Pemb.</th>
	    					<th scope="col">Co Pemb</th>
	    					<th scope="col">Selesai Co Pemb</th>
	    					<th scope="col">Total Co Pemb.</th>
	    					<th scope="col">Ketua Penguji</th>
	    					<th scope="col">Penguji Sidang</th>
	    					<th scope="col">Total Penguji</th>
	    					<th scope="col">Penguji Proposal</th>
	    					<th scope="col">Dosen Wali</th>
	    					<th scope="col">Bimbing</th>
	    					<th scope="col">Selesai Bimb</th>
	    					<th scope="col">Total Pemb.</th>
	    					<th scope="col">Co Pemb</th>
	    					<th scope="col">Selesai Co Pemb</th>
	    					<th scope="col">Total Co Pemb.</th>
	    					<th scope="col">Ketua Penguji</th>
	    					<th scope="col">Penguji Sidang</th>
	    					<th scope="col">Total Penguji</th>
	    					<th scope="col">Penguji Proposal</th>
	    					<th scope="col">Dosen Wali</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				@foreach ($semua_dosen as $index => $dosen)
							<tr>
								<td>{{ $index+1 }}</td>
								<td  style="text-align: left;">{{ $dosen->nama }}</td>
								<td>{{ $dosen->nomor_induk }}</td>
								<td>
									@if ($dosen->bidang != null)
										{{ $dosen->bidang->nama }}
									@else
										-
									@endif
								</td>
								@php
									$bimbing = \App\Data::where(['name' => 'pembimbing', 'content' => $dosen->nama])->count();
									$selesai_bimbing = \App\Data::where(['name' => 'pembimbing', 'content' => $dosen->nama])
														->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
														->where('disposisi.progress', '>', 35)
														->count();
									$total_bimbing = $bimbing - $selesai_bimbing;

									$co_bimbing = \App\Data::where(['name' => 'co-pembimbing', 'content' => $dosen->nama])->count();
									$selesai_co_bimbing = \App\Data::where(['name' => 'co-pembimbing', 'content' => $dosen->nama])
														->join('disposisi', 'data.user_id', '=', 'disposisi.user_id')
														->where('disposisi.progress', '>', 35)
														->count();
									$total_co_bimbing = $co_bimbing - $selesai_co_bimbing;
								@endphp
								<td>{{ $bimbing }}</td>
								<td>{{ $selesai_bimbing }}</td>
								<td>{{ $total_bimbing }}</td>
								<td>{{ $co_bimbing }}</td>
								<td>{{ $selesai_co_bimbing }}</td>
								<td>{{ $total_co_bimbing }}</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>
	    				@endforeach
	    			</tbody>
	    		</table>
	    	</div>
	    </div>
	</div>
@endsection