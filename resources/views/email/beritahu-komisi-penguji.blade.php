<h5>Assalamualaikum wr.wb</h5>
<p>
	Berikut informasi bahwa anda dipilih sebagai {{ $info->role }} pada seminar proposal dengan data diri mahasiswa : <br><br>
	Nama : {{ $info->nama }} <br>
	NIM : {{ $info->nim }} <br>
	Hari : {{ $info->hari }} <br>
	Tanggal : {{ $info->tgl }} <br>
	Pukul : {{ $info->pukul }} <br>
	Tempat : {{ $info->tempat }} <br><br>
	Berikut berkas seminar proposal (undangan, SK, berita acara, dan daftar hadir seminar proposal)
	<a href="{{ route('main.file', ['filename' => $info->nim.'-berkas-seminar-proposal.zip']) }}">Unduh berkas</a>
	Terima kasih.
</p>
<h5>Wassalamualaikum wr.wb</h5>