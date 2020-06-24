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
	    				<!--<tr>
	    					<th scope="col" colspan="4">DOSEN</th>
	    					<th scope="col" colspan="3">PEMBIMBING</th>
	    					<th scope="col" colspan="3">CO PEMBIMBING</th>
	    					<th scope="col" colspan="3">PENGUJI</th>
	    					<th scope="col" colspan="2"></th>
	    				</tr>-->
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
								<td>{{ $data['bimbingan']['total'][$dosen->nama] }}</td>
								<td>{{ $data['bimbingan']['selesai'][$dosen->nama] }}</td>
								<td>{{ $data['bimbingan']['total'][$dosen->nama] - $data['bimbingan']['selesai'][$dosen->nama] }}</td>
								<td>{{ $data['co_bimbingan']['total'][$dosen->nama] }}</td>
								<td>{{ $data['co_bimbingan']['selesai'][$dosen->nama] }}</td>
								<td>{{ $data['co_bimbingan']['total'][$dosen->nama] - $data['co_bimbingan']['selesai'][$dosen->nama] }}</td>
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