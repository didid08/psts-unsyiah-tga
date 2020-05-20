<!-- jquery-->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<!-- Plugins js -->
<script src="{{ asset('js/plugins.js') }}"></script>
<!-- Popper js -->
<script src="{{ asset('js/popper.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Scroll Up Js -->
<script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
<!-- jquery Datatables JS -->
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<!-- Custom Js -->
<script src="{{ asset('js/main.js') }}"></script>

<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>

@if (session('auth') && session('auth')[2] == 7)
<script>
    function setLastSection(sectionname) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'PUT',
            url: '/home/7/set-last-section',
            data: {
                lastsection: sectionname,
            },
            success: function(result){
                console.log(result)
            }
        })
    }

</script>
@endif

@if (session('auth') && in_array(session('auth')[2], array(1,2,3,4,5)))
    <script>
        function addEmbedSrc(src, embed_id) {
            $(embed_id).attr("src", src);
            console.log("Document Loaded");
        }

        function removeEmbedSrc(embed_id) {
            $(embed_id).removeAttr("src");
            console.log("Document Closed");
        }
    </script>
@endif

@if (session('auth') && session('auth')[2] == 1)
    <script>
        $(document).ready( function () {
            $('#daftar-akun').DataTable();
            $('.datatables').DataTable();
        });

        function toggleInput() {

            var role_id = $('#tambah-akun-role').val();

            if (role_id == '2') {
                $('#tambah-akun-nama-auto').show();
                $('#tambah-akun-nama-manual').hide();
                $('#tambah-akun-nim').hide();
                $('#tambah-akun-email').hide();
                $('#tambah-akun-no-hp').hide();
                $('#tambah-akun-nip').show();
                $('#tambah-akun-bidang').show();
            }else if (['3', '4', '5', '6'].includes(role_id)) {
                $('#tambah-akun-nama-auto').show();
                $('#tambah-akun-nama-manual').hide();
                $('#tambah-akun-nim').hide();
                $('#tambah-akun-email').hide();
                $('#tambah-akun-no-hp').hide();
                $('#tambah-akun-nip').show();
                $('#tambah-akun-bidang').hide();
            }else if (role_id == '7') {
                $('#tambah-akun-nama-auto').hide();
                $('#tambah-akun-nama-manual').show();
                $('#tambah-akun-nim').show();
                $('#tambah-akun-email').show();
                $('#tambah-akun-no-hp').show();
                $('#tambah-akun-nip').hide();
                $('#tambah-akun-bidang').show();
            }
        }
    </script>
@endif

@if (session('auth'))

    @if ($errors->any())
        <script src="{{ asset('js/require.js') }}"></script>
        @foreach ($errors->all() as $error)
            <script>
                requirejs(['https://cdn.jsdelivr.net/npm/sweetalert2@9'], function(Swal) {
                    Swal.fire({
                        title: '{{ str_replace([
                            'The ',
                            ' field is required.',
                            'username',
                            'password',
                            'nip',
                            'nim',
                            'nama-auto',
                            'nama-manual',
                            'bidang',
                            'email',
                            'no-hp'
                        ],
                        [
                            '',
                            ' tidak boleh kosong',
                            'Username',
                            'Password',
                            'NIP',
                            'NIM',
                            'Nama',
                            'Nama',
                            'Bidang',
                            'Email',
                            'Nomor HP'
                        ], $error) }}',
                        icon: 'error',
                        confirmButtonText: 'Kembali'
                    })
                })
            </script>
        @endforeach
    @endif

    @if (session('error'))
        <script src="{{ asset('js/require.js') }}"></script>
        <script>
            requirejs(['https://cdn.jsdelivr.net/npm/sweetalert2@9'], function(Swal) {
                Swal.fire({
                  title: '{{ session('error') }}',
                  icon: 'error',
                  confirmButtonText: 'Kembali'
                })
            })
        </script>
    @endif
    @if (session('error-2'))
        <script src="{{ asset('js/require.js') }}"></script>
        <script>
            requirejs(['https://cdn.jsdelivr.net/npm/sweetalert2@9'], function(Swal) {
                Swal.fire({
                  title: '{{ explode('-', session('error-2'))[0] }}',
                  text: '{{ explode('-', session('error-2'))[1] }}',
                  icon: 'error',
                  confirmButtonText: 'Kembali'
                })
            })
        </script>
    @endif
    @if (session('success'))
        <script src="{{ asset('js/require.js') }}"></script>
        <script>
            requirejs(['https://cdn.jsdelivr.net/npm/sweetalert2@9'], function(Swal) {
                Swal.fire({
                  title: '{{ session('success') }}',
                  icon: 'success',
                  confirmButtonText: 'OK'
                })
            })
        </script>
    @endif
@endif