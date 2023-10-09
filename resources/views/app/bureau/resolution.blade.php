  
@extends('app.bureau.layouts.layout')
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
        <a href="{{ url('app/bureau_resolution_editor') }}" type="button" class="btn btn-primary mt-3"> Start Session</a>
        @else
        <a href="{{ url('app/bureau_resolution_editor') }}" type="button" class="btn btn-primary mt-3">View Resolution</a>
        @endif
        
          
      </div>
      @if(!empty($resolution))
      <div class="commitee-box disable-scrollbars" style="max-height: 600px;">
      <h6 class="text-primary text-start">Accepted Delegates</h6>
      <div class="row">
      @if($acceptedDelegates)
              @foreach($acceptedDelegates as $value)
                @if($value->role==2)
                <div class="col-md-4">
                    <div class="d-flex flex-row  mb-3">
                          @if(!empty($value->avatar)) 
                          <img src="{{ asset('uploads/'.$value->avatar) }}" class="rounded-circle" alt="{{ $value->name ?? '' }}">
                          @else
                          <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $value->name ?? '' }}">
                          @endif
                      <p>{{ str_limit($value->name ?? '', $limit = 12, $end = '...') }}</p>
                    </div>
                  </div>
                  
                @endif
              @endforeach
          @else
              <div class="blue-box mt-3">
                        <h4>Please wait !</h4>
                  <p class="mt-2 mb-3">This session has not started !</p>
              </div>
          @endif
          </div>
        </div>
      @endif
  </div>

</div>
   
@endsection 
  
   

