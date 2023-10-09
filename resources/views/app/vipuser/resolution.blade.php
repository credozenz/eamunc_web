  
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

      <div class="col-md-6 text-center offset-md-3">
  
        <h5 class="text-primary mt-5 mb-3 fs-2">Resolution Corner</h5>
        <p class="fs-6">Once all the changes have been made and amendments been added, 
the committee moves into the action phase. At this point in time, the
chair will ask the delegates if there are any objections to the draft 
resolution. If there are none, the draft resolution is adopted by con-
sensus and is renamed resolution 1.1. </p>
        
        @if(empty($resolution))
        <a href="{{ url('app/vipuser_resolution_editor') }}" type="button" class="btn btn-primary mt-3"> Start Session</a>
        @else
        <a href="{{ url('app/vipuser_resolution_editor') }}" type="button" class="btn btn-primary mt-3">View Resolution</a>
        @endif
        
          
      </div>
      
  </div>

</div>
   
@endsection 
  
   

