<h5>Assalamualaikum wr.wb</h5>
<p>
	Berikut informasi bahwa anda dipilih sebagai {{ str_replace('ketua penguji', 'pimpinan seminar', str_replace('-', ' ', $target)) }} pada sidang buku dengan data diri mahasiswa : <br><br>
	Nama : {{ $nama }} <br>
	NIM	: {{ $nim }} <br>
	Hari : {{ $hari_sidang }}<br>
	Tanggal : {{ $tgl_sidang }} <br>
	Pukul : {{ $jam_sidang }} <br>
	Tempat : {{ $tempat_sidang }} <br><br>
	Apabila setuju, anda dapat klik <a href="{{ route('terima-usul', ['name' => $target.'-2', 'nim' => $nim, 'key' => $key]) }}">setuju</a>. Sedangkan tidak setuju anda dapat mengabaikan pesan ini. Pesan ini hanya berlaku 1 minggu. Jika dalam waktu 1 minggu anda tidak setuju, maka koordinator tga memilih dosen lainnya. <br>
	Terima kasih. <br>
	Wassalamualaikum wr.wb
</p>