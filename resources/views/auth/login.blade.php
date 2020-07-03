<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $title }} | Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>{{ explode(' ', $title)[0] }}</b> {{ explode(' ', $title)[1] }}</a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Masuk untuk melanjutkan</p>

      <form action="{{ route('auth.login.process') }}" method="post">
        @csrf

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="NIP/NIM/Username" name="identity">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Ingat Saya
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
        </div>
      </form>

      <div class="text-center mb-3">
        <p>- Atau -</p>
        <a href="{{ route('auth.login', ['opsi' => 'tamu']) }}" class="btn btn-block btn-outline-primary">
          <i class="fas fa-user mr-2"></i> Masuk Sebagai Tamu
        </a>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@if ( session('error') != null | session('warning') != null | $errors->any() )
  <!-- Toastr -->
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      @if (session('error'))
        toastr.error('{{ session('error') }}')      
      @endif
      @if (session('warning'))
        toastr.warning('{{ session('warning') }}')
      @endif
      @if (session('success'))
        toastr.success('{{ session('success') }}')
      @endif
      @if ($errors->any())
        var timeout = 0
        @foreach ($errors->all() as $error)
          setTimeout(function () {
            toastr.error('{{$error}}')
          }, timeout)
          timeout = timeout+300
        @endforeach
      @endif
    });
  </script>
@endif
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

</body>
</html>
