@extends('backend.layouts.app')
@section('content')

<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('accountingtwo.index')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Edit Bill</h2>
</section>
<div class="property-wrapper container mt-5 channel-wrapper">
    <form class="forms-sample" action="{{ route('accountingtwo.update',$accounting->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-sm-12 mt-3 ">
          <label>Site :</label>
          <select class="form-control" name="site_id">
              @foreach ($sites as $site)      
                  <option value="{{$site->id}}" @if($site->id == $accounting->site_id) selected @endif>{{$site->name}}</option>
              @endforeach
          </select>
          @error('site_id')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div> 

        <div class="col-sm-12 mt-3">
          <label>GST No:</label>                            
          <input type="text"  class="form-control" name="gst_no" placeholder="Enter GST No" value="{{$accounting->gst_no}}">
          @error('gst_no')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="col-sm-12 mt-3">
          <label>GST Percentage:</label>                            
          <input type="number" min="0"  step="0.01" class="form-control" name="gst_percentage" id="gst_percentage" placeholder="Enter GST Percentage" value="{{$accounting->gst_percentage}}" onkeyup="gst_credit_cal()">
          @error('gst_percentage')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="col-sm-12 mt-3 ">
          <label>Type :</label>
          <select class="form-control" name="type">
                  <option value="DR" @if("DR" == $accounting->type) selected @endif>Debit</option>
                  <option value="CR" @if("CR" == $accounting->type) selected @endif>Credit</option>
          </select>
          @error('type')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div> 

        <div class="col-sm-12 mt-3">
          <label>Amount:</label>                            
          <input type="number" min="0" step="0.01" class="form-control" name="amount"  placeholder="Enter Amount" value="{{$accounting->amount}}" id="amounts" onkeyup="gst_credit_cal()">
          @error('amount')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="col-sm-12 mt-3">
          <label>GST Amount:</label>                            
          <input type="number" min="0" readonly  step="0.01" class="form-control" name="gst_credit" id="gst_credit" placeholder="Enter GST Amount" value="{{$accounting->gst_credit}}">
          @error('gst_credit')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="col-sm-12 mt-3 ">
          <label>Inventory :</label>
          <select class="form-control" name="inventory">
              @foreach ($inventories as $inventory)      
                  <option value="{{$inventory->id}}" @if($inventory->id == $accounting->site_id) selected @endif>{{$inventory->name}}</option>
              @endforeach
          </select>
          @error('inventory_id')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div> 

        <div class="col-sm-12 mt-3 ">
          <label>Date :</label>
          <input class="form-control" name="accounting_date" type="date" value="{{date('Y-m-d', strtotime($accounting->accounting_date))}}">
          @error('accounting_date')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div> 

        <div class="col-sm-12 mt-3">
          <label>Bill Upload:</label>                            
          <input id="fileInput" class="form-control" name="image" type="file" accept="image/*" >
          @if($accounting->image !="")
           <img src="{{asset($accounting->image)}}" alt="" srcset="" width="100px" height="100px">
          @endif
        </div>

        <div class="modal-footer mt-5">
          <button type="submit" class="btn btn-default btn-save">Save</button>
        </div> 
    </form>
</div>
<script>
  function gst_credit_cal(){
    let per = $('#gst_percentage').val();
    let amount = $('#amounts').val();
    let gstcredit = 0;
    gstcredit =  (amount*per)/100;
    $('#gst_credit').val(gstcredit);
  }
</script>
@endsection

@section('script')
@endsection