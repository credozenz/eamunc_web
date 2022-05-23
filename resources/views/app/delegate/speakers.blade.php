@extends('app.delegate.layouts.layout')
@section('content')
<div class="container-fluid dasboard my-profile">      
  <div class="row">

      <div class="col-md-8">
        <h4 class="dash-main-head">{{ $committee->name ?? '' }}</h4>
        <p class="sub-head">{{ $committee->title ?? '' }}</p>
      </div>

      <div class="col-md-4">
        <div class="d-flex flex-row  mb-3">
            <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
            <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United Nations Conference </h5>
        </div>
      </div>

      <div class="col-md-4 offset-md-8">
      </div>

      <div class="col-md-8">
           <h4 class="mb-3 mt-3 text-primary fs-3">Speaker’s List</h4>
           <p class="fs-6 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
      </div>

      <div class="row">
      @if(!empty($speakersCount))
          @foreach($speakers as $key => $speaker)
          <div class="col-md-4">
            <div class="border-box d-flex ">
              <span class="position-absolute top-0 start-50  translate-middle badge rounded-pill bg-primary">
               {{ $key+1 }}
              </span>
              <h6 class="mx-auto d-inline-block text-primary  my-auto ">{{ $speaker->country_name }} </h6>
            </div>
          </div>
          @endforeach
        @endif
        </div>

     
      
  </div>
</div>
    
   
@endsection 
  
   
