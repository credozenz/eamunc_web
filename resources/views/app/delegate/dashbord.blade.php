@extends('app.delegate.layouts.layout')
@section('content')
  
   <div class="container-fluid dasboard"> 
    <div class="row">
    
      <div class="col-md-8">
        <h4 class="dash-main-head">SOCHUM</h4>
        <p class="sub-head">Company Name</p>
        <h5 class="text-primary mt-5 mb-3">{{ $guideline->title ?? '' }}</h5>
        <p> {!! $guideline->description ?? '' !!}<p>
        <button type="button" class="btn btn-primary "><i class="fa fa-calendar-o" aria-hidden="true"></i> View Program Schedule</button>
        <a href="{{ route('app.delegate_speaker') }}" type="button" class="btn btn-primary ms-3"><i class="fa fa-calendar-o" aria-hidden="true"></i> View Speakers List</a><br>
        <a href="#" class="d-inline-block mt-5 fs-6 fw-bold text-primary text-decoration-underline">View Program Resources</a>  
      </div>

      <div class="col-md-4">
        <div class="d-flex flex-row  mb-3">
          <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
          <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;">   Model
            United Nations Conference</h5>
        </div>
        <div class="d-grid">
          <button type="button" class="btn btn-primary "><i class="fa fa-file-text-o" aria-hidden="true"></i> Submit Liability Waiver Form</button>
        </div>
          
        <div class="commitee-box">

          <h6 class="text-primary">Bureau Members</h6>
            @if($committee_member)
              @foreach($committee_member as $value)
                @if($value->role==3)
                    <div class="d-flex flex-row  mb-3">
                          @if(!empty($value->image)) 
                          <img src="{{ asset('uploads/'.$value->image) }}" class="rounded-circle" alt="{{ $value->name ?? '' }}">
                          @else
                          <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $value->name ?? '' }}">
                          @endif
                      <p>{{ $value->name ?? '' }}</p>
                    </div>
                @endif
              @endforeach
            @endif
           
          <h6 class="text-primary">Comittee Members</h6>
           @if($committee_member)
              @foreach($committee_member as $value)
                @if($value->role==2)
                    <div class="d-flex flex-row  mb-3">
                          @if(!empty($value->image)) 
                          <img src="{{ asset('uploads/'.$value->image) }}" class="rounded-circle" alt="{{ $value->name ?? '' }}">
                          @else
                          <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $value->name ?? '' }}">
                          @endif
                      <p>{{ $value->name ?? '' }}</p>
                    </div>
                @endif
              @endforeach
           @endif

          
           
         
           
           <div class="d-flex flex-row  mb-3 w"></div>
        
        
        </div>
        
      </div>
      
    </div>
  </div>
   
@endsection 
  
   