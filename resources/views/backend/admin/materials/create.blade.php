@extends('backend.layouts.app')
@section('content')

<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('materials.index')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Add Material</h2>
</section>
<div class="property-wrapper container mt-5 channel-wrapper">
     <form class="" action="{{ route('materials.store')  }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="col-sm-12 mt-3">
              <label>Material Name:</label>                            
              <input type="text" class="form-control" name="material_name" placeholder="Enter material name">
              @error('material_name')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

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
              <label>Quantity:</label>                            
              <input type="text" class="form-control" name="quantity" placeholder="Enter quantity">
              @error('quantity')
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
              <label>Gadi No:</label>                            
              <input type="text" class="form-control" name="gadi_no" placeholder="Enter gadi no">
              @error('gadi_no')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="col-sm-12 mt-3">
              <label>Bill Upload:</label>                            
              <input id="fileInput" class="form-control" name="image" type="file" accept="image/*" >
            </div>
            
          <div class="modal-footer mt-5">
            <button type="submit" class="btn btn-default btn-save">Save</button>
          </div> 
    </form>
</div>

@endsection

@section('script')
@endsection