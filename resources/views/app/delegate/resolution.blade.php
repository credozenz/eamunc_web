  
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
            <a href="{{ url('') }}" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
            <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United Nations Conference </h5>
          </div>
        </div>
      
        <div class="col-md-12 text-center">
    
          <h5 class="text-primary mt-5 mb-3 fs-2">Resolution Corner</h5>
          <label class="form-label text-dark">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
          </label>
                <div class="col-md-12 col-12">
                    <div class="form-group">
                       
                     @if(!empty($resolution->content))
                        <textarea id="view_editor" > {!! $resolution->content ?? '' !!}</textarea>
                     @else
                     <div class="blue-box mt-3">
                                <h4>Please wait !</h4>
                         <p class="mt-2 mb-3">This session has not started !</p>
                     </div>
                     @endif
                    </div>
                    @if($accepted==true)
                    <form method="post" action="{{ url('app/delegate_resolution_accept') }}" class="mt-5 col-md-12"  enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-3"> Accept</button>
                    </form>
                    @else

                    <button type="submit" class="btn btn-success mt-3"> <i class="fa fa-check-square-o" aria-hidden="true"></i> Accepted </button>
                    @endif
                </div>
                 
        </div>
      
    </div>

</div>
   
   
@endsection 
  
   

