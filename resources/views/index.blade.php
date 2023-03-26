<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,300&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body style="background-color: #3766BC;">
    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-lg-6" style="padding: 0 30px;">
                <img src="{{ asset('assets/img/img-1.png') }}" class="img-fluid" />
            </div>
            <div class="col-lg-6">
                <div style="background-color: white; border-radius: 6px; padding: 40px; 15px;" align="center">
                    <h4 style="color: #3766BC; font-weight: 500; margin-bottom: 25px;">Selamat datang di OnDoct!</h4>
                    <div class="form-group" style="width: 80%;">
                        <form action="{{ route('auth') }}" method="POST">
                            @csrf

                            <div class="input-group mb-2">
                                <div class="input-group-prepend"> 
                                    <div class="input-group-text i-mod-pre">
                                        <i class="fa fa-fw fa-envelope" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <input type="email" name="email" id="email" class="form-control i-mod-in" placeholder="Email anda" aria-describedby="helpId">
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text i-mod-pre">
                                        <i class="fa fa-fw fa-lock" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <input type="password" name="password" id="password" class="form-control i-mod-in" placeholder="Password anda" aria-describedby="helpId">
                            </div>
                            <input type="submit" class="btn text-white" style="background-color: #3766BC; width: 100%; margin-top: 15px;" value="Masuk">
                        </form>
                    </div>
                    <div style="width: 80%" align="right">
                        {{-- <p style="color: #444; font-weight: 500; font-size: 14px; margin-bottom: 0;"><a>Lupa dengan password anda?</a></p> --}}
                        <p style="color: #3443a3; font-weight: 500; font-size: 17px; margin-top: 8px;"><a href="{{ route('register') }}">Belum memiliki akun? Daftar disini.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>