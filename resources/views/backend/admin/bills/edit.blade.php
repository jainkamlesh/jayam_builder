@extends('backend.layouts.app')
@section('content')

<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('bills.index')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Edit Bill</h2>
</section>
<div class="property-wrapper container mt-5 channel-wrapper">
    <form class="forms-sample" action="{{ route('bills.update',$bill->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if(Auth::user()->type == "admin")
              <div class="col-sm-12 mt-3 ">
                <label>Site :</label>
                <select class="form-control" name="site_id">
                    @foreach ($sites as $site)      
                        <option value="{{$site->id}}">{{$site->name}}</option>
                    @endforeach
                </select>
                <input type="hidden" name="type" value="CR">
                @error('site_id')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div> 
            @else
            <div class="col-sm-12 mt-3">
              <label>Site:</label>                            
              <input type="text" class="form-control" name="site" placeholder="Enter Site" disabled value="{{$bill->site->name ?? $bill->site_name}}">
              <input type="hidden" name="site_id" value="{{$bill->site_id}}">
              <input type="hidden" name="type" value="DR">
              @error('quantity')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            @endif
        <div class="col-sm-12 mt-3 ">
          <label>Inventory :</label>
          <select class="form-control" name="inventory_id">
              @foreach ($inventories as $inventory)      
                  <option value="{{$inventory->id}}">{{$inventory->name}}</option>
              @endforeach
          </select>
          @error('inventory_id')
            <span class="text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div> 
        <div class="col-sm-12 mt-3">
          <label>Amount:</label>                            
          <input type="text" class="form-control" name="amount" placeholder="Enter Amount" value="{{$bill->amount}}">
          @error('amount')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="col-sm-12 mt-3">
          <label>Comment:</label>                            
          <textarea name="comment" id="" class="form-control" cols="30" rows="3" placeholder="Enter comment" style="height: 100px">{{$bill->comment}}</textarea>
        </div>
        <div class="col-sm-12 mt-3">
          <label>Bill Upload:</label>                            
          <input id="fileInput" class="form-control" name="image" type="file" accept="image/*" >
          @if($bill->image !="")
           <img src="{{asset($bill->image)}}" alt="" srcset="" width="100px" height="100px">
          @endif
        </div>
        <div class="modal-footer mt-5">
          <button type="submit" class="btn btn-default btn-save">Save</button>
        </div> 
    </form>
</div>

@endsection

@section('script')
@endsection