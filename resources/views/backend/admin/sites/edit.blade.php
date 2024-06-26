@extends('backend.layouts.app')
@section('content')

<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('sites.index')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Edit Site</h2>
</section>
<div class="property-wrapper container mt-5 channel-wrapper">
    <form class="forms-sample" action="{{ route('sites.update',$site->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-sm-12 mt-3">
          <label>Name :</label>
          <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$site->name}}">
          @error('name')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror 
        </div>
        <div class="col-sm-12 mt-3">
          <label>Address:</label>                            
          <input type="text" class="form-control" name="address" placeholder="Enter Address" value="{{$site->address}}">
          @error('address')
              <span class="text-danger" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
        <div class="col-sm-12 mt-3">
          <label>Note:</label>                            
          <textarea name="note" id="" class="form-control" cols="30" rows="3" placeholder="Enter Note" style="height: 100px">{{$site->note}}</textarea>
        </div>
        <div class="modal-footer mt-5">
          <button type="submit" class="btn btn-default btn-save">Save</button>
        </div> 
    </form>
</div>

@endsection

@section('script')
@endsection