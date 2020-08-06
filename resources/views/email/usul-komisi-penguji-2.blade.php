<h5>Assalamualaikum wr.wb</h5>
<p>
	Berikut informasi bahwa anda dipilih sebagai {{ str_replace('ketua penguji', 'pimpinan seminar', str_replace('-', ' ', $target)) }} pada sidang buku dengan data diri mahasiswa : <br><br>
	Nama : {{ $nama }} <br>
	NIM	: {{ $nim }} <br>
	Hari : {{ $hari_sidang }}<br>
	Tanggal : {{ $tgl_sidang }} <br>
	Pukul : {{ $jam_sidang }} <br>
	Tempat : {{ $tempat_sidang }} <br><br>
	Apabila setuju, anda dapat klik <a href="{{ route('terima-usul', ['name' => $target.'-2', 'nim' => $nim, 'key' => $key]) }}">setuju</a>. Jika anda tidak setuju anda dapat klik <a href="{{ route('tolak-usul', ['name' => $target.'-2', 'nim' => $nim, 'key' => $key]) }}">tidak setuju</a>.
	<br><br>Pesan ini hanya berlaku 1 minggu. Jika dalam waktu 1 minggu tidak ada respon, maka secara otomatis anda dinyatakan tidak setuju dan koordinator tga akan memilih dosen lainnya.<br>
	Sistem dapat menonaktifkan link diatas secara otomatis jika komisi penguji lain telah menolak usulan.<br>
	Terima kasih.<br>
	Wassalamualaikum wr.wb
</p>