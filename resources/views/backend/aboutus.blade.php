@extends('auth.layouts.app')

@section('content')

<div class="site-login mt-0 site-wrap">
  <!-- login form -->
  <section class="login-block content-wrapper mt-0 p-0">
    <div class="site-navbar">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between">
            <div class="logo">
              <div class="site-logo">
                <a href="{{route('home')}}" class="js-logo-clone">
                    <img src="{{asset('backend/images/logo.png')}}" alt="">
                </a>
              </div>
            </div>
            <div class="d-flex">
              <div class="main-nav d-none d-lg-block">
                <nav class="site-navigation text-right text-md-center" role="navigation">
                  <ul class="site-menu js-clone-nav d-none d-lg-block">
                    <li id="close-btn"><i class="fa fa-times js-logo-clone js-menu-toggle close-icn" aria-hidden="true"></i></li>
                    <li><a href="{{route('home')}}">Login</a></li>
                    <li class="active"><a href="{{route('aboutus')}}">About us</a></li>
                  </ul>
                </nav>
              </div>
              <div class="icons d-flex align-items-center user-dropdown">
                <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><img src="{{asset('backend/images/menu-icn.svg')}}" width="20"></a>
                <div class="dropdown" style="margin-left: 20px;">
                  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('backend/images/profile.svg')}}" width="30">
                  </a>
                </div>
              </div>
            </div>  
          </div>
        </div>
      </div>
      <div class="container pr-0">
          <div class="row mt-5">
              <div class="col-md-12 col-sm-12 col-lg-12 login-sec " style="height: auto;">
                  
                    <h2 class="text-center">About Us</h2>
                    <br>
                    <h4><strong>Company Details</strong></h4>
                    <hr>
                    <h5><strong>Company Name :</strong> Jayam Builcon</h5>
                    <h5><strong>Company :</strong> Government approve gujarat </h5>
                    <h5><strong>Company work :</strong> Government project</h5>
                    <h5><strong>Company :</strong> 'A' CLASS </h5>
                    <h5><strong>Company :</strong> Building category 2</h5>
                    <h5><strong>Company PAN :</strong> AAUFJ0247Q</h5>
                    <h5><strong>Company GST NO :</strong> 24AAUFJ0247Q1ZR</h5>
                    <h5><strong>Company PF.NO:</strong> SRBRH3176718000 </h5>
                    <h5><strong>Company Partnership name:</strong>  (1) Piyush B Patoliya , (2) Bharati P Patoliya</h5>
                    <h5><strong>Company Address :</strong> 71, Shreeji pravesh nr.narmada college Bharuch-392011 </h5>
                    <h5><strong>Company Mobile :</strong> <a href="tel:+919909944007">+91 99099 44007</a>, <a href="tel:+919909844007">+91 99098 44007</a></h5>
                    <h5><strong>Company Mail:</strong> <a href="mailto:jayambuilcon@gmail.com">jayambuilcon@gmail.com</a></h5>
                    <br>
                    <h4><strong>Company Projects (Building Work)</strong></h4>
                    <h5>(1) R&b,Rajkot</h5>
                    <h5>(2) Gujarat Pavitra Yatra Dham Vikas Board</h5>
                    <h5>(3) Irrigation</h5>
                    <h5>(4) Suda Surat Road Work</h5>
                    <h5>(5) Project Implementation Unithealth Department Hospital </h5>
                    <h5><strong>Ongoing Building Projects : </strong>Surat, Valsad, Navsari, Bharuch,
                      Godhara, Mahisagar, Dahod</h5>
              </div>
          </div>
      </div>
  </section>
  <!-- end -->
</div>

@endsection
