@extends('main.master')

@section('custom-style')
	<style>
		#biodata tr td:first-of-type {
			width: 40%;
		}
	</style>
@endsection

@section('content')
	<div class="container">
		<div class="card height-auto">
			<div class="card-title text-bold pl-4 pr-4 pt-4" style="font-size: 1.2em;">
				BIODATA MAHASISWA
			</div>
			<div class="card-body" style="overflow-x: auto;">
				<form action="{{ route('main.mahasiswa.biodata.process') }}" method="post">
					@csrf
						<table class="table table-bordered table-striped form-group" id="biodata">
							<tr class="bg-warning text-bold">
								<td colspan="2">A. IDENTITAS PRIBADI</td>
							</tr>
							<tr>
								<td>Nama</td>
								<td>{{ $input_value['nama'] }}</td>
							</tr>
							<tr>
								<td>Nomor Mahasiswa</td>
								<td>{{ $input_value['nim'] }}</td>
							</tr>
							<tr>
								<td>Tempat/Tanggal Lahir</td>
								<td>{{ $input_value['tempat-tgl-lahir'] }}</td>
							</tr>
							<tr>
								<td colspan="2" class="bg-warning text-bold">B. KETERANGAN STUDI</td>
							</tr>
							<tr>
								<td>Fakultas/Jurusan/Program Studi</td>
								<td>Teknik/Teknik Sipil/S-1</td>
							</tr>
							<tr>
								<td>Tahun Masuk</td>
								<td>
									<input type="text" class="form-control" name="tahun-masuk" value="{{ $input_value['tahun-masuk'] }}">
								</td>
							</tr>
							<tr>
								<td>Asal SMTA</td>
								<td>
									<input type="text" class="form-control" name="asal-smta" value="{{ $input_value['asal-smta'] }}">
								</td>
							</tr>
							<tr>
								<td>Tahun Ijazah SMTA</td>
								<td>
									<input type="text" class="form-control" name="tahun-ijazah-smta" value="{{ $input_value['tahun-ijazah-smta'] }}">
								</td>
							</tr>
							<tr>
								<td colspan="2" class="bg-warning text-bold">C. STATUS MAHASISWA</td>
							</tr>
							<tr>
								<td>Terdaftar Sebagai Mahasiswa</td>
								<td>
									<input type="text" class="form-control" name="terdaftar-sebagai-mahasiswa" value="{{ $input_value['terdaftar-sebagai-mahasiswa'] }}">
								</td>
							</tr>
							<tr>
								<td>Bekerja</td>
								<td>
									<input type="text" class="form-control" name="bekerja" value="{{ $input_value['bekerja'] }}">
								</td>
							</tr>
							<tr>
								<td>Kawin</td>
								<td>
									<input type="text" class="form-control" name="kawin" value="{{ $input_value['kawin'] }}">
								</td>
							</tr>
							<tr>
								<td>Biaya Pendidikan</td>
								<td>
									<input type="text" class="form-control" name="biaya-pendidikan" value="{{ $input_value['biaya-pendidikan'] }}">
								</td>
							</tr>
							<tr>
								<td colspan="2" class="bg-warning text-bold">D. KETERANGAN KELUARGA</td>
							</tr>
							<tr>
								<td>Jumlah Saudara Kandung</td>
								<td>
									<input type="text" class="form-control" name="jumlah-saudara-kandung" value="{{ $input_value['jumlah-saudara-kandung'] }}">
								</td>
							</tr>
							<tr>
								<td>Yang Sudah Sarjana</td>
								<td>
									<input type="text" class="form-control" name="yang-sudah-sarjana" value="{{ $input_value['yang-sudah-sarjana'] }}">
								</td>
							</tr>
							<tr>
								<td>Sedang Kuliah</td>
								<td>
									<input type="text" class="form-control" name="sedang-kuliah" value="{{ $input_value['sedang-kuliah'] }}">
								</td>
							</tr>
							<tr>
								<td>Sedang Sekolah</td>
								<td>
									<input type="text" class="form-control" name="sedang-sekolah" value="{{ $input_value['sedang-sekolah'] }}">
								</td>
							</tr>
							<tr>
								<td colspan="2" class="bg-warning pl-4">NAMA/PEKERJAAN ORANG TUA</td>
							</tr>
							<tr>
								<td class="pl-4">Ayah</td>
								<td>
									<input type="text" class="form-control" name="nama-ayah" value="{{ $input_value['nama-ayah'] }}">
								</td>
							</tr>
							<tr>
								<td class="pl-4">Ibu</td>
								<td>
									<input type="text" class="form-control" name="nama-ibu" value="{{ $input_value['nama-ibu'] }}">
								</td>
							</tr>
							<tr>
								<td colspan="2" class="bg-warning pl-4">PENDIDIKAN TERTINGGI ORANG TUA</td>
							</tr>
							<tr>
								<td class="pl-4">Ayah</td>
								<td>
									<input type="text" class="form-control" name="pendidikan-ayah" value="{{ $input_value['pendidikan-ayah'] }}">
								</td>
							</tr>
							<tr>
								<td class="pl-4">Ibu</td>
								<td>
									<input type="text" class="form-control" name="pendidikan-ibu" value="{{ $input_value['pendidikan-ibu'] }}">
								</td>
							</tr>
							<tr>
								<td colspan="2" class="bg-warning text-bold">E. LAIN-LAIN</td>
							</tr>
							<tr>
								<td>Agama</td>
								<td>{{ $input_value['agama'] }}</td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td>{{ $input_value['jenis-kelamin'] }}</td>
							</tr>
							<tr>
								<td>Alamat Tempat Tinggal</td>
								<td>
									<input type="text" class="form-control" name="alamat" value="{{ $input_value['alamat'] }}">
								</td>
							</tr>
							<tr>
								<td class="bg-warning text-bold">F. JUDUL SKRIPSI/TGA</td>
								<td>
									{{ $input_value['judul-skripsi'] }}
								</td>
							</tr>
							<tr>
								<td colspan="2" class="align-middle text-right">
									<button type="submit" class="btn btn-lg btn-success text-bold">Simpan</button>
								</td>
							</tr>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection