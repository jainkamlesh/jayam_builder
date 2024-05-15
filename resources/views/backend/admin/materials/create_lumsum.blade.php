@extends('backend.layouts.app')
@section('content')

<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('materials.index')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Lumsum Paid</h2>
</section>
<div class="property-wrapper container mt-5 channel-wrapper">
     <form class="" action="{{ route('lumsum.store_lumsum')  }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-sm-12 mt-3 ">
              <label>Dealer :</label>
              <select class="form-control" name="dealer_id">
                  @foreach ($dealers as $dealer)      
                      <option value="{{$dealer->id}}">{{$dealer->name}}</option>
                  @endforeach
              </select>
              @error('dealer_id')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div> 

            <div class="col-sm-12 mt-3">
              <label>Bill No:</label>                            
              <input type="text" class="form-control" name="bill_no" placeholder="Enter bill no">
              @error('bill_no')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="col-sm-12 mt-3">
              <label>Total Amount:</label>                            
              <input type="number" min="0" value="0" step="0.01" class="form-control" name="amount" placeholder="Total Amount">
              @error('amount')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

        
            <div class="col-sm-12 mt-3 ">
              <label>Date :</label>
              <input class="form-control" name="paid_date" type="date" value="{{date('Y-m-d')}}">
              @error('paid_date')
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