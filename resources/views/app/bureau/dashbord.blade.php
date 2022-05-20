@extends('app.bureau.layouts.layout')
@section('content')
   
<div class="container-fluid dasboard">
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


    <div class="col-md-8">
      <h5 class="text-primary mt-5 mb-3">{{ $guideline->title ?? '' }}</h5>
            {!! $guideline->description ?? '' !!}
      <a href="{{ route('app.bureau_speaker') }}" type="button" class="btn btn-primary "><i class="fa fa-microphone" aria-hidden="true"></i> Speakers List</a>
      <button type="button" class="btn btn-primary ms-3"><i class="fa fa-calendar-o" aria-hidden="true"></i> Create Program Schedule</button><br>
      <a href="#" class="d-inline-block mt-5 fs-6 fw-bold text-primary text-decoration-underline">View Program Resources</a>  
    </div>

    <div class="col-md-4">
        
      <div class="commitee-box">
        <h6 class="text-primary text-start">Bureau Members</h6>
          @if($committee_member)
            @foreach($committee_member as $value)
              @if($value->role==3)
                  <div class="d-flex flex-row  mb-3">
                        @if(!empty($value->avatar)) 
                        <img src="{{ asset('uploads/'.$value->avatar) }}" class="rounded-circle" alt="{{ $value->name ?? '' }}">
                        @else
                        <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $value->name ?? '' }}">
                        @endif
                    <p>{{ $value->name ?? '' }}</p>
                  </div>
              @endif
            @endforeach
          @endif
   
        <h6 class="text-primary text-start">Comittee Members</h6>
          @if($committee_member)
              @foreach($committee_member as $value)
                @if($value->role==2)
                    <div class="d-flex flex-row  mb-3">
                          @if(!empty($value->avatar)) 
                          <img src="{{ asset('uploads/'.$value->avatar) }}" class="rounded-circle" alt="{{ $value->name ?? '' }}">
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
  
   
