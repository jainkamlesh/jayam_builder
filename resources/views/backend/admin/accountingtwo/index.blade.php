@extends('backend.layouts.app')
@section('content')
<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('home')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Accounting List</h2>
</section>
<section class="property-wrapper mt-4 user-wrapper">
    <form action="" method="get">

          <div class="d-flex  align-items-center container-fluid mt-4 pro-add-nnb">
            <div class="d-flex position-relative">
              <input type="text" name="search" placeholder="Search Bill" class="prop-inp radius-0" value="{{$sort_search}}">
              <i class="fa fa-search srch-icn-vg" aria-hidden="true"></i>
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
              <a class="btn btn-danger radius-0 w-50" href="{{route('accountingtwo.index')}}"><i class="fa fa-remove"></i></a>
           </div>
          </div>
          <div class="d-flex justify-content-end align-items-center container-fluid pro-add-nnb bill-button">
            <div class="d-flex position-relative">
            </div>
             <a href="{{route('accountingtwo.create')}}"><button class="btn-add add-btn" type="button"><i class="fa fa-plus" aria-hidden="true"></i>Add Accounting</button></a>
             <button class="btn-add add-btn printMe mx-2" type="button" ><i class="fa fa-print" aria-hidden="true"></i>Print</button>
          </div>        
    </form>
    <div class="container-fluid">
      @if(Auth::user()->type == "admin")
        <table class="mt-4 pro-table-pg table-hover wrapper">
          <tr >
              <td  data-label="GST Debit" class="bg-success text-white"><strong>GST Credit : <i class="fa fa-inr"></i> {{$total_credit}}</strong></td>
              <td  data-label="GST Credit" class="bg-danger text-white"><strong>GST Debit : <i class="fa fa-inr"></i> {{$total_debit}}</strong></td>
              <td  data-label="Exactement" class="bg-primary text-white"><strong>Exactement : <i class="fa fa-inr"></i> {{$total_grand}}</strong></td>
              <td colspan="5"></td>
          </tr>
        </table>  
      @endif
      @if($accounting->count() > 0)  
        <table class="mt-4 pro-table-pg table-hover wrapper">
            <thead>
            <tr class="ft-tr">
                <th>ID</th>
                <th>Site</th>
                <th>Amount</th>
                <th>GST No</th>
                <th>GST Percentage</th>
                <th>GST Amount</th>
                <th>Bill</th>
                <th>Inventory</th>
                <th style="width: 230px;">Date</th>
                <th style="width: 230px;">Status</th>
                <th style="width: 230px;">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($accounting as $account)             
                <tr>
                    <td scope="row" data-label="ID">{{$account->id}}</td>
                    <td data-label="Site">{{$account->site->name ?? $account->site_name}}</td>
                    <td data-label="Amount"><i class="fa fa-inr"></i> {{$account->amount ?? "0"}}  @if($account->type == "CR") <span class="badge bg-success text-white mx-2"> {{$account->type}}</span> @else <span class="badge bg-danger text-white mx-2">{{$account->type}}</span> @endif</td>
                    <td data-label="GST No.">{{$account->gst_no ?? "N/A"}}</td>
                    <td data-label="GST Percentage">{{$account->gst_percentage ?? "N/A"}}</td>
                    <td data-label="GST Credit"><i class="fa fa-inr"></i> {{$account->gst_credit ?? "N/A"}}</td>
                    <td data-label="Bill" @if($account->image!="") class="text-center"  @endif>
                      @if($account->image!="")
                      <a href="{{asset($account->image)}}" target="_blank"><img src="{{asset($account->image)}}" alt="" srcset="" width="100px" height="100px"></a>
                      @else
                      N/A
                      @endif
                    </td>
                    <td data-label="Inventory">{{$account->inventory->name ?? $account->inventory_name}}</td>
                    <td data-label="Date">{{$account->accounting_date ?? "N/A"}}</td>
                    <td data-label="Status">
                      <select class="form-control" name="status" onchange="change_status(this)">
                        <option value="{{route('accountingtwo.status',[$account->id,'pending'])}}" @if($account->status == "pending") selected @endif>Pending</option>
                        <option value="{{route('accountingtwo.status',[$account->id,'paid'])}}" @if($account->status == "paid") selected @endif>Paid</option>
                       </select>
                    </td>
                    <td data-label="Action" class="action-list">
                        <div class="d-inline-flex">
                            <a href="{{route('accountingtwo.edit',$account->id)}}" class="icon edit edit-icon">
                                <div class="tooltip">Edit</div>
                                <i class="fa fa-pencil pnsl"></i>
                                </a>
                                <a class="icon edit" onclick="deleteaccounting('{{route('accountingtwo.destory',$account->id)}}')">
                                    <div class="tooltip">Delete</div>
                                    <i class="fa fa-trash-o btn-danger delete-icn"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @if(Auth::user()->type == "admin")
                  <tr>
                    <td colspan="8"></td>
                    <td colspan="1" data-label="GST Credit" class="bg-success text-white" style="wi"><strong>GST Credit : <i class="fa fa-inr"></i> {{$total_credit}}</strong></td>
                    <td colspan="1" data-label="GST Debit" class="bg-danger text-white"><strong>GST Debit : <i class="fa fa-inr"></i> {{$total_debit}}</strong></td>
                    <td colspan="1" data-label="Exactement" class="bg-primary text-white"><strong>Exactement : <i class="fa fa-inr"></i> {{$total_grand}}</strong></td>
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
    @if($accounting->count() > 0 && $accounting->count() > 10)
        <div class="pagination-btn text-center mt-5">
            <a class="btn-add add-btn" href="{{ $accounting->previousPageUrl() }}">Previous</a>
            <a class="btn-add add-btn" href="{{ $accounting->nextPageUrl() }}">Next</a>
        </div>
    @endif
    <div class="delete-modal-main">
      <div class="modal fade" id="deleteaccounting">
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
    function deleteaccounting(url){
      $("#delete-id").attr("href", url);
      $('#deleteaccounting').modal('show');
    }

    function change_status(e){
      var url =e.value;
      window.location.href = url;
    }
  </script>
@endsection
@section('script')

@endsection