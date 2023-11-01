<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        {{-- font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        {{-- CSS | Style --}}
        <link rel="stylesheet" href={{asset('css/style.css')}} />

        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="container__left">
                <div class="content">
                    <div class="header">
                        <span class="back__btn">
                            <i class="ri-arrow-left-line"></i>
                        </span>
                        <span class="register"></span>
                    </div>
                    <div class="form__content">
                        <h3 class="form__title">Selamat Datang</h3>
                        <p class="form__subtitle">
                            Silahkan masukan email dan password untuk masuk dengan akun anda.
                        </p>
                        <form action="{{url('login')}}" method="POST">
                            @csrf
                            <label for="email">Email</label>
                            <div class="email-wrap">
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Email"
                                    style="margin-top: 8px;"
                                    @error('email')
                                        is-invalid
                                    @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                <button type="button" id="clear-email" onclick="celarEmail();">
                                    <img src="{{asset('svg/icon-clear.svg')}}" alt="" id="icon_celar">
                                </button>
                                @if($errors->has('username'))
                                    <span class="error">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <label for="password">Password</label>
                            <div class="passwd-wrap">
                                <input
                                    type="password"
                                    placeholder="Password"
                                    name="password"
                                    id="password"
                                    style="margin-top: 8px;"
                                    @error('password')
                                        is-invalid
                                    @enderror"
                                    name="password" required autocomplete="current-password"/>
                                <button type="button" id="show-passwd">
                                    <img src="{{asset('svg/icon-pass-hidden.svg')}}" alt="" id="open_passwd">
                                </button>
                                @if($errors->has('username'))
                                    <span class="error">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <p class="forgot__password">Lupa Password?</p>
                            <button class="submit__btn" type="submit">Masuk</button>
                        </form>
                        <span class="bottom__line"></span>
                    </div>
                </div>
            </div>
            <div class="container__right">
                <div class="image">
                    <h3>Kelompok Mutiara</h3>
                    <p>
                        Program Bantu Perkiraan Hasil panen tanaman Jagung
                    </p>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="{{asset('js/main.js')}}"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        @if (Session::has('error'))
            toastr.success('{{ Session::get('error') }}')
        @endif
    </script>
</html>
