@extends('app.delegate.layouts.layout')
@section('content')





      <div class="container-fluid dasboard my-profile">
        <!-- Breadcrumbs-->
        
      
       
       
        <div class="row">
          <div class="col-md-4 offset-md-8">
            <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> {{ $committee->title ?? '' }}</h5>
              
             
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
  
   
