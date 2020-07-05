@extends('main.master')

@section('custom-script')
    <script>
        $('#list-mahasiswa').dataTable();
        $('#list-mahasiswa-optional').dataTable();
    </script>
@endsection

@section('breadcumb')
	<li class="breadcrumb-item"><a href="/">{{ ucfirst($category) }}</a></li>
	<li class="breadcrumb-item active">{{ $subtitle }}</li>
@endsection

@section('content')
	<div class="container">
		<div class="card height-auto">
            <div class="card-body" style="overflow-x: auto;">
                @if ($category == 'tamu')
                    <h3>Selamat Datang</h3>
                	<h6>Informasi yang berkaitan dengan dosen dapat dilihat di menu <i>Dosen</i></h6>
                @elseif (isset($role->mhs))
                    <h3>Selamat Datang {{ $nama }}</h3>
                	<h6>Informasi yang berkaitan dengan TGA dapat dilihat menu <i>TGA</i></h6>
                @else
                    <h5 class="mb-4">Daftar Proses Mahasiswa</h5>
                    @php
                        $tahap = [
                            [1,2,3], //Tahap 1
                            [4], //Tahap 2
                            [5,6], //Tahap 3
                            [7], //Tahap 4
                            [8,9,10], //Tahap 5
                            [11,12], //Tahap 6
                            [13,14], //Tahap 7
                            [15,16,17], //Tahap 8
                            [18,19], //Tahap 9
                            [20], //Tahap 10
                            [21,22,23], //Tahap 11
                            [24,25], //Tahap 12
                            [26,27], //Tahap 13
                            [28,29,30], //Tahap 14
                            [31,32], //Tahap 15
                            [33,34,35] //Tahap 16
                        ];

                        /*$tahap_opsional = [
                            [1,2,3],
                            [4,5]
                        ];*/

                        $namaProses = [
                            null,//1
                            '1. Usulan TGA',//2
                            '1. Persetujuan Usulan TGA',//3
                            '1. Pengusulan Pembimbing dan Co',//4
                            '2. Usulan SK Pembimbing',//5
                            '2. Penetapan SK Pembimbing',//6
                            '1. Persetujuan Seminar dan Sidang',//7
                            null,//8
                            '5. Usulan Seminar Proposal',//9
                            '1. Usulan Seminar Proposal',//10
                            '6. Usulan SK Penguji Seminar Proposal',//11
                            '4. Penetapan SK Penguji Seminar Proposal',//12
                            '2. Seminar/Sidang',//13
                            null,//14
                            null,//15
                            '7. Usulan Pengesahan Seminar Proposal',//16
                            '5. Pengesahan Seminar Proposal',//17
                            null,//18
                            '8. Usulan Kelengkapan Dokumen Administrasi Seminar Proposal',//19
                            '1. Persetujuan Seminar dan Sidang',//20
                            null,//21
                            '9. Usulan Sidang',//22
                            '2. Usulan Sidang',//23
                            '10. Usulan SK Penguji Sidang',//24
                            '6. Penetapan SK Penguji Sidang',//25
                            '2. Seminar/Sidang',//26
                            null,//27
                            null,//28
                            '11. Usulan Pengesahan Sidang',//29
                            '7. Pengesahan Sidang',//30
                            null,//31
                            '1. Persetujuan Seminar dan Sidang',//32
                            null,//33
                            '12. Usulan Yudisium',//34
                            '8. Pengesahan Usulan Yudisium'//35
                        ];
                        $roleProgress = [
                            'mhs',//1
                            'admin',//2
                            'koor_prodi',//3
                            'ketua_kel_keahlian',//4
                            'admin',//5
                            'koor_prodi',//6
                            'pembimbing_co',//7
                            'mhs',//8,
                            'admin',//9
                            'koor_tga',//10
                            'admin',//11
                            'koor_prodi',//12
                            'komisi_penguji',//13
                            'mhs',//14
                            'mhs',//15
                            'admin',//16
                            'koor_prodi',//17
                            'mhs',//18
                            'admin',//19
                            'pembimbing_co',//20
                            'mhs',//21
                            'admin',//22
                            'koor_tga',//23
                            'admin',//24
                            'koor_prodi',//25
                            'komisi_penguji',//26
                            'mhs',//27
                            'mhs',//28
                            'admin',//29
                            'koor_prodi',//30
                            'mhs',//31
                            'pembimbing_co',//32
                            'mhs',//33
                            'admin',//34
                            'koor_prodi'//35
                        ];
                    @endphp
                    <table class="table table-bordered table-striped" id="list-mahasiswa">
                        <thead>
                            <tr class="bg-info">
                                <th class="align-middle text-center">No</th>
                                <th class="align-middle">Nama</th>
                                <th class="align-middle text-center">NIM</th>
                                <th class="align-middle">Nomor Urutan di Menu TGA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach($semua_mahasiswa as $index => $mahasiswa)
                                @php
                                    $r = $roleProgress[$mahasiswa->progress-1];
                                @endphp
                                @if (isset($role->$r))
                                    @if ($r == 'ketua_kel_keahlian')
                                        @if ($mahasiswa->user->data->where('name', 'bidang')->first()->content == $saya->bidang->nama)
                                            @php
                                                $no++;
                                            @endphp
                                            <tr>
                                                <td class="align-middle text-center">{{ $no }}</td>
                                                <td class="align-middle">
                                                    <a href="/main/tga/{{ str_replace('pembimbing-co', 'pembimbing', str_replace('_', '-', $r)) }}/{{ str_replace(' ', '-', strtolower(explode('. ', $namaProses[$mahasiswa->progress-1])[1])) }}">{{ $mahasiswa->user->nama }}</a>
                                                </td>
                                                <td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
                                                <td class="align-middle">{{ $namaProses[$mahasiswa->progress-1] }}</td>
                                            </tr>
                                        @endif
                                    @elseif ($r == 'pembimbing_co')
                                        @if ($mahasiswa->user->data->where('name', 'pembimbing')->first()->content == $saya->nama)
                                            @php
                                                $no++;
                                            @endphp
                                            <tr>
                                                <td class="align-middle text-center">{{ $no }}</td>
                                                <td class="align-middle">
                                                    <a href="/main/tga/{{ str_replace('pembimbing-co', 'pembimbing', str_replace('_', '-', $r)) }}/{{ str_replace(' ', '-', strtolower(explode('. ', $namaProses[$mahasiswa->progress-1])[1])) }}">{{ $mahasiswa->user->nama }}</a>
                                                </td>
                                                <td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
                                                <td class="align-middle">{{ $namaProses[$mahasiswa->progress-1] }}</td>
                                            </tr>
                                        @endif
                                    @elseif ($r == 'komisi_penguji')
                                        @if ($mahasiswa->progress == 26)
                                            @if ($mahasiswa->user->data->where('name', 'ketua-penguji-2')->first()->content == $saya->nama)
                                                @php
                                                    $no++;
                                                @endphp
                                                <tr>
                                                    <td class="align-middle text-center">{{ $no }}</td>
                                                    <td class="align-middle">
                                                        <a href="/main/tga/{{ str_replace('pembimbing-co', 'pembimbing', str_replace('_', '-', $r)) }}/{{ str_replace(' ', '-', strtolower(explode('. ', $namaProses[$mahasiswa->progress-1])[1])) }}">{{ $mahasiswa->user->nama }}</a>
                                                    </td>
                                                    <td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
                                                    <td class="align-middle">{{ $namaProses[$mahasiswa->progress-1] }}</td>
                                                </tr>
                                            @endif
                                        @else
                                            @if ($mahasiswa->user->data->where('name', 'ketua-penguji')->first()->content == $saya->nama)
                                                @php
                                                    $no++;
                                                @endphp
                                                <tr>
                                                    <td class="align-middle text-center">{{ $no }}</td>
                                                    <td class="align-middle">
                                                        <a href="/main/tga/{{ str_replace('pembimbing-co', 'pembimbing', str_replace('_', '-', $r)) }}/{{ str_replace(' ', '-', strtolower(explode('. ', $namaProses[$mahasiswa->progress-1])[1])) }}">{{ $mahasiswa->user->nama }}</a>
                                                    </td>
                                                    <td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
                                                    <td class="align-middle">{{ $namaProses[$mahasiswa->progress-1] }}</td>
                                                </tr>
                                            @endif
                                        @endif
                                    @else
                                        @php
                                            $no++;
                                        @endphp
                                        <tr>
                                            <td class="align-middle text-center">{{ $no }}</td>
                                            <td class="align-middle">
                                                <a href="/main/tga/{{ str_replace('pembimbing-co', 'pembimbing', str_replace('_', '-', $r)) }}/{{ str_replace(' ', '-', strtolower(explode('. ', $namaProses[$mahasiswa->progress-1])[1])) }}">{{ $mahasiswa->user->nama }}</a>
                                            </td>
                                            <td class="align-middle text-center">{{ $mahasiswa->user->nomor_induk }}</td>
                                            <td class="align-middle">{{ $namaProses[$mahasiswa->progress-1] }}</td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{--<h5 class="mt-4 mb-4">Daftar Proses Opsional Mahasiswa</h5>
                    <table class="table table-bordered table-striped" id="list-mahasiswa-optional">
                        <thead>
                            <tr class="bg-warning">
                                <th class="align-middle text-center">No</th>
                                <th class="align-middle">Nama</th>
                                <th class="align-middle text-center">NIM</th>
                                <th class="align-middle">Proses</th>
                            </tr>
                        </thead>
                    </table>--}}
                @endif
            </div>
        </div>
	</div>
@endsection