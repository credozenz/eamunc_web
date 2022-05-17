@extends('app.bureau.layouts.layout')
@section('content')
   
      <div class="container-fluid dasboard add-speaker-page">
    
       
  <div class="row">
    <div class="col-md-8">
    
     <h5 class="text-primary mt-5 mb-3">Add Speaker’s List</h5>
     <p style="color: #4D4D4D; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
     
    <form method="post" action="{{ url('app/bureau_speaker_store') }}" class="mt-5 col-md-8"  enctype="multipart/form-data">
            @csrf
    
       <input type="hidden" class="form-control" value="{{ $committee->id }}" id="committe_id" name="committe_id">
       <input type="hidden" class="form-control" value="{{ $speakersCount ?? '0' }}" id="speaker_count" name="speaker_count">
       
      @if(!empty($speakers))
          @foreach($speakers as $skey => $speaker)
            <div class="d-flex  align-items-center mb-4">
              <div class="form-count ">{{ $skey+1 }}</div>
              <div class=" flex-fill ps-5 pe-5">
                <label class="form-label">Enter Counry Name</label>
                <select class="form-control" name="country_id[]" required>
                <option value="">Select Country Name</option>
                  @foreach($committee_member as $key => $value)
                  <option value="{{ $value->country_id }}" {{ ($speaker->country_id == $value->country_id ? "selected":"") }}>{{ $value->country_name }}</option>
                  @endforeach
                </select>
              </div>
              @if($skey+1 > 1)
              <div class="dltspeaker" id="{{ $skey+1 }}"  data-url="{{ url('app/speaker_delete',$speaker->id) }}" data-replaceurl="{{ url('app/bureau_speaker') }}" ><i class="fa Example of check-circle fa-minus-circle text-secondary fs-4"></i></div>
              
              @else
              <div id="add_speaker"><i class="fa Example of check-circle fa-plus-circle text-secondary fs-4"></i></div>
              @endif
            </div>
          @endforeach
      @else

      <div class="d-flex  align-items-center mb-4">
         <div class="form-count ">1</div>
         <div class=" flex-fill ps-5 pe-5">
          <label class="form-label">Enter Counry Name</label>
          <select class="form-control" name="country_id[]" required>
          <option value="">Select Country Name</option>
            @foreach($committee_member as $key => $value)
             <option value="{{ $value->country_id }}">{{ $value->country_name }}</option>
             @endforeach
          </select>
        </div>
         <div id="add_speaker"><i class="fa Example of check-circle fa-plus-circle text-secondary fs-4"></i></div>
       </div>

      @endif

       <div class="speaker_list"></div>

      <button type="submit" class="btn btn-primary float-end">CONFIRM</button>
     
    </form>
     
   
    </div>
       <div class="col-md-4">
        
        <div class="d-flex flex-row  mb-3">
          <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
          <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;">  {{ $committee->title ?? '' }}</h5>
          
          </div>
         
          <!-- <a href="#" class="d-inline-block mt-5 fs-5 fw-lighter text-primary text-decoration-underline">Add More / Remove</a>  
          -->
        
        </div>
      
      </div>
      </div>
    
   
@endsection 
  
   
