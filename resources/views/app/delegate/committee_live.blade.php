@extends('app.bureau.layouts.layout')
@section('content')
   
  <div class="container-fluid dasboard">
        <!-- Breadcrumbs-->
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

      <div class="col-md-12">
        <h4 class="fs-3 text-primary mb-3 mt-5">Committee Live Stream</h4>
        <p style="color:#4D4D4D; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>    
      </div>

      
      <br>
      <div class="row mt-6 mb-3">

      <div class="col-12 px-0 mt-5">
      @if (!empty($committee->live_url))
          <iframe width="100%" height="800"
              src="https://www.youtube-nocookie.com/embed/{{ $committee->live_url ?? '' }}"
              title="YouTube video player" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
          </iframe>
      @else
      <div class="col-md-6 mt-5 text-center text-md-end color-darkblue">
        Live Streaming isn't available right Now !
      </div>
      @endif
      </div>

       
      
      </div>
     
    </div>

  </div>
   


@endsection 
  
   
