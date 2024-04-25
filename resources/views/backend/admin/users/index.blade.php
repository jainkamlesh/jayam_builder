@extends('backend.layouts.app')
@section('content')
<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('home')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">User List</h2>
</section>
<section class="property-wrapper mt-4 user-wrapper">
    <form action="" method="get">
        <div class="d-flex justify-content-between align-items-center container-fluid mt-4 pro-add-nnb">
          <div class="d-flex position-relative">
            <input type="text" name="search" placeholder="Search User" class="prop-inp radius-0" value="{{$sort_search}}">
            <i class="fa fa-search srch-icn-vg" aria-hidden="true"></i>
             <button class="btn-add radius-0" type="submit"><i class="fa fa-search"></i></button>
          </div>
          <a href="{{route('users.create')}}"><button class="btn-add add-btn" type="button"><i class="fa fa-plus" aria-hidden="true"></i>Add User</button></a>
        </div>
    </form>
    <div class="container-fluid">
      @if($users->count() > 0)  
        <table class="mt-4 pro-table-pg table-hover wrapper">
            <thead>
            <tr class="ft-tr">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Site</th>
                <th>User Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)             
                <tr>
                    <td scope="row" data-label="ID">{{$user->id}}</td>
                    <td data-label="name">{{$user->name}}</td>
                    <td data-label="email">{{$user->email}}</td>
                    <td data-label="mobile">{{$user->phone ?? "N/A"}}</td>
                    <td data-label="user_type">{{$user->site->name ?? "N/A"}}</td>
                    <td data-label="user_type">{{ucfirst($user->type)}}</td>
                    <td data-label="Action" class="action-list">
                        <div class="d-inline-flex">
                            <a href="{{route('users.edit',$user->id)}}" class="icon edit edit-icon">
                                <div class="tooltip">Edit</div>
                                <i class="fa fa-pencil pnsl"></i>
                                </a>
                                <a class="icon edit" onclick="deleteuser('{{route('users.destory',$user->id)}}')">
                                    <div class="tooltip">Delete</div>
                                    <i class="fa fa-trash-o btn-danger delete-icn"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            
            </tbody>
        </table>
      @else
        <div class="text-center p-4">
            <p class="mb-0">No Data To Show</p>
        </div>
      @endif
    </div>
    @if($users->count() > 0 && $users->count() > 10)
        <div class="pagination-btn text-center mt-5">
            <a class="btn-add add-btn" href="{{ $users->previousPageUrl() }}">Previous</a>
            <a class="btn-add add-btn" href="{{ $users->nextPageUrl() }}">Next</a>
        </div>
    @endif
    <div class="delete-modal-main">
      <div class="modal fade" id="deleteuser">
        <div class="modal-dialog modal-dialog-centered promocode_main" role="document">
          <div class="modal-content">
            <div class="modal-header mt-2">
              <h5 class="modal-title">Delete</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="coupon">
                <h5 class="delete-warning">Are you sure want to Delete!</h5>
                <form action="#" class="mt-4 modal-btn">
                  <a type="button" class="btn btn-default btn-success" id="delete-id">Yes</a>
                  <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">No</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    function deleteuser(url){
      $("#delete-id").attr("href", url);
      $('#deleteuser').modal('show');
    }
  </script>
@endsection
@section('script')

@endsection