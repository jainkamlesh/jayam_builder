@extends('backend.layouts.app')
@section('content')

<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('requirements.index')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Add Requirement</h2>
</section>
<div class="property-wrapper container mt-5 channel-wrapper">
     <form class="" action="{{ route('requirements.store')  }}" method="post" enctype="multipart/form-data">
            @csrf
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
            <label>Quantity:</label>                            
            <input type="text" class="form-control" name="quantity" placeholder="Enter quantity">
            @error('quantity')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="col-sm-12 mt-3">
            <label>Comment:</label>                            
            <textarea name="comment" id="" class="form-control" cols="30" rows="3" placeholder="Enter comment" style="height: 100px"></textarea>
          </div>
        <div class="modal-footer mt-5">
          <button type="submit" class="btn btn-default btn-save">Save</button>
        </div> 
    </form>
</div>

@endsection

@section('script')
@endsection