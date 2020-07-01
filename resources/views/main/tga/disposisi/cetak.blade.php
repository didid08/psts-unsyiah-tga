<style>
	* {
		font-size: 0.94em;
	}
	.header {
		text-align: center;
		margin-bottom: 0.3em;
		font-weight: bold;
	}
	#table {
		border: 1px solid black;
		vertical-align: middle;
		border-collapse: collapse;
	}
	#table tr td:nth-child(3) {
		text-align: left;
		vertical-align: top;
	}
	#table td {
		text-align: center;
		border: 1px solid black;
		padding: 4px;
	}
	.table-header {
		text-align: center;
		padding: 4px;
		background-color: rgba(0,0,0,0.2);
		font-weight: bold;
	}
</style>

<div class="header">
	LEMBAR DISPOSISI TUGAS AKHIR - JURUSAN TEKNIK SIPIL
</div>
<div class="header">
	FAKULTAS TEKNIK UNIVERSITAS SYIAH KUALA
</div>
<div class="header">
	No. {{ isset($disposisi->no_disposisi) ? $disposisi->no_disposisi : '--' }}
</div>
<div class="header" style="text-align: right;">
	No. Dokumen : PSTS - TA - 03
</div>
<table width="100%">
	<tr>
		<td>Nama Mahasiswa</td>
		<td style="width: 3%;">:</td>
		<td>{{ $profil->nama }}</td>
		<td style="width: 7%;">Bidang</td>
		<td style="width: 3%;">:</td>
		<td>{{ isset($data->bidang) ? str_replace('Bidang ', '', $data->bidang->content) : '--' }}</td>
	</tr>
	<tr>
		<td>NIM</td>
		<td style="width: 3%;">:</td>
		<td>{{ $profil->nomor_induk }}</td>
		<td>No. HP</td>
		<td style="width: 3%;">:</td>
		<td>{{ isset($data->no_hp) ? $data->no_hp->content : '--' }}</td>
	</tr>
</table>

