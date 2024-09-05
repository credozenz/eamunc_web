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
              <p style="color:#4D4D4D; font-size: 15px;">Once the general speakers list has been exhausted, the committee 
moves into informal- informal meeting. At this stage, the rules of 
procedure are suspended and delegates are divided into blocs along 
regional or political lines. </p>
          </div>     
            
          <div class="col-md-8">
             <div class="blue-box mt-3">
                @if($mybloc)  
                <h4>Start My Discussion</h4>
                <p class="mt-2 mb-3"> </p>
                
                <div class="col-md-3 mb-3">
                <div class="bloc-box text-center">
                    <h6>{{ ucfirst($mybloc->name) ?? '' }}</h6>
                    <a href="{{ url('app/delegate_bloc_chat',$mybloc->id) }}">Start Now</a>
                </div>
              </div>
               
                @else
                <h4>Start My Discussion</h4>
                <p class="mt-2 mb-3">You have not been assigned to a block. Please wait.</p>
                @endif 
              </div>
          </div>

        @if($committee_bloc)
          <div class="col-md-12">
          <h4 class="fs-3 text-primary mb-3 mt-5 fw-bold">View Other Blocks</h4>
          </div>
          <div class="row">

              @php
              $mybloc_id = isset($mybloc->id)? $mybloc->id : 0;
              @endphp
              @foreach($committee_bloc as $value)
              @if($value->id != $mybloc_id)
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
  
   
