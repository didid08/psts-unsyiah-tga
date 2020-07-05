@extends('main.master')

@section('custom-script')
  <script>
    $("#daftar-mahasiswa").dataTable();
    $("#daftar-dosen").dataTable();
    $("input[type=password]").val("");

    function editAkunMahasiswa (nama, nim) {
      $("#edit-akun-mahasiswa-title").html('Edit Akun '+nama+' ('+nim+')');
      $("#edit-akun-mahasiswa-form").attr('action', '{{ route('main.admin.akun.edit') }}/mahasiswa/'+nim);
      $("#nama-mahasiswa").val(nama);
      $("#nim-mahasiswa").val(nim);
    }

    function editAkunDosen (nama, nip, email) {
      $("#edit-akun-dosen-title").html('Edit Akun '+nama+' ('+nip+')');
      $("#edit-akun-dosen-form").attr('action', '{{ route('main.admin.akun.edit') }}/dosen/'+nip);
      $("#nama-dosen").val(nama);
      $("#nip-dosen").val(nip);
      if (email != 'empty') {
        $("#email").val(email);
      }
    }

    function hapusAkun (category, nama, nomorInduk) {
      $("#hapus-akun-message").html(
        'Apakah anda yakin untuk menghapus akun dengan informasi berikut:<br>'+
        '<b class="mr-2">Nama:</b>'+nama+'<br>'+
        '<b class="mr-2">Nomor Induk:</b>'+nomorInduk+'<br>'+
        '<b class="mr-2">Kategori:</b>'+category.charAt(0).toUpperCase()+category.slice(1)+'<br>'
      );
      $("#hapus-akun-form").attr('action', '{{ route('main.admin.akun.hapus') }}/'+category+'/'+nomorInduk);
    }
  </script>
@endsection

