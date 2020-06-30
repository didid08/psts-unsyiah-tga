<h5>Assalamualaikum wr.wb</h5>
<p>
	Berikut informasi bahwa anda dipilih sebagai {{ $info->role }} pada sidang buku dengan data diri mahasiswa : <br><br>
	Nama : {{ $info->nama }} <br>
	NIM : {{ $info->nim }} <br>
	Hari : {{ $info->hari }} <br>
	Tanggal : {{ $info->tgl }} <br>
	Pukul : {{ $info->pukul }} <br>
	Tempat : {{ $info->tempat }} <br><br>
	Berikut berkas sidang buku (undangan, SK, berita acara, dan daftar hadir sidang buku)
	<a href="{{ route('main.file', ['filename' => $info->nim.'-berkas-sidang-buku-tga.zip']) }}">Unduh berkas</a>
	Terima kasih.
</p>
<h5>Wassalamualaikum wr.wb</h5>