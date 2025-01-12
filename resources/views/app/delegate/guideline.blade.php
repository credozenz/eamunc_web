@extends('app.delegate.layouts.layout')
@section('content')
  
   <div class="container-fluid dasboard"> 
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
      
      <div class="col-md-8">
        <h5 class="text-primary mt-5 mb-3">{{ $guideline->title ?? '' }}</h5>
        <p> {!! $guideline->description ?? '' !!}<p>
        <a href="{{ route('app.delegate_program_schedule') }}" class="btn btn-primary "><i class="fa fa-calendar-o" aria-hidden="true"></i> View Program Schedule</a>
        <a href="{{ route('app.delegate_speaker') }}" type="button" class="btn btn-primary ms-3"><i class="fa fa-calendar-o" aria-hidden="true"></i> View Speakers List</a><br>
        <a href="{{ url('/committees-inner/'.$committee->id) }}" class="d-inline-block mt-5 fs-6 fw-bold text-primary text-decoration-underline">View Program Resources</a>  
      </div>

      <div class="col-md-4">
        
        <div class="d-grid">
          <a href="{{ route('app.liability_waiver_form') }}" class="btn btn-primary "><i class="fa fa-file-text-o" aria-hidden="true"></i> Submit Liability Waiver Form</a>
        </div>
          
        <div class="commitee-box disable-scrollbars" style="max-height: 600px;">

          <h6 class="text-primary">Bureau Members</h6>
            @if($committee_member)
              @foreach($committee_member as $value)
                @if($value->role==3)
                    <div class="d-flex flex-row  mb-3">
                          @if(!empty($value->avatar)) 
                          <img src="{{ asset('uploads/'.$value->avatar) }}" class="rounded-circle" alt="{{ $value->name ?? '' }}">
                          @else
                          <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $value->name ?? '' }}">
                          @endif
                      <p>{{ str_limit($value->name, $limit = 12, $end = '...') }}</p>
                    </div>
                @endif
              @endforeach
            @endif
            
          <h6 class="text-primary">Delegate Members</h6>
            @if($committee_member)
              @foreach($committee_member as $value)
                @if($value->role==2)
                    <div class="d-flex flex-row  mb-3">
                          @if(!empty($value->avatar)) 
                          <img src="{{ asset('uploads/'.$value->avatar) }}" class="rounded-circle" alt="{{ $value->name ?? '' }}">
                          @else
                          <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $value->name ?? '' }}">
                          @endif
                      <p>{{ str_limit($value->name, $limit = 12, $end = '...') }}</p>
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
  
   
