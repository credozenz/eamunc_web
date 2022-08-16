<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.A.MUNC - App Dashboard</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="{{asset('css/admin/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/login.css')}}" rel="stylesheet">
</head>

<body>
    <div id="auth">    
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                <div class="auth-logo">
                  <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo" style="font-size: 1.5rem;padding:5px 5px 5px;">
                            <img src="http://eamunc.credozen.com/assets/admin/img/logo.png" style="width: 4rem;height: 4rem;" alt="E.A.MUNC" srcset="">&nbsp;&nbsp;E.A.MUNC
                        </div>
                    </div>
                  </div>
                </div>
                    
                    <h1 class="auth-title">Log in.</h1>

                    @if(Session::has('success'))
                    <div class="alert alert-secondary"><i class="bi bi-star"></i>{{ Session::get('success') }}</div>
                    @elseif(Session::has('error'))
                    <div class="alert alert-danger"><i class="bi bi-file-excel"></i> {{ Session::get('error') }}</div>
                    @endif

                    <form method="post" action="{{ url('app/login') }}">
                                @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl"  name="email" placeholder="Enter email" value="{{ old('email') }}">
                            @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" id="exampleInputPassword1"  name="password" placeholder="Password" >
                            @error('password')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <a class="btn btn-link" href="{{ route('ForgetPasswordGet') }}">
                      {{ __('Forgot Your Password?') }}
                    </a>
                </div>
                <div class="footer clearfix mb-0 text-muted">
                            <div class="float-start">   
                            </div>
                            <div class="float-end">
                            <p>2022 &copy; E.A.MUNC</p>
                            </div>
                        </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img src="{{ asset('assets/admin/img/hero.jpg') }}" alt="Logo">
                
                       
                </div>
            </div>
        </div>   
    </div>
</body>

<script src="{{asset('js/admin/bootstrap.bundle.min.js')}}"></script>

</html>