@extends('app.delegate.layouts.layout')
@section('content')
   
  
    <div class="container-fluid dasboard">
        <!-- Breadcrumbs-->
        
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

          <div class="col-md-12">
          <h4 class="fs-3 text-primary mb-3">Bloc Formation</h4>
              <p style="color:#4D4D4D; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
          </div>     
            
          <div class="col-md-8">
             <div class="blue-box mt-3">
                @if($mybloc)  
                <h4>Start My Discussion</h4>
                <p class="mt-2 mb-3">Card layouts can vary to support the types of content they contain. The following elements are commonly found among that variety.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
                
                <div class="col-md-3 mb-3">
                <div class="bloc-box text-center">
                    <h6>{{ ucfirst($mybloc->name) ?? '' }}</h6>
                    <a href="{{ url('app/delegate_bloc_chat',$mybloc->id) }}">Start Now</a>
                </div>
              </div>
               
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
              @if($value->id != $mybloc->id)
              <div class="col-md-3 mb-3">
                <div class="bloc-box text-center">
                    <h6>{{ ucfirst($value->name) ?? '' }}</h6>
                    <a href="{{ url('app/delegate_bloc_chat',$value->id) }}">View</a>
                </div>
              </div>
              @endif
              @endforeach
          
          
          </div>
        @endif 
          
      </div>

    </div>
  
@endsection 
  
   
