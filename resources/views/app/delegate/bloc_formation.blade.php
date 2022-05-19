@extends('app.delegate.layouts.layout')
@section('content')
   
  
    <div class="container-fluid dasboard">
        <!-- Breadcrumbs-->
        
      
       
       
        <div class="row">
          <div class="col-md-4 offset-md-8">
            <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;">{{ $committee->title ?? '' }}</h5>
            </div>


             
            
      <div class="col-md-8">
          <h4 class="fs-3 text-primary mb-3">Bloc Formation</h4>
          <p style="color:#4D4D4D; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
          <div class="blue-box mt-3">
             @if($mybloc)  
            <h4>Start My Discussion</h4>
            <p class="mt-2 mb-3">Card layouts can vary to support the types of content they contain. The following elements are commonly found among that variety.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
            <button type="button" class="btn btn-primary ">Start Now</button>
            @else
            <h4>Start My Discussion</h4>
            <p class="mt-2 mb-3">You are not a part of any bloc !, Please wait for assign to a block</p>
            @endif 
          </div>
      </div>

     

    @if($committee_bloc)
      <div class="col-md-12">
      <h4 class="fs-3 text-primary mb-3 mt-5 fw-bold">View Other Blocs</h4>
      </div>
      <div class="row">

      
          @foreach($committee_bloc as $value)
          <div class="col-md-3">
            <div class="bloc-box text-center">
                <h6>{{ ucfirst($value->name) ?? '' }}</h6>
                <a href="{{ url('app/delegate_bloc_chat',$value->id) }}">View</a>
            </div>
          </div>
          @endforeach
       
      
      </div>
    @endif 
      
      </div>
      </div>
  
@endsection 
  
   
