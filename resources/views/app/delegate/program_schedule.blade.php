@extends('app.delegate.layouts.layout')
@section('content')


<div class="container-fluid dasboard add-speaker-page">  
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
    
             <h5 class="text-primary mt-5 mb-3">Program Schedule</h5>
             <p style="color: #4D4D4D; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
    

                @if (!empty($program_schedule) && $program_schedule->count())
                    @foreach ($program_schedule as $key => $value)         
                        <h5 class="fs-5 text-primary mt-4 d-inline-block border border-secondary p-2 rounded">{{ date("d F, Y (l)", strtotime($value['date'])) ?? '' }}</h5>
                        <div class="blue-box mt-3">
                            
                        @if (!empty($value['time']) && $program_schedule->count())
                                @foreach ($value['time'] as $key => $time)

                                <div class="row mb-3">
                                    <div class="col-md-4 text-center">
                                        <p class="d-inline-block border border-white p-2 rounded">{{ date("g:i a", strtotime($time->time_start)) ?? '' }} - {{ date("g:i a", strtotime($time->time_end)) ?? '' ?? ''  }}</p>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="d-inline-block border border-white p-2 rounded" style="width: 90%;">{{ $time->title ?? '' }}</p>
                                    </div>
                                </div>
                               
                                @endforeach
                            @endif
                            
                        </div>
                    @endforeach
                @endif 
     
   
        </div>

      
    </div>
</div>
@endsection
