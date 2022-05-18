@extends('app.delegate.layouts.layout')
@section('content')
   
<div class="container-fluid dasboard add-speaker-page">
    
       
        <div class="row">
       
       <div class="col-md-4 offset-md-8">
        
        <div class="d-flex flex-row  mb-3">
          <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
          <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;">  {{ $committee->title ?? '' }}</h5>
          
          </div>
         
         
         
        
        </div>

        <div class="col-md-6 text-center offset-md-3">
    
          <h5 class="text-primary mt-5 mb-3 fs-2">Vienna Formula</h5>
          <p class="fs-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
          
          <a href="{{ url('app/delegate_vienna_formula_editor') }}" type="button" class="btn btn-primary mt-3"> Start Session</a>
           
         </div>
      
      </div>
      </div>
   
@endsection 
  
   