@section('content')
  <div class="modal fade" id="tambah-akun" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Tambah Akun</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
          </div>
          <form action="{{ route('main.admin.akun.tambah') }}" method="post">
            <div class="modal-body">
              @csrf
              <table class="table table-light">
                <tr>
                  <td class="align-middle" style="width: 20%;">Kategori</td>
                  <td class="align-middle">
                    <select name="category" class="form-control">
                      <option value="mahasiswa">Mahasiswa</option>
                      <option value="dosen">Dosen</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="align-middle">Nama</td>
                  <td class="align-middle">
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama">
                  </td>
                </tr>
                <tr>
                  <td class="align-middle">Nomor Induk</td>
                  <td class="align-middle">
                    <input type="text" class="form-control" name="nomor-induk" placeholder="Masukkan nomor induk">
                  </td>
                </tr>
                <tr>
                  <td class="align-middle">Email <i>(Opsional)</i></td>
                  <td class="align-middle">
                    <input type="email" class="form-control" name="email" placeholder="Masukkan email">
                  </td>
                </tr>
                <tr>
                  <td class="align-middle">Password</td>
                  <td class="align-middle">
                    <input type="password" class="form-control" name="password" placeholder="Masukkan password baru">
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Kirim</button>
              </div>
            </form>
        </div>
    </div>
  </div>
  <div class="modal fade" id="edit-akun-mahasiswa" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="edit-akun-mahasiswa-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
          </div>
          <form action="" method="post" id="edit-akun-mahasiswa-form">
            <div class="modal-body">
              @method('put')
              @csrf
              <table class="table table-light">
                <tr>
                  <td class="align-middle" style="width: 20%;">Nama</td>
                  <td class="align-middle">
                    <input type="text" class="form-control" name="nama" id="nama-mahasiswa" placeholder="Masukkan nama">
                  </td>
                </tr>
                <tr>
                  <td class="align-middle">NIM</td>
                  <td class="align-middle">
                    <input type="text" class="form-control" name="nomor-induk" id="nim-mahasiswa" placeholder="Masukkan nomor induk">
                  </td>
                </tr>
                <tr>
                  <td class="align-middle">Password <i>(Opsional)</i></td>
                  <td class="align-middle">
                    <input type="password" class="form-control" name="password" placeholder="Masukkan password baru">
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </form>
        </div>
    </div>
  </div>
  <div class="modal fade" id="edit-akun-dosen" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="edit-akun-dosen-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
          </div>
          <form action="" method="post" id="edit-akun-dosen-form">
            <div class="modal-body">
              @method('put')
              @csrf
              <table class="table table-light">
                <tr>
                  <td class="align-middle" style="width: 20%;">Nama</td>
                  <td class="align-middle">
                    <input type="text" class="form-control" name="nama" id="nama-dosen" placeholder="Masukkan nama">
                  </td>
                </tr>
                <tr>
                  <td class="align-middle">NIP</td>
                  <td class="align-middle">
                    <input type="text" class="form-control" name="nomor-induk" id="nip-dosen" placeholder="Masukkan nomor induk">
                  </td>
                </tr>
                <tr>
                  <td class="align-middle">Email <i>(Opsional)</i></td>
                  <td class="align-middle">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email">
                  </td>
                </tr>
                <tr>
                  <td class="align-middle">Password <i>(Opsional)</i></td>
                  <td class="align-middle">
                    <input type="password" class="form-control" name="password" placeholder="Masukkan password baru">
                  </td>
                </tr>
              </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </form>
        </div>
    </div>
  </div>
  <div class="modal fade" id="hapus-akun" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Hapus Akun</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
          </div>
          <form action="" method="post" id="hapus-akun-form">
            <div class="modal-body">
              @method('delete')
              @csrf
              <div id="hapus-akun-message"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Iya</button>
              </div>
            </form>
        </div>
    </div>
  </div>

  <div class="container">
    <div class="card height-auto mb-2">
      <div class="card-body">
        <button type="button" class="btn btn-info text-bold" data-toggle="modal" data-target="#tambah-akun"><i class="fa fa-plus mr-2"></i>Tambah Akun</button>
      </div>
    </div>
    <div class="card card-primary card-outline card-outline-tabs">
      <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="akun-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="mahasiswa-tab" data-toggle="pill" href="#mahasiswa" role="tab" aria-controls="mahasiswa" aria-selected="true">Mahasiswa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="dosen-tab" data-toggle="pill" href="#dosen" role="tab" aria-controls="dosen" aria-selected="false">Dosen</a>
          </li>
          {{--<li class="nav-item">
            <a class="nav-link" id="role-tab" data-toggle="pill" href="#role" role="tab" aria-controls="role" aria-selected="false">Role/Jabatan</a>
          </li>--}}
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="akun-tabContent">
          <div class="tab-pane fade active show" id="mahasiswa" role="tabpanel" aria-labelledby="mahasiswa-tab">
             <table class="table table-bordered table-striped" id="daftar-mahasiswa">
               <thead>
                 <tr class="bg-info">
                   <th class="align-middle text-center">No</th>
                   <th>Nama</th>
                   <th class="align-middle text-center">NIM</th>
                   <th class="align-middle text-center">Opsi</th>
                 </tr>
               </thead>
               <tbody>
                 @foreach ($semua_mahasiswa as $index => $mahasiswa)
                  <tr>
                    <td class="align-middle text-center">{{ $index+1 }}</td>
                    <td class="align-middle">{{ $mahasiswa->nama }}</td>
                    <td class="align-middle text-center">{{ $mahasiswa->nomor_induk }}</td>
                    <td class="align-middle text-center">
                      <button type="button" class="btn btn-sm btn-info mb-2" data-toggle="modal" data-target="#edit-akun-mahasiswa" onclick="editAkunMahasiswa('{{ $mahasiswa->nama }}', '{{ $mahasiswa->nomor_induk }}')"><i class="fa fa-edit mr-2"></i>Edit</button>
                      <button type="button" class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#hapus-akun" onclick="hapusAkun('{{ $mahasiswa->category }}', '{{ $mahasiswa->nama }}', '{{ $mahasiswa->nomor_induk }}')"><i class="fa fa-trash mr-2"></i>Hapus</button>
                    </td>
                  </tr>
                 @endforeach
               </tbody>
             </table>
          </div>
          <div class="tab-pane fade" id="dosen" role="tabpanel" aria-labelledby="dosen-tab">
             <table class="table table-bordered table-striped" id="daftar-dosen">
               <thead>
                 <tr class="bg-info">
                   <th class="align-middle text-center">No</th>
                   <th>Nama</th>
                   <th class="align-middle text-center">NIP</th>
                   <th class="align-middle text-center">Email</th>
                   <th class="align-middle text-center">Opsi</th>
                 </tr>
               </thead>
               <tbody>
                 @foreach ($semua_dosen as $index => $dosen)
                  <tr>
                    <td class="align-middle text-center">{{ $index+1 }}</td>
                    <td class="align-middle">{{ $dosen->nama }}</td>
                    <td class="align-middle text-center">{{ $dosen->nomor_induk }}</td>
                    <td class="align-middle text-center">{!! $dosen->email != null ? $dosen->email : '<i>Tidak ada</i>' !!}</td>
                    <td class="align-middle text-center">
                      <button type="button" class="btn btn-sm btn-info mb-2" data-toggle="modal" data-target="#edit-akun-dosen" onclick="editAkunDosen('{{ $dosen->nama }}', '{{ $dosen->nomor_induk }}', '{{ $dosen->email != null ? $dosen->email : 'empty' }}')"><i class="fa fa-edit mr-2"></i>Edit</button>
                      <button type="button" class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#hapus-akun" onclick="hapusAkun('{{ $dosen->category }}', '{{ $dosen->nama }}', '{{ $dosen->nomor_induk }}')"><i class="fa fa-trash mr-2"></i>Hapus</button>
                    </td>
                  </tr>
                 @endforeach
               </tbody>
             </table>
          </div>
          {{--<div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="role-tab">
             <table class="table table-bordered table-striped">
               <tr>
                 <td class="align-middle text-bold bg-info" style="width: 30%;">
                   Koordinator Prodi
                 </td>
                 <form action="{{ route('main.admin.akun.ubah-role', ['role' => 'koor-prodi']) }}" method="post">
                   <td class="align-middle">
                    @method('put')
                    @csrf
                    <select name="value" class="form-control">
                      <option value="empty">Pilih Koordinator Prodi</option>
                      @foreach ($semua_dosen as $dosen)
                         <option value="{{ $dosen->nomor_induk }}"{!! $dosen->userRole->where('role_id', 2)->count() > 0 ? ' selected="selected"' : '' !!}>{{ $dosen->nama }}</option>
                      @endforeach
                    </select>
                   </td>
                   <td class="align-middle text-center">
                     <button type="submit" class="btn btn-sm btn-secondary">Perbarui</button>
                   </td>
                 </form>
               </tr>
               <tr>
                 <td class="align-middle text-bold bg-info">
                   Koordinator TGA
                 </td>
                 <form action="{{ route('main.admin.akun.ubah-role', ['role' => 'koor-tga']) }}" method="post">
                   <td class="align-middle">
                    @method('put')
                    @csrf
                     <select name="value" class="form-control">
                      <option value="empty">Pilih Koordinator TGA</option>
                      @foreach ($semua_dosen as $dosen)
                         <option value="{{ $dosen->nomor_induk }}"{!! $dosen->userRole->where('role_id', 5)->count() > 0 ? ' selected="selected"' : '' !!}>{{ $dosen->nama }}</option>
                      @endforeach
                    </select>
                   </td>
                   <td class="align-middle text-center">
                     <button type="submit" class="btn btn-sm btn-secondary">Perbarui</button>
                   </td>
                </form>
               </tr>
               <tr>
                 <td colspan="3" class="align-middle text-bold bg-info">
                   Ketua Kelompok Keahlian
                 </td>
               </tr>
               <tr>
                 <td class="align-middle bg-warning pl-4">
                   Bidang Manajemen Rekayasa Konstruksi (MRK)
                 </td>
                 <form action="{{ route('main.admin.akun.ubah-role', ['role' => 'ketua-kel-keahlian', 'bidang' => 1]) }}" method="post">
                   <td class="align-middle">
                    @method('put')
                    @csrf
                     <select name="value" class="form-control">
                      <option value="empty">Pilih Ketua Kelompok Keahlian</option>
                      @foreach ($semua_dosen as $dosen)
                        @if ($dosen->bidang_id == 1)
                          <option value="{{ $dosen->nomor_induk }}" selected="selected">{{ $dosen->nama }}</option>
                        @else
                          <option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
                        @endif
                      @endforeach
                    </select>
                   </td>
                   <td class="align-middle text-center">
                     <button type="submit" class="btn btn-sm btn-secondary">Perbarui</button>
                   </td>
                </form>
               </tr>
               <tr>
                 <td class="align-middle bg-warning pl-4">
                   Bidang Hidroteknik
                 </td>
                 <form action="{{ route('main.admin.akun.ubah-role', ['role' => 'ketua-kel-keahlian', 'bidang' => 2]) }}" method="post">
                   <td class="align-middle">
                    @method('put')
                    @csrf
                    <select name="value" class="form-control">
                      <option value="empty">Pilih Ketua Kelompok Keahlian</option>
                      @foreach ($semua_dosen as $dosen)
                        @if ($dosen->bidang_id == 2)
                          <option value="{{ $dosen->nomor_induk }}" selected="selected">{{ $dosen->nama }}</option>
                        @else
                          <option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
                        @endif
                      @endforeach
                    </select>
                   </td>
                   <td class="align-middle text-center">
                     <button type="submit" class="btn btn-sm btn-secondary">Perbarui</button>
                   </td>
                  </form>
               </tr>
               <tr>
                 <td class="align-middle bg-warning pl-4">
                   Bidang Transportasi
                 </td>
                 <form action="{{ route('main.admin.akun.ubah-role', ['role' => 'ketua-kel-keahlian', 'bidang' => 3]) }}" method="post">
                   <td class="align-middle">
                    @method('put')
                    @csrf
                     <select name="value" class="form-control">
                      <option value="empty">Pilih Ketua Kelompok Keahlian</option>
                      @foreach ($semua_dosen as $dosen)
                        @if ($dosen->bidang_id == 3)
                          <option value="{{ $dosen->nomor_induk }}" selected="selected">{{ $dosen->nama }}</option>
                        @else
                          <option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
                        @endif
                      @endforeach
                    </select>
                   </td>
                   <td class="align-middle text-center">
                     <button type="submit" class="btn btn-sm btn-secondary">Perbarui</button>
                   </td>
                  </form>
               </tr>
               <tr>
                 <td class="align-middle bg-warning pl-4">
                   Bidang Geoteknik
                 </td>
                 <form action="{{ route('main.admin.akun.ubah-role', ['role' => 'ketua-kel-keahlian', 'bidang' => 4]) }}" method="post">
                   <td class="align-middle">
                    @method('put')
                    @csrf
                     <select name="value" class="form-control">
                      <option value="empty">Pilih Ketua Kelompok Keahlian</option>
                      @foreach ($semua_dosen as $dosen)
                        @if ($dosen->bidang_id == 4)
                          <option value="{{ $dosen->nomor_induk }}" selected="selected">{{ $dosen->nama }}</option>
                        @else
                          <option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
                        @endif
                      @endforeach
                    </select>
                   </td>
                   <td class="align-middle text-center">
                     <button type="submit" class="btn btn-sm btn-secondary">Perbarui</button>
                   </td>
                  </form>
               </tr>
               <tr>
                 <td class="align-middle bg-warning pl-4">
                   Bidang Struktur
                 </td>
                 <form action="{{ route('main.admin.akun.ubah-role', ['role' => 'ketua-kel-keahlian', 'bidang' => 5]) }}" method="post">
                   <td class="align-middle">
                    @method('put')
                    @csrf
                     <select name="value" class="form-control">
                      <option value="empty">Pilih Ketua Kelompok Keahlian</option>
                      @foreach ($semua_dosen as $dosen)
                        @if ($dosen->bidang_id == 5)
                          <option value="{{ $dosen->nomor_induk }}" selected="selected">{{ $dosen->nama }}</option>
                        @else
                          <option value="{{ $dosen->nomor_induk }}">{{ $dosen->nama }}</option>
                        @endif
                      @endforeach
                    </select>
                   </td>
                   <td class="align-middle text-center">
                     <button type="submit" class="btn btn-sm btn-secondary">Perbarui</button>
                   </td>
                  </form>
               </tr>
             </table>
          </div>--}}
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection