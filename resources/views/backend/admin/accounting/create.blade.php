@extends('backend.layouts.app')
@section('content')

<section class="property-wrapper mt-4 pms-wrapper">
    <a href="{{route('accounting.index')}}" class="back-icon" data-toggle="tooltip" title="Back"><img src="{{asset('backend/images/chevron.png')}}" class="back-image"></a>
    <h2 class="list-heading">Add Accounting</h2>
</section>
<div class="property-wrapper container mt-5 channel-wrapper">
     <form class="" action="{{ route('accounting.store')  }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-sm-12 mt-3 ">
              <label>Site :</label>
              <select class="form-control" name="site_id">
                  @foreach ($sites as $site)      
                      <option value="{{$site->id}}">{{$site->name}}</option>
                  @endforeach
              </select>
              @error('site_id')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div> 
            <div class="col-sm-12 mt-3">
              <label>Amount:</label>                            
              <input type="text" class="form-control" name="amount" placeholder="Enter Amount">
              @error('amount')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="col-sm-12 mt-3 ">
              <label>Type :</label>
              <select class="form-control" name="type">
                      <option value="DR">Debit</option>
                      <option value="CR">Credit</option>
              </select>
              @error('type')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div> 

            <div class="col-sm-12 mt-3 ">
              <label>Date :</label>
              <input class="form-control" name="accounting_date" type="date" value="{{date('Y-m-d')}}">
              @error('accounting_date')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div> 

            <div class="col-sm-12 mt-3">
              <label>Comment:</label>                            
              <textarea name="comment" id="" class="form-control" cols="30" rows="3" placeholder="Enter comment" style="height: 100px"></textarea>
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