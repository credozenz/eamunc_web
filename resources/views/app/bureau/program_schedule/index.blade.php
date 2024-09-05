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
        <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United Nations Conference </h5>
      </div>
    </div>

    <div class="col-md-12">

            <h5 class="text-primary mt-5 mb-3">Program Schedule</h5>
            <p style="color: #4D4D4D; font-size: 14px;">The committee specific schedule is given below. Please contact your bureau members for any clarifications </p>

    </div>
    
    <div class="col-md-8">

        @if (!empty($program_schedule) && $program_schedule->count())
            @foreach ($program_schedule as $key => $value)         
                <h5 class="fs-5 text-primary mt-4 d-inline-block border border-secondary p-2 rounded">{{ date("d F, Y (l)", strtotime($value['date'])) ?? '' }}</h5>
                <a class="btn-sm shadow-md mr-2 dltButton"  data-url="{{ url('app/program_schedule_delete',$value['id']) }}" data-replaceurl="{{ url('app/bureau_program_schedule') }}" title="Delete Program"><i class="fa fa-trash text-danger" aria-hidden="true" target="_blank"></i></a>
                <div class="blue-box mt-3 mb-3">
                    
                @if (!empty($value['time']) && $program_schedule->count())
                        @foreach ($value['time'] as $key => $time)

                        <div class="row mb-3">
                            <div class="col-md-4 text-center">
                                <p class="d-inline-block border border-white p-2 rounded">{{ date("g:i a", strtotime($time->time_start)) ?? '' }} - {{ date("g:i a", strtotime($time->time_end)) ?? '' ?? ''  }}</p>
                            </div>
                            <div class="col-md-8">
                                <p class="d-inline-block border border-white p-2 rounded" style="width: 100%;">{{ $time->title ?? '' }}</p>
                            </div>
                        </div>
                        
                        @endforeach
                    @endif
                    
                </div>
            @endforeach
        @endif 
     
   
    </div>
    
    <div class="col-md-4"> 
            <a href="{{ url('app/program_schedule_create') }}" class="btn btn-primary shadow-md mr-2"><i class="fa fa-plus" aria-hidden="true"></i>  Create Program Schedule</a>    
    </div>

      
    </div>
</div>
@endsection