<table width="100%" id="table">
	<tr class="table-header">
		<td>Tahap</td>
		<td>Disposisi</td>
		<td style="vertical-align: middle; text-align: center;">Uraian</td>
		<td>Pejabat<br>Dto/Tanggal</td>
	</tr>
	<tr>
		<td>1</td>
		<td>Prodi S1</td>
		<td>
			<div>
				1. SPP (Asli) <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 2 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				2. KRS (Semester Terakhir) <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 2 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				3. Transkrip Sementara <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 2 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
		</td>
		<td>
			<div>Diperiksa oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 3)
					dto&nbsp;&nbsp;{{ date('d/m/Y', strtotime($data->spp->updated_at)) }}
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator Program Studi
			</div>
		</td>
	</tr>
	<tr>
		<td>2</td>
		<td>Kelompok<br>Keahlian</td>
		<td>
			<div>1. Nama Pembimbing</div>
			<div style="padding: 0.1em 0.8em;">
				@if ($disposisi->progress > 4)
					<i>{{ $data->pembimbing->content }}</i>
				@else
					&nbsp;
				@endif
			</div>
			<div>2. Nama Co. Pembimbing</div>
			<div style="padding: 0.1em 0.8em;">
				@if ($disposisi->progress > 4)
					<i>{{ $data->co_pembimbing->content }}</i>
				@else
					&nbsp;
				@endif
			</div>
			<div>Rencana Judul TGA</div>
			<div style="padding: 0.1em 0.8em;">
				@if ($disposisi->progress > 4)
					<i>{{ $data->judul_tga->content }}</i>
				@else
					&nbsp;
				@endif
			</div>
		</td>
		<td>
			<div>Diusulkan oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 4)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Ketua Kelompok Keahlian
			</div>
		</td>
	</tr>
	<tr>
		<td>3</td>
		<td>Prodi S1</td>
		<td>
			<div>1. SK Penunjukan Pembimbing <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 6 ? 'checked' : '' }}></span></div>
			<div style="padding: 0.1em 0.8em;">
				@if ($disposisi->progress > 6)
					No. {{ $data->sk_pembimbing->no }}
					<span style="float: right;">Tgl. {{ date('d/m/Y', strtotime($data->sk_pembimbing->tgl)) }} </span>
				@else
					No.
					<span style="float: right;">Tgl.</span>
				@endif
			</div>
			<div>2. Surat Tugas Pengambilan Data Lab / Lapangan <span style="float: right;"><input type="checkbox" {{ $disposisi->progress_optional > 5 ? 'checked' : '' }}></span></div>
			<div style="padding: 0.1em 0.8em;">
				@if ($disposisi->progress_optional > 5)
					No. {{ $data->stpd->no }}
					<span style="float: right;">Tgl. {{ date('d/m/Y', strtotime($data->stpd->tgl)) }} </span>
				@else
					No.
					<span style="float: right;">Tgl.</span>
				@endif
			</div>
		</td>
		<td>
			<div>Penetapan SK oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 6)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator Program Studi
			</div>
		</td>
	</tr>
	<tr class="table-header">
		<td colspan="4">PROSES PROPOSAL TUGAS AKHIR</td>
	</tr>
	<tr>
		<td>4</td>
		<td>Pembimbing<br>TGA</td>
		<td>
			<div>
				Pembimbing (co) telah menerima SK <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 7 ? 'checked' : '' }}></span>
			</div>
			<div>
				Jumlah Asistensi <b>{{ $disposisi->progress > 7 ? $data->jumlah_asistensi->content : '.......' }}</b> Kali
			</div>
			<div>
				Masa Pembimbingan Proposal <b>{{ $disposisi->progress > 7 ? $data->masa_pembimbingan_proposal->content : '.......' }}</b> Bulan
			</div>
		</td>
		<td>
			<div>Persetujuan Diseminarkan</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 7)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Pembimbing TGA
			</div>
		</td>
	</tr>
	<tr>
		<td>5</td>
		<td>Koordinator<br>TGA</td>
		<td>
			<div>
				1. Lembar Asistensi (Setuju diseminarkan) <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 9 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				2. Draft Buku Proposal <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 9 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				3. Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Seminar Proposal (Dokumen PSTS-4)
			</div>
		</td>
		<td>
			<div>Dijadwalkan oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 10)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator TGA
			</div>
		</td>
	</tr>
	<tr>
		<td>6</td>
		<td>Prodi S1</td>
		<td>
			<div>
				1. SK Komisi Penguji Seminar Proposal <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 11 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				2. Undangan Seminar <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 11 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				3. Berkas lainnya untuk Seminar (BA, seminar, dll) <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 11 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
		</td>
		<td>
			<div>Penetapan SK oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 12)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator Program Studi
			</div>
		</td>
	</tr>
	<tr>
		<td>7</td>
		<td colspan="3" style="text-align: left;">Pelaksanaan Seminar Proposal</td>
	</tr>
	<tr>
		<td>8</td>
		<td>Prodi S1</td>
		<td>
			<div>
				1. Berita Acara Seminar Proposal <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 16 ? 'checked' : '' }}>&nbsp;&nbsp;Lengkap</span>
			</div>
			<div>
				2. Buku Proposal <span style="float: right; margin-right: 1.2em;"><input type="checkbox" {{ $disposisi->progress > 16 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
		</td>
		<td>
			<div>Divalidasi dan Disahkan oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 17)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator Program Studi
			</div>
		</td>
	</tr>
	<tr>
		<td>9</td>
		<td>Administrasi</td>
		<td>
			<div>
				1. Kelengkapan dokumen administrasi seminar proposal <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 19 ? 'checked' : '' }}></span>
			</div>
			<div>
				2. Softcopy administrasi seminar proposal dikirim ke <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 19 ? 'checked' : '' }}></span>
			</div>
			<div style="margin-left: 1em;">
				nama file: Nim_Proposal.zip
			</div>
			<div style="margin-left: 1em;">
				email administrasi:  jtspsts{!! '@' !!}gmail.com
			</div>
		</td>
		<td>
			<div>Diperiksa oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 19)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Administrasi
			</div>
		</td>
	</tr>
	<tr class="table-header">
		<td colspan="4">PROSES TUGAS AKHIR/SKRIPSI</td>
	</tr>
	<tr>
		<td>10</td>
		<td>Pembimbing<br>TGA</td>
		<td>
			<div>
				Pembimbing (co) telah menerima SK <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 20 ? 'checked' : '' }}></span>
			</div>
			<div>
				Jumlah Asistensi <b>{{ $disposisi->progress > 20 ? $data->jumlah_asistensi_2->content : '.......' }}</b> Kali
			</div>
			<div>
				Masa Pembimbingan Buku TGA <b>{{ $disposisi->progress > 20 ? $data->masa_pembimbingan_buku_tga->content : '.......' }}</b> Bulan
			</div>
		</td>
		<td>
			<div>Persetujuan Disidangkan</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 20)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Pembimbing TGA
			</div>
		</td>
	</tr>
	<tr>
		<td>11</td>
		<td>Koordinator<br>TGA</td>
		<td>
			<div>
				1. Lembar Asistensi (Setuju disidangkan) <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 22 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				2. Draft Buku TGA <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 22 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				3. Koordinator TGA mengusulkan Komisi Penguji dan Jadwal Sidang buku
			</div>
		</td>
		<td>
			<div>Dijadwalkan oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 23)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator TGA
			</div>
		</td>
	</tr>
	<tr>
		<td>12</td>
		<td>Prodi S1</td>
		<td>
			<div>
				1. SK Komisi Penguji Sidang Buku <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 24 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				2. Undangan Sidang Buku <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 24 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
			<div>
				3. Berkas sidang lainnya <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 24 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
		</td>
		<td>
			<div>Penetapan SK oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 25)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator Program Studi
			</div>
		</td>
	</tr>
	<tr>
		<td>13</td>
		<td colspan="3" style="text-align: left;">Pelaksanaan Sidang Buku TGA</td>
	</tr>
	<tr>
		<td>14</td>
		<td>Prodi S1</td>
		<td>
			<div>
				1. Berita Acara Sidang Buku <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 29 ? 'checked' : '' }}>&nbsp;&nbsp;Lengkap</span>
			</div>
			<div>
				2. Buku TGA <span style="float: right; margin-right: 1.2em;"><input type="checkbox" {{ $disposisi->progress > 29 ? 'checked' : '' }}>&nbsp;&nbsp;Ada</span>
			</div>
		</td>
		<td>
			<div>Divalidasi dan Disahkan oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 30)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Koordinator Program Studi
			</div>
		</td>
	</tr>
	<tr>
		<td>15</td>
		<td>Pembimbing<br>TGA</td>
		<td>
			<div>
				- Pembimbing dan Pembahas telah menerima hard/soft copy SK, Lembar Pengesahan, dan Buku Laporan KP (jika diperlukan) <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 32 ? 'checked' : '' }}></span>
			</div>
			<div>
				- Email Pembimbing dan Pembahas <br>
				[cek di https://unsyiah.ac.id/faculty-and-staff]
			</div>
		</td>
		<td>
			<div>Diterima oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 32)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Pembimbing TGA
			</div>
		</td>
	</tr>
	<tr>
		<td>16</td>
		<td>Administrasi</td>
		<td>
			<div>
				1. Kelengkapan dokumen administrasi sidang buku <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 34 ? 'checked' : '' }}></span>
			</div>
			<div>
				2. Softcopy dokumen administrasi <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 34 ? 'checked' : '' }}></span>
			</div>
			<div>
				3. Kelengkapan dokumen yudisium dan wisuda <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 34 ? 'checked' : '' }}></span>
			</div>
			<div style="margin-left: 1em;">
				(Checklist kelengkapan sesuai Dokumen PSTS-5)
			</div>
			<div style="margin-left: 1em;">
				nama file: Nim_Sidang.zip <span style="float: right;"><input type="checkbox" {{ $disposisi->progress > 34 ? 'checked' : '' }}></span>
			</div>
			<div style="margin-left: 1em;">
				email administrasi:  jtspsts{!! '@' !!}gmail.com
			</div>
		</td>
		<td>
			<div>Diperiksa oleh</div>
			<div style="padding: 0.5em;">
				@if ($disposisi->progress > 34)
					dto
				@else
					&nbsp;
				@endif
			</div>
			<div style="font-weight: bold;">
				Administrasi
			</div>
		</td>
	</tr>
</table>
<span style="font-size: 0.8em;">* Lembar disposisi dilampirkan setiap proses administrasi</span>
<div>
	<div style="float:right; text-align: left; font-size: 0.8em;">
		Koordinator Program Studi
		@if ($disposisi->progress > 35)
			<div style="margin: 0.5em; margin-left: 3em; font-weight: bold;">dto</div>
		@else
			<br><br><br>
		@endif
		Fachrurrazi, S.T., M.T.
		<br>
		Nip. 197005062000121001
	</div>
</div>