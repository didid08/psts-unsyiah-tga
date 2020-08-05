<style>
	html, body {
		text-align: center;
		padding:0;
		font-size: 0.9em;
	}
	#table2 {
		table-layout: auto;
		border-collapse: collapse;
	}
	#table2 tr td {
		vertical-align: top;
		text-align: left;
		padding: 0.2em;
	}
	#table2 tr td:nth-child(3) ol {
		margin: 0;
		padding-left: 1em;
		list-style-type:lower-alpha;
	}
</style>
<table style="margin-bottom: 1em; border-collapse: collapse; border-bottom: 4px solid black;" width="100%">
	<tr>
		<td style="vertical-align: middle; padding-bottom: 1.5em;">
			<img src="{{ public_path('dist/img/logo-unsyiah-3.png') }}" alt="Logo Unsyiah" width="120em">		
		</td>
		<td style="vertical-align: middle; text-align: center; line-height: 1.3em; width: 99%;">
			<div style="font-size: 1.2em;">
				KEMENTERIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI <br>
				UNIVERSITAS SYIAH KUALA <br>
				FAKULTAS TEKNIK <br>
				<span style="font-weight: bold;">JURUSAN TEKNIK SIPIL</span>
			</div>
			<div style="font-size: 0.95em; padding-bottom: 0.3em;">
				Jalan Tengku Syech Abdur Rauf No.7, Darussalam, Banda Aceh 23111 <br>
				Telepon (0651) 755444 <br>
				Website/domain: sipil.unsyiah.ac.id; e-mail: tekniksipil{!! '@' !!}unsyiah.ac.id
			</div>
		</td>
	</tr>
</table>
<p style="text-align: center; font-size: 1em;">
	SURAT KEPUTUSAN <br>
	KETUA PRODI JURUSAN TEKNIK SIPIL UNIVERSITAS SYIAH KUALA <br>
	Nomor : {{ $sk_pembimbing['no'] }} <br>
	Tentang <br>
	PENETAPAN PEMBIMBING DAN CO PEMBIMBING TUGAS AKHIR (TA) <br>
</p>
<div style="text-align: left;">
	<h5>Ketua Prodi Teknik Sipil Universitas Syiah Kuala</h5>
	<table id="table2">
		<tr>
			<td>Menimbang</td>
			<td>:</td>
			<td>
				<ol>
					<li>Bahwa Tugas Akhir dan Tesis merupakan mata kuliah wajib dalam kurikulum Jurusan Teknik Sipil Universitas Syiah Kuala.</li>
					<li>Bahwa untuk pelaksanaan proses tersebut pada butir a, perlu ditentukan Pembimbing dan Co. Pembimbing untuk setiap mahasiswa yang mengambil mata kuliah Tugas Akhir dan Tesis.</li>
					<li>Sehubungan dengan butir a dan b tersebut di atas, perlu ditetapkan nama-nama dosen yang akan ditetapkan menjadi Pembimbing Tugas Akhir dan Tesis pada Jurusan Teknik Sipil Universitas Syiah Kuala.</li>
					<li>Sebagai tindak lanjut dari butir a, b dan c tersebut di atas, perlu diterbitkan Surat Keputusannya.</li>
				</ol>
			</td>
		</tr>
		<tr>
			<td>Mengingat</td>
			<td>:</td>
			<td>
				<ol>
					<li>Undang-Undang Nomor 20 Tahun 2003, tentang Sistem Pendidikan Nasional;</li>
					<li>Undang-Undang Nomor 12 Tahun 2012. tentang Pendidikan Tinggi;</li>
					<li>Keputusan Rektor Universitas Syiah Kuala Nomor: 1011 Tahun 2016, tentang Penetapan Panduan Akademik Universitas Syiah Kuala 2016.</li>
					<li>SK Nomor 1930 Tahun 2015, Panduan Kurikulum Program Studi Teknik Sipil Fakultas Teknik Tahun 2016-2020. </li>
				</ol>
			</td>
		</tr>
		<tr>
			<td>MEMUTUSKAN</td>
			<td colspan="2">:</td>
		</tr>
		<tr>
			<td>Menetapkan</td>
			<td colspan="2">:</td>
		</tr>
		<tr>
			<td>Pertama</td>
			<td>:</td>
			<td>Menetapkan, {{ $pembimbing['nama'] }} dengan NIP. {{ $pembimbing['nip'] }} sebagai Pembimbing dan {{ $co_pembimbing['nama'] }} dengan NIP. {{ $co_pembimbing['nip'] }} sebagai Co. Pembimbing dari Mahasiswa yang bernama {{ $mahasiswa->nama }} dengan NIM. {{ $mahasiswa->nomor_induk }}, dengan Judul Tugas Akhir : {{ $mahasiswa->data->firstWhere('name', 'judul-tga')->content }}</td>
		</tr>
		<tr>
			<td>Kedua</td>
			<td>:</td>
			<td>Dosen Pembimbing dan Co. Pembimbing bekerja dibawah Koordinasi Ketua Program Studi Sarjana Teknik Sipil</td>
		</tr>
	</table>
</div>
<div style="text-align: left; padding-top:3em; padding-left: 30em;">
	Ditetapkan di Banda Aceh <br>
	Pada tanggal : {{ $disposisi->progress > 6 ? \Carbon\Carbon::parse($sk_pembimbing['tgl'])->translatedFormat('d F Y') : \Carbon\Carbon::now()->translatedFormat('d F Y') }}
	<br><br><span style="margin-left: 3em;">dto</span><br><br>
	Fachrurrazi, S.T., M.T.<br>
	NIP. 197005062000121001
</div>