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

        <h5 class="text-primary mt-5 mb-3 fs-2">Line By Line </h5>
        <p class="fs-6">Once the draft resolution has been tabled/approved by the Bureau, it may be circulated around the committee or displayed for all delegates. Following this would be a line by line review of the draft resolution. Delegates can utilize this opportunity to make amendments. Changes by the committee as a whole are called amendments and each draft amendment must be formally proposed (i.e. tabled) to the conference. A proposed amendment can add a paragraph, delete a paragraph or modify an existing paragraph. The delegate making an amendment must support his/her claim with reasoning.</p>
        @if(empty($line))
        <a href="{{ url('app/bureau_line_by_line_editor') }}" type="button" class="btn btn-primary mt-3"> Start Session</a>
        @else
        <a href="{{ url('app/bureau_line_by_line_editor') }}" type="button" class="btn btn-primary mt-3">View Line By Line</a>
        @endif
       
      </div>
      
  </div>

</div>
   
@endsection 
  
   
