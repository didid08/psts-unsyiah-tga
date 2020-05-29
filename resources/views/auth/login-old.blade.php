<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title }} | Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('assets.top')
    <style>
        #guest-login {
            position: fixed;
            top: 0;
            right: 0;
            padding: 12px 12px 16px 28px;
            -webkit-border-radius: 0 0 0 100em;
            -moz-border-radius: 0 0 0 100em;
            -o-border-radius: 0 0 0 100em;
            border-radius: 0 0 0 100em;
            display: block;
            cursor: pointer;
            font-size: 1.8em;
        }
    </style>
</head>

<body>
    <div id="preloader"></div>
    <div class="login-page-wrap">
        <div class="login-page-content">
            <a href="{{ route('auth.login', ['opsi' => 'tamu']) }}" id="guest-login" class="bg-light text-dark" data-toggle="tooltip" data-placement="left" title="Login sebagai tamu"><i class="far fa-user-circle"></i></a>
            <div class="login-box">
                <form role="form" method="POST" action="{{ route('auth.login.process') }}" class="login-form">
                    @csrf

                    <div class="form-group">
                        <label for="form-identity">NIP/NIM/Username</label>
                        <input type="text" name="identity" id="form-identity" placeholder="Masukkan NIP/NIM/Username" class="form-username form-control" required autofocus>
                        <i class="far fa-user"></i>
                    </div>
                    <div class="form-group">
                        <label for="form-password">Password</label>
                        <input type="password" name="password" id="form-password" placeholder="Masukkan Password" class="form-password form-control" required>
                        <i class="fas fa-lock"></i>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit" class="login-btn">Login</button>
                    </div>
                         
                    @if (session('error'))
                        <div class="ui-alart-box">
                            <div class="icon-color-alart">
                                <div class="alert icon-alart bg-pink2" role="alert">
                                    <i class="fas fa-times bg-pink3"></i>
                                    {{ session('error') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('warning'))
                        <div class="ui-alart-box">
                            <div class="icon-color-alart">
                                <div class="alert icon-alart bg-yellow2" role="alert">
                                    <i class="fas fa-exclamation-triangle bg-yellow3"></i>
                                    {{ session('warning') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="ui-alart-box">
                            <div class="icon-color-alart">
                                <div class="alert icon-alart bg-pink2" role="alert">
                                    <i class="fas fa-times bg-pink3"></i>
                                    Masukkan NIP/NIM/Username beserta Password
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @include('assets.bottom')
</body>
</html>