@extends('auth.layouts.app')

@section('content')

<div class="site-login mt-0 site-wrap">
  <!-- login form -->
  <section class="login-block content-wrapper mt-0 p-0">
      <div class="container pr-0">
          <div class="row">
              <div class="col-md-12 col-sm-12 col-lg-4 login-sec ">
                  <h2 class="text-center">Login Now</h2>
                    <form class="login-form pt-4" method="POST" action="{{ route('login') }}">
                      @csrf
                      <div class="form-group position-relative">
                          <div class="group mb-0">
                              <input type="email" name="email" class="form-control form-control-lg border-left-0  @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Email">
                              <span class="highlight"></span>
                              <span class="bar"></span>
                              <label class="form-label">Email</label>
                              <i class="fa fa-envelope" aria-hidden="true"></i>
                          </div>
                          @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>
                      <div class="form-group position-relative">
                          <div class="group mb-0">
                              <input type="password" name="password" class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                              <span class="highlight"></span>
                              <span class="bar"></span>
                              <label class="form-label">Password</label>
                              <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                          </div>
                          @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror 
                      </div>
                      {{-- <a href="forgot_password.html" class="mt-1">Forgot Password</a> --}}
                      <div class="form-check">
                          <button type="submit" class="btn-login">Login</button>
                      </div>
                  </form>
              </div>
              <div class="col-md-12 col-sm-12 col-lg-8 banner-sec" style="background: url({{asset('backend/images/mainlogo.png')}});background-size: cover;">
              </div>
          </div>
      </div>
  </section>
  <!-- end -->
</div>

@endsection
