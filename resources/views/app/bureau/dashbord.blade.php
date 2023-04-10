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
        <a href="{{ url('') }}" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
        <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United Nations Conference </h5>
      </div>
    </div>


    <div class="col-md-8">
     

     <div class="row">
      <div class="col-md-3 text-center">
        <a class="dasboard-menu" href="{{ route('app.bureau_dashbord') }}">
          <div class="icon-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z"></path>
            <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z"></path>
          </svg> 
          </div>
         <p> Dashboard</p>
        </a>  
      </div>

      <div class="col-md-3 text-center">
        <a class="dasboard-menu" href="{{ route('app.bureau_general_papers') }}">
          <div class="icon-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
              <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"></path>
            </svg>
          </div>
         <p> General Papers</p>
        </a>  
      </div>

      <div class="col-md-3 text-center">
        <a class="dasboard-menu" href="{{ route('app.bureau_bloc_formation') }}">
          <div class="icon-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
              <path d="M0 0h16v16H0V0zm1 1v6.5h6.5V1H1zm7.5 0v6.5H15V1H8.5zM15 8.5H8.5V15H15V8.5zM7.5 15V8.5H1V15h6.5z"></path>
            </svg>
          </div>
         <p> Bloc Formation</p>
        </a>  
      </div>

      <div class="col-md-3 text-center">
        <a class="dasboard-menu" href="{{ route('app.bureau_vienna_formula') }}">
          <div class="icon-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
              <path d="M5.68 5.792 7.345 7.75 5.681 9.708a2.75 2.75 0 1 1 0-3.916ZM8 6.978 6.416 5.113l-.014-.015a3.75 3.75 0 1 0 0 5.304l.014-.015L8 8.522l1.584 1.865.014.015a3.75 3.75 0 1 0 0-5.304l-.014.015L8 6.978Zm.656.772 1.663-1.958a2.75 2.75 0 1 1 0 3.916L8.656 7.75Z"></path>
            </svg> 
          </div>
         <p> Vienna Formula</p>
        </a>  
      </div>

      <div class="col-md-3 text-center">
        <a class="dasboard-menu" href="{{ route('app.bureau_line_by_line') }}">
          <div class="icon-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
            </svg>
          </div>
         <p>  Line by Line</p>
        </a>  
      </div>

      <div class="col-md-3 text-center">
        <a class="dasboard-menu" href="{{ route('app.bureau_resolution') }}">
          <div class="icon-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
              <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"></path>
              <path d="M2 4.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H3v2.5a.5.5 0 0 1-1 0v-3zm12 7a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H13V8.5a.5.5 0 0 1 1 0v3z"></path>
            </svg>
          </div>
         <p>  Resolution</p>
        </a>  
      </div>

      <div class="col-md-3 text-center">
        <a class="dasboard-menu" href="{{ route('app.bureau_general_assembly') }}">
          <div class="icon-bg">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"></path>
              <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"></path>
            </svg>
          </div>
         <p> General Assembly</p>
        </a>  
      </div>
     </div>

    
     <!-- <button type="button" class="btn btn-primary "><i class="fa fa-calendar-o" aria-hidden="true"></i> View Program Schedule</button>
     <button type="button" class="btn btn-primary ms-3"><i class="fa fa-calendar-o" aria-hidden="true"></i> View Speakers List</button><br/>
    <a href="#" class="d-inline-block mt-5 fs-6 fw-bold text-primary text-decoration-underline" >View Program Resources</a>   -->
    </div>

    <div class="col-md-4">
        
      <div class="commitee-box disable-scrollbars" style="max-height: 600px;">
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
                    <p>{{ str_limit($value->name ?? '', $limit = 12, $end = '...') }}</p>
                  </div>
              @endif
            @endforeach
          @endif
   
        <h6 class="text-primary text-start">Delegate Members</h6>
          @if($committee_member)
              @foreach($committee_member as $value)
                @if($value->role==2)
                    <div class="d-flex flex-row  mb-3">
                          @if(!empty($value->avatar)) 
                          <img src="{{ asset('uploads/'.$value->avatar) }}" class="rounded-circle" alt="{{ $value->name ?? '' }}">
                          @else
                          <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $value->name ?? '' }}">
                          @endif
                      <p>{{ str_limit($value->name ?? '', $limit = 12, $end = '...') }}</p>
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
  
   
