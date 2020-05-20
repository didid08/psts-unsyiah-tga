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

@if (session('auth'))

    <script>
        $(document).ready(function () {
            $('#info-dosen').DataTable();
            $('#rekap-dosen').DataTable();
        });

        function addEmbedSrc(src, embed_id) {
            $(embed_id).attr("src", src);
            console.log("Document Loaded");
        }

        function removeEmbedSrc(embed_id) {
            $(embed_id).removeAttr("src");
            console.log("Document Closed");
        }
    </script>

    @if ($errors->any())
        <script src="{{ asset('js/require.js') }}"></script>
        @foreach ($errors->all() as $error)
            <script>
                requirejs(['https://cdn.jsdelivr.net/npm/sweetalert2@9'], function(Swal) {
                    Swal.fire({
                        title: '{{ $error }}',
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