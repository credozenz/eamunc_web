@extends('app.vipuser.layouts.layout')
@section('content')
   
<div class="container-fluid dasboard add-speaker-page">
          
    <div class="row">
       
        <div class="col-md-8">
          <h4 class="dash-main-head">{{ $committee->name ?? '' }}</h4>
          <p class="sub-head">{{ $committee->title ?? '' }}</p>
        </div>

        <div class="col-md-4">
          <div class="d-flex flex-row  mb-3">
            <a href="{{ url('') }}" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
            <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United Nations Conference </h5>
          </div>
        </div>

        <div class="col-md-12 text-center">
    
          <h5 class="text-primary mt-5 mb-3 fs-2">Resolution</h5>
          <label class="form-label text-dark">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
          </label>
          <form method="post" action="{{ url('app/bureau_resolution_store') }}" class="mt-5 col-md-12"  enctype="multipart/form-data">
            @csrf
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <textarea id="txt_editor" type="text" name="resolution" class="form-control @error('resolution') border-danger @enderror" style="height: 850px;">{{ $resolution->content ?? old('resolution') }}</textarea>
                        @error('resolution')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <!-- <button type="submit" class="btn btn-primary mt-3"> Submit</button> -->
          </form>
           
        </div>
      
    </div>

</div>
   
@endsection 
  
   
