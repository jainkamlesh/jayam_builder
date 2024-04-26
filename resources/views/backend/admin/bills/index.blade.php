@extends('backend.layouts.app')
@section('content')
<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('home')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Bill List</h2>
</section>
<section class="property-wrapper mt-4 user-wrapper">
    <form action="" method="get">
          @if(Auth::user()->type == "admin")
            <div class="d-flex align-items-center container-fluid mt-4 pro-add-nnb">
              <div class="d-flex position-relative">
                <input type="text" name="search" placeholder="Search Bill" class="prop-inp radius-0" value="{{$sort_search}}">
                <i class="fa fa-search srch-icn-vg" aria-hidden="true"></i>
              </div>  
              <div class="d-flex position-relative top-margin ">
                <select class="prop-inp radius-0" name="manager_id">
                  <option value="">All Manager</option>
                  @foreach (\App\Models\User::where('type',0)->get() as $manager)      
                      <option value="{{$manager->id}}" @if($manager_id == $manager->id) selected @endif>{{$manager->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="d-flex position-relative top-margin">
                <select class="prop-inp radius-0" name="site_id">
                  <option value="">All Site</option>
                  @foreach (\App\Models\Site::get() as $site)      
                      <option value="{{$site->id}}" @if($site_id == $site->id) selected @endif>{{$site->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="d-flex position-relative top-margin">
                <input type="date" name="startdate"  class="prop-inp radius-0" value="{{$startdate}}">
              </div>
              <div class="d-flex position-relative top-margin">
                <input type="date" name="enddate"  class="prop-inp radius-0" value="{{$enddate}}">
              </div>
              <div class="d-flex position-relative top-margin">
                <button class="btn-add radius-0 w-50" type="submit"><i class="fa fa-search"></i></button>
                <a class="btn btn-danger radius-0 w-50" href="{{route('bills.index')}}"><i class="fa fa-remove"></i></a>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center container-fluid pro-add-nnb bill-button">
              <div class="d-flex position-relative">
              </div>
              <a href="{{route('bills.create')}}"><button class="btn-add add-btn" type="button"><i class="fa fa-plus" aria-hidden="true"></i>Add Bill</button></a>
            </div>
          @else
            <div class="d-flex justify-content-between align-items-center container-fluid mt-4 pro-add-nnb">
              <div class="d-flex position-relative">
                <input type="text" name="search" placeholder="Search Bill" class="prop-inp radius-0" value="{{$sort_search}}">
                <i class="fa fa-search srch-icn-vg" aria-hidden="true"></i>
                <div class="d-flex position-relative mt-2">
                  <button class="btn-add radius-0" type="submit"><i class="fa fa-search"></i></button>
                </div>
              </div>
              <a href="{{route('bills.create')}}"><button class="btn-add add-btn" type="button"><i class="fa fa-plus" aria-hidden="true"></i>Add Bill</button></a>
            </div>  
          @endif        
    </form>
    <div class="container-fluid">
      @if(Auth::user()->type == "admin")
      <table class="mt-4 pro-table-pg table-hover wrapper">
        <tr >
            <td  data-label="Debit" class="bg-success text-white"><strong>Total Credit : <i class="fa fa-inr"></i> {{$total_credit}}</strong></td>
            <td  data-label="Credit" class="bg-danger text-white"><strong>Total Debit : <i class="fa fa-inr"></i> {{$total_debit}}</strong></td>
            <td  data-label="Grand Total" class="bg-primary text-white"><strong>Grand Total : <i class="fa fa-inr"></i> {{$total_grand}}</strong></td>
            <td colspan="5"></td>
        </tr>
      </table>  
      @endif
      @if($bills->count() > 0)  
        <table class="mt-4 pro-table-pg table-hover wrapper">
            <thead>
            <tr class="ft-tr">
                <th>ID</th>
                <th>Manager Name</th>
                <th>Site</th>
                <th>Inventory</th>
                <th>Amount</th>
                <th>Comment</th>
                <th>Bill</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($bills as $bill)             
                <tr>
                    <td scope="row" data-label="ID">{{$bill->id}}</td>
                    <td data-label="Manager Name">{{$bill->user->name ?? "N/A"}}</td>
                    <td data-label="Site">{{$bill->site->name ?? $bill->site_name}}</td>
                    <td data-label="Inventory">{{$bill->inventory->name ?? $bill->inventory_name}}</td>
                    <td data-label="Amount"><i class="fa fa-inr"></i> {{$bill->amount ?? "N/A"}} @if($bill->type == "CR") <span class="badge bg-success text-white mx-2"> {{$bill->type}}</span> @else <span class="badge bg-danger text-white mx-2">{{$bill->type}}</span> @endif</td>
                    <td data-label="comment">{{$bill->comment ?? "N/A"}}</td>
                    <td data-label="Bill" @if($bill->image!="") class="text-center"  @endif>
                      @if($bill->image!="")
                      <a href="{{asset($bill->image)}}" target="_blank"><img src="{{asset($bill->image)}}" alt="" srcset="" width="100px" height="100px"></a>
                      @else
                      N/A
                      @endif
                    </td>
                    <td data-label="Action" class="action-list">
                        <div class="d-inline-flex">
                            <a href="{{route('bills.edit',$bill->id)}}" class="icon edit edit-icon">
                                <div class="tooltip">Edit</div>
                                <i class="fa fa-pencil pnsl"></i>
                                </a>
                                <a class="icon edit" onclick="deletebills('{{route('bills.destory',$bill->id)}}')">
                                    <div class="tooltip">Delete</div>
                                    <i class="fa fa-trash-o btn-danger delete-icn"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if(Auth::user()->type == "admin")
                  <tr>
                    <td colspan="5"></td>
                    <td colspan="1" data-label="Debit" class="bg-success text-white"><strong>Total Credit : <i class="fa fa-inr"></i> {{$total_credit}}</strong></td>
                    <td colspan="1" data-label="Credit" class="bg-danger text-white"><strong>Total Debit : <i class="fa fa-inr"></i> {{$total_debit}}</strong></td>
                    <td colspan="1" data-label="Grand Total" class="bg-primary text-white"><strong>Grand Total : <i class="fa fa-inr"></i> {{$total_grand}}</strong></td>
                  </tr>
                @endif
            </tbody>
        </table>
      @else
        <div class="text-center p-4">
            <p class="mb-0">No Data To Show</p>
        </div>
      @endif
    </div>
    @if($bills->count() > 0 && $bills->count() > 10)
        <div class="pagination-btn text-center mt-5">
            <a class="btn-add add-btn" href="{{ $bills->previousPageUrl() }}">Previous</a>
            <a class="btn-add add-btn" href="{{ $bills->nextPageUrl() }}">Next</a>
        </div>
    @endif
    <div class="delete-modal-main">
      <div class="modal fade" id="deletebills">
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
    function deletebills(url){
      $("#delete-id").attr("href", url);
      $('#deletebills').modal('show');
    }
  </script>
@endsection
@section('script')

@endsection