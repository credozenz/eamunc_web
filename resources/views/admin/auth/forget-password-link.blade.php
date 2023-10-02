<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.A.MUNC - Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="{{asset('css/admin/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/login.css')}}" rel="stylesheet">
</head>
<body>
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
      <table class="head-wrap w320 full-width-gmail-android mt-4" cellpadding="0" cellspacing="0" >
      <tr>
       
      </tr>
      <tr class="header-background">
        <td class="header container" align="center">
          <div class="content">
            <span class="brand">
            <a href="{{ url('/') }}">
              <img src="{{ asset('assets/web/img/logo.png') }}" alt="E.Ahamed Model United Nations Conference" style="width: 8%;height: auto;">
             </a>
            </span>
          </div>
        </td>
      </tr>
    </table>
          <div class="col-md-8">
            @if($token_valid==true &&  $email !='')
              <div class="card">
                  <div class="card-header" style="text-align: center;">
                   <h6>Set Password</h6>
                 </div>
                  <div class="card-body">
                  @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                      <form action="{{ route('ResetPasswordPost') }}" method="POST">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">
  
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" readonly class="form-control" value="{{ $email ?? ''}}" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" required autofocus>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
                                  @if ($errors->has('password_confirmation'))
                                      <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Submit
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
              @else
              <div class="card">
                  <div class="card-header" style="text-align: center;">
                    <div class="alert alert-success" role="alert">
                      <h6>Token expired or invalid.</h6>
                      <p>Please contact our administrator for further assistance.</p>
                    </div>
                 </div>
              </div>
              @endif
          </div>
      </div>
  </div>
</main>
</body>

<script src="{{asset('js/admin/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/admin/apexcharts.js')}}"></script>
<script src="{{asset('js/admin/pages/dashboard.js')}}"></script>
<script src="{{asset('js/admin/sidebar.js')}}"></script>
<script src="{{asset('js/admin/admin.js')}}"></script>

</html>