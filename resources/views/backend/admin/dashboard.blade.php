@extends('backend.layouts.app')

@section('content')

<section class="dashboard-wrapper dash-wrapper">
	<div class="container-fluid">
	  <ul id="breadcrumb" class="p-0">
	  <li><a href="#"><span class="icon icon-beaker"> </span>Dhashboard</a></li>
		</ul>
	  </div>
  @if(Auth::user()->type == "admin") 	  
  <div class="container-fluid ">
	<div class="row">
	  <div class="col-md-2 col-6 mt-2">
		<a href="{{route('users.index')}}">
			<div class="order-box">
				<center>
					<div class="ord-icn">
						<i class="fa fa-users" aria-hidden="true"></i>
					</div>
					<div>
						<h5>Users</h5>
						<h6>{{\App\Models\User::count()}}</h6>
					</div>
				</center>
			</div>
	   </a>
	  </div>
	  <div class="col-md-2 col-6 mt-2">
		<a href="{{route('sites.index')}}">
			<div class="order-box orange-box">
				<center>
					<div class="ord-icn orange-icn">
					<i class="fa fa-building" aria-hidden="true"></i>
					</div>
					<div>
					<h5>Sites</h5>
					<h6>{{\App\Models\Site::count()}}</h6>
					</div>
				</center>
			</div>
		</a>
	  </div>
	  <div class="col-md-2 col-6 mt-2">
		<a href="{{route('inventories.index')}}">
			<div class="order-box green-box">
				<center>
					<div class="ord-icn green-icn">
						<i class="fa fa-truck"></i>
					</div>
					<div>
						<h5>Inventories</h5>
						<h6>{{\App\Models\Inventory::count()}}</h6>
					</div>
				</center>
			</div>
		</a>
	  </div>

	  <div class="col-md-2 col-6 mt-2">
		<a href="{{route('requirements.index')}}">
			<div class="order-box blue-box">
				<center>
					<div class="ord-icn blue-icn">
						<i class="fa fa-cubes"></i>
					</div>
					<div>
						<h5>Requirements</h5>
						<h6>{{\App\Models\Requirement::count()}}</h6>
					</div>
				</center>
			</div>
		</a>
	  </div>

	  <div class="col-md-2 col-6 mt-2">
		<a href="{{route('bills.index')}}">
			<div class="order-box ">
				<center>
					<div class="ord-icn ">
						<i class="fa fa-newspaper-o"></i>
					</div>
					<div>
						<h5>Bills</h5>
						<h6>{{\App\Models\Bill::count()}}</h6>
					</div>
				</center>
			</div>
		</a>
	  </div>

	  <div class="col-md-2 col-6 mt-2">
		<a href="{{route('accounting.index')}}">
			<div class="order-box orange-box">
				<center>
					<div class="ord-icn orange-icn">
					<i class="fa fa-calculator" aria-hidden="true"></i>
					</div>
					<div>
					<h5>Accounting</h5>
					<h6>{{\App\Models\Accounting::count()}}</h6>
					</div>
				</center>
			</div>
		</a>
	  </div>
	</div>
  </div>
  @endif
  
  @if(Auth::user()->type == "manager")
  <div class="container-fluid ">
	<div class="row">
	  <div class="col-md-2 col-6 mt-2">
		<a href="{{route('requirements.index')}}">
			<div class="order-box blue-box">
				<center>
					<div class="ord-icn blue-icn">
						<i class="fa fa-cubes"></i>
					</div>
					<div>
						<h5>Requirements</h5>
						<h6>{{\App\Models\Requirement::where('user_id',Auth::user()->id)->count()}}</h6>
					</div>
				</center>
			</div>
		</a>
	  </div>

	  <div class="col-md-2 col-6 mt-2">
		<a href="{{route('bills.index')}}">
			<div class="order-box ">
				<center>
					<div class="ord-icn ">
						<i class="fa fa-newspaper-o"></i>
					</div>
					<div>
						<h5>Bills</h5>
						<h6>{{\App\Models\Bill::where('user_id',Auth::user()->id)->count()}}</h6>
					</div>
				</center>
			</div>
		</a>
	  </div>
	</div>
  </div>
  @endif
</section>

@endsection

@section('script')
@endsection