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
                @if(Auth::user()->type == "admin") 	
                <li><a href="{{route('users.index')}}">Users</a></li>
                <li><a href="{{route('sites.index')}}">Sites</a></li></li>
                <li><a href="{{route('inventories.index')}}">Inventories</a></li></li> 
                <li><a href="{{route('requirements.index')}}">Requirements</a></li>
                <li><a href="{{route('bills.index')}}">Bills</a></li>
                <li><a href="{{route('accounting.index')}}">Accounting</a></li>
                <li><a href="{{route('dealers.index')}}">Dealers</a></li>
                <li><a href="{{route('accountingtwo.index')}}">Accounting Two</a></li>
                <li><a href="{{route('materials.index')}}">Materials</a></li>
                @endif
                @if(Auth::user()->type == "manager")
                <li><a href="{{route('requirements.index')}}">Requirements</a></li>
                <li><a href="{{route('bills.index')}}">Bills</a></li>
                <li><a href="{{route('materials.index')}}">Materials</a></li>
                @endif
              </ul>
            </nav>
          </div>
          <div class="icons d-flex align-items-center user-dropdown">
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><img src="{{asset('backend/images/menu-icn.svg')}}" width="20"></a>
            <div class="dropdown" style="margin-left: 20px;">
              <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('backend/images/profile.svg')}}" width="30">
              </a>
              <div class="dropdown-menu p-0 view-drop-menu">
                <a class="dropdown-item" href="{{route('logout_user')}}">Logout</a>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>