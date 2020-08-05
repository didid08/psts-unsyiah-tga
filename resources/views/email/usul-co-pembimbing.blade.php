<h5>Assalamualaikum wr.wb<h5>
<p>
	Berikut informasi bahwa anda dipilih sebagai co pembimbing TGA dengan data diri mahasiswa :<br><br>
	Nama&nbsp;:&nbsp;&nbsp;{{ $nama }}<br>
	NIM&nbsp;&nbsp;:&nbsp;&nbsp;{{ $nim }}<br><br>
	Apabila setuju, anda dapat klik <a href="{{ route('terima-usul', ['name' => 'co-pembimbing', 'nim' => $nim, 'key' => $key]) }}">setuju</a>. Jika anda tidak setuju anda dapat klik <a href="{{ route('tolak-usul', ['name' => 'co-pembimbing', 'nim' => $nim, 'key' => $key]) }}">tidak setuju</a>.
	<br><br>Pesan ini hanya berlaku 2 hari. Jika dalam waktu 2 hari tidak ada respon, maka secara otomatis anda dinyatakan tidak setuju dan ketua kelompok keahlian akan memilih dosen lainnya.<br>
	Sistem dapat menonaktifkan link diatas secara otomatis jika "pembimbing" telah menolak usulan.<br>
	Terima kasih.<br>
	Wassalamualaikum wr.wb
</p>