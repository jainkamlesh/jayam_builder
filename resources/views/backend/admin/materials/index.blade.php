@extends('backend.layouts.app')
@section('content')
<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('home')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Material List</h2>
</section>
<section class="property-wrapper mt-4 user-wrapper">
    <form action="" method="get">
        <div class="d-flex justify-content-between align-items-center container-fluid mt-4 pro-add-nnb">
           
            @if(Auth::user()->type == "admin")
            <div class="d-flex align-items-center container-fluid mt-4 pro-add-nnb">
              <div class="d-flex position-relative top-margin ">
                <select class="prop-inp radius-0" name="dealer_id">
                  <option value="">All Dealer</option>
                  @foreach (\App\Models\Dealer::get() as $dealer)      
                      <option value="{{$dealer->id}}" @if($dealer_id == $dealer->id) selected @endif>{{$dealer->name}}</option>
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
                <a class="btn btn-danger radius-0 w-50" href="{{route('materials.index')}}"><i class="fa fa-remove"></i></a>
              </div>
              </div>
              @else
              <div class="d-flex position-relative top-margin">
                <input type="text" name="search" placeholder="Search materials" class="prop-inp radius-0" value="{{$sort_search}}">
                <i class="fa fa-search srch-icn-vg" aria-hidden="true"></i>
                <button class="btn-add radius-0" type="submit"><i class="fa fa-search"></i></button>
              </div>
              @endif
              <div class="d-flex position-relative">
                <a href="{{route('materials.create')}}"><button class="btn-add add-btn" style="width: 180px;" type="button"><i class="fa fa-plus" aria-hidden="true"></i>Add Material</button></a>
                @if(Auth::user()->type == "admin")
                  <a href="{{route('lumsum.create_lumsum')}}"><button class="btn-add add-btn" style="width: 180px;" type="button"><i class="fa fa-plus" aria-hidden="true"></i>Lumsum Paid</button></a>
                @endif
              </div>
           
          </div>
    </form>
    <div class="container-fluid">
      @if($materials->count() > 0)  
        <table class="mt-4 pro-table-pg table-hover wrapper">
            <thead>
            <tr class="ft-tr">
                <th>ID</th>
                <th>Manager Name</th>
                <th>Material Name</th>
                <th>Dealer</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Bill No</th>
                <th>Gadi No</th>
                <th>Bill</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($materials as $material)             
                <tr>
                    <td scope="row" data-label="ID">{{$material->id}}</td>
                    <td data-label="Manager Name">{{$material->user->name ?? "N/A"}}</td>
                    <td data-label="Material Name">{{$material->material_name ?? "N/A"}}</td>
                    <td data-label="Dealer">{{$material->dealer->name ?? $material->dealer_name}}</td>
                    <td data-label="Quantity">{{$material->quantity ?? "N/A"}}</td>
                    <td data-label="Total Amount"><i class="fa fa-inr"></i> {{$material->amount ?? "0"}}</td>
                    <td data-label="Bill No.">{{$material->bill_no ?? "N/A"}}</td>
                    <td data-label="Gadi No.">{{$material->gadi_no ?? "N/A"}}</td>
                    <td data-label="Bill" @if($material->image!="") class="text-center"  @endif>
                      @if($material->image!="")
                      <a href="{{asset($material->image)}}" target="_blank"><img src="{{asset($material->image)}}" alt="" srcset="" width="100px" height="100px"></a>
                      @else
                      N/A
                      @endif
                    </td>
                    {{-- <td data-label="Action" class="action-list">
                        <div class="d-inline-flex">
                            <a href="{{route('materials.edit',$material->id)}}" class="icon edit edit-icon">
                                <div class="tooltip">Edit</div>
                                <i class="fa fa-pencil pnsl"></i>
                                </a>
                                <a class="icon edit" onclick="deleterequirements('{{route('materials.destory',$material->id)}}')">
                                    <div class="tooltip">Delete</div>
                                    <i class="fa fa-trash-o btn-danger delete-icn"></i>
                                </a>
                            </div>
                        </td> --}}
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
    @if($materials->count() > 0 && $materials->count() > 10)
        <div class="pagination-btn text-center mt-5">
            <a class="btn-add add-btn" href="{{ $materials->previousPageUrl() }}">Previous</a>
            <a class="btn-add add-btn" href="{{ $materials->nextPageUrl() }}">Next</a>
        </div>
    @endif

    @if(Auth::user()->type == "admin")
     <section class="property-wrapper mt-5 pms-wrapper">
      <h2 class="list-heading">Lumsum Paid</h2>
     </section>
      <div class="container-fluid">
        @if($lumsumpaid->count() > 0)  
          <table class="mt-4 pro-table-pg table-hover wrapper">
              <thead>
              <tr class="ft-tr">
                  <th>ID</th>
                  <th>Dealer</th>
                  <th>Total Paid Amount</th>
                  <th>Bill No</th>
                  <th>Paid Date</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($lumsumpaid as $lumsum)             
                  <tr>
                      <td scope="row" data-label="ID">{{$lumsum->id}}</td>
                      <td data-label="Dealer">{{$lumsum->dealer->name ?? $lumsum->dealer_name}}</td>
                      <td data-label="Total Paid Amount"><i class="fa fa-inr"></i> {{$lumsum->amount ?? "0"}}</td>
                      <td data-label="Bill No.">{{$lumsum->bill_no ?? "N/A"}}</td>
                      <td data-label="Paid Date">{{ date('d-m-Y',strtotime($lumsum->paid_date)) }}</td>
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
      @if($lumsumpaid->count() > 0 && $lumsumpaid->count() > 10)
          <div class="pagination-btn text-center mt-5">
              <a class="btn-add add-btn" href="{{ $lumsumpaid->previousPageUrl() }}">Previous</a>
              <a class="btn-add add-btn" href="{{ $lumsumpaid->nextPageUrl() }}">Next</a>
          </div>
      @endif
    @endif

    @if(Auth::user()->type == "admin")
      <table class="mt-4 pro-table-pg table-hover wrapper">
                  <tr>
                    <td colspan="5"></td>
                    <td colspan="1" data-label="Total" class="bg-info text-white"><strong>Total : <i class="fa fa-inr"></i> {{$totalamount}}</strong></td>
                    <td colspan="1" data-label="Total Paid " class="bg-success text-white"><strong>Total Paid : <i class="fa fa-inr"></i> {{$paidamount}}</strong></td>
                    <td colspan="1" data-label="Pending" class="bg-warning text-white"><strong>Pending : <i class="fa fa-inr"></i> {{$pendingamount}}</strong></td>
                  </tr>
      </table>
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