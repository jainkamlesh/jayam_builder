@extends('backend.layouts.app')
@section('content')
<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('home')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Requirement List</h2>
</section>
<section class="property-wrapper mt-4 user-wrapper">
    <form action="" method="get">
        <div class="d-flex justify-content-between align-items-center container-fluid mt-4 pro-add-nnb">
          <div class="d-flex position-relative">
            <input type="text" name="search" placeholder="Search Site" class="prop-inp radius-0" value="{{$sort_search}}">
            <i class="fa fa-search srch-icn-vg" aria-hidden="true"></i>
             <button class="btn-add radius-0" type="submit"><i class="fa fa-search"></i></button>
          </div>
          @if(Auth::user()->type == "manager")
          <a href="{{route('requirements.create')}}"><button class="btn-add add-btn" type="button"><i class="fa fa-plus" aria-hidden="true"></i>Add Requirement</button></a>
          @endif
        </div>
    </form>
    <div class="container-fluid">
      @if($requirements->count() > 0)  
        <table class="mt-4 pro-table-pg table-hover wrapper">
            <thead>
            <tr class="ft-tr">
                <th>ID</th>
                <th>Manager Name</th>
                <th>Inventory</th>
                <th>Quantity</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($requirements as $requirement)             
                <tr>
                    <td scope="row" data-label="ID">{{$requirement->id}}</td>
                    <td data-label="Manager Name">{{$requirement->user->name ?? "N/A"}}</td>
                    <td data-label="Inventory">{{$requirement->inventory->name ?? $requirement->inventory_name}}</td>
                    <td data-label="quantity">{{$requirement->quantity ?? "N/A"}}</td>
                    <td data-label="comment">{{$requirement->comment ?? "N/A"}}</td>
                    @if(Auth::user()->type == "admin")
                    <td data-label="Status">
                      <select class="form-control" name="status" onchange="change_status(this)">
                        <option value="{{route('requirements.status',[$requirement->id,'pending'])}}" @if($requirement->status == "pending") selected @endif>Pending</option>
                        <option value="{{route('requirements.status',[$requirement->id,'accepted'])}}" @if($requirement->status == "accepted") selected @endif>Accept</option>
                        <option value="{{route('requirements.status',[$requirement->id,'rejected'])}}" @if($requirement->status == "rejected") selected @endif>Reject</option>
                       </select>
                    </td>
                    @else
                    <td data-label="Status">
                        @if($requirement->status == "pending")
                        <span class="badge bg-warning">Pending</span>
                        @elseif($requirement->status == "accepted")
                        <span class="badge bg-success">Accepted</span>
                        @else
                        <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    @endif
                    <td data-label="Action" class="action-list">
                        <div class="d-inline-flex">
                            <a href="{{route('requirements.edit',$requirement->id)}}" class="icon edit edit-icon">
                                <div class="tooltip">Edit</div>
                                <i class="fa fa-pencil pnsl"></i>
                                </a>
                                <a class="icon edit" onclick="deleterequirements('{{route('requirements.destory',$requirement->id)}}')">
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
    @if($requirements->count() > 0 && $requirements->count() > 10)
        <div class="pagination-btn text-center mt-5">
            <a class="btn-add add-btn" href="{{ $requirements->previousPageUrl() }}">Previous</a>
            <a class="btn-add add-btn" href="{{ $requirements->nextPageUrl() }}">Next</a>
        </div>
    @endif
    <div class="delete-modal-main">
      <div class="modal fade" id="deleterequirements">
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
    function deleterequirements(url){
      $("#delete-id").attr("href", url);
      $('#deleterequirements').modal('show');
    }

    function change_status(e){
      var url =e.value;
      window.location.href = url;
    }
  </script>
@endsection
@section('script')

@endsection