@extends('backend.layouts.app')
@section('content')

<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('users.index')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Edit User</h2>
</section>
<div class="property-wrapper container mt-5 channel-wrapper">
    <form class="forms-sample" action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="col-sm-12 mt-3">
        <label>Name :</label>
        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $user->name }}">
        @error('name')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror 
      </div>
      <div class="col-sm-12 mt-3">
        <label>Change Password:</label>                            
        <input type="password" class="form-control" name="password" placeholder="Enter Password" >
        @error('password')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="col-sm-12 mt-3">
        <label>Email:</label>                            
        <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ $user->email }}" disabled>
        @error('email')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="col-sm-12 mt-3">
        <label>Mobile No.:</label>                            
        <input type="text" class="form-control" name="phone" placeholder="Enter Mobile No." value="{{ $user->phone }}">
        @error('phone')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="col-sm-12 mt-3 ">
        <label>User Type :</label>
        <select class="form-control" name="user_type">
          <option value="0" @if($user->type == 0) selected @endif>Manager</option>
          <option value="2" @if($user->type == 2) selected @endif>Supervisor</option>
          <option value="1" @if($user->type == 1) selected @endif>Admin</option>
        </select>
        @error('user_type')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col-sm-12 mt-3 ">
        <label>Assign Site :</label>
        <select class="form-control" name="site">
          @foreach ($sites as $site)      
              <option value="{{$site->id}}" @if($user->site_id == $site->id) selected @endif>{{$site->name}}</option>
          @endforeach
        </select>
        @error('site')
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div> 
      <div class="modal-footer mt-5">
        <button type="submit" class="btn btn-default btn-save">Save</button>
      </div> 
    </form>
</div>

@endsection

@section('script')
@endsection