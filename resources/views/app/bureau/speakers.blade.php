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

      <div class="col-md-12">
      
        <h5 class="text-primary mt-5 mb-3">Add Speaker’s List</h5>
        <p style="color: #4D4D4D; font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
        
        
      </div>
     
      
        
      <div class="col-md-8">    
        
        
       
        <form method="post" action="{{ url('app/bureau_speaker_store') }}" class="mt-5 col-md-8" id="blocspeaker-form"  enctype="multipart/form-data">
                @csrf
        
          <input type="hidden" class="form-control" value="{{ $committee->id }}" id="committe_id" name="committe_id">
          <input type="hidden" class="form-control" value="{{ $speakersCount ?? '0' }}" id="speaker_count" name="speaker_count">
          
          @if(!empty($speakersCount))
              @foreach($speakers as $skey => $speaker)
                <div class="d-flex  align-items-center mb-4">
                  <div class="form-count" style="background: #32e643;">{{ $skey+1 }}</div>
                  <div class=" flex-fill ps-5 pe-5">
                    <label class="form-label">Enter country Name</label>
                    <select class="form-control blocspeaker" name="country_id[]" readonly required>
                    <option value="">Select Country Name</option>
                      @foreach($committee_member as $key => $value)
                      @if($speaker->country_id == $value->country_id)
                      <option value="{{ $value->country_id }}" {{ ($speaker->country_id == $value->country_id ? "selected":"") }}>{{ $value->country_name }}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="dltspeaker" id="{{ $skey+1 }}"  data-url="{{ url('app/speaker_delete',$speaker->id) }}" data-replaceurl="{{ url('app/bureau_speaker') }}" ><i class="fa Example of check-circle fa-minus-circle text-danger fs-4"></i></div>
                  
                </div>
              @endforeach

          @else

          <div class="d-flex  align-items-center mb-4">
            <div class="form-count ">1</div>
            <div class=" flex-fill ps-5 pe-5">
              <label class="form-label">Enter Country Name</label>
              <select class="form-control blocspeaker" name="country_id[]"  required >
              <option value="">Select Country Name</option>
              @if(!empty($committee_member))
                @foreach($committee_member as $key => $value)
                <option value="{{ $value->country_id }}">{{ $value->country_name }}</option>
                @endforeach
              @else
                 <option value="">No delegates in this committee !</option>
              @endif
              </select>
            </div>
            <div><i class="fa Example of check-circle fa-minus-circle fs-4"></i></div>
          </div>

          @endif

          <div class="speaker_list"></div>

          <!-- <button type="submit" class="btn btn-primary float-end">CONFIRM</button> -->
        
        </form>
      
    
      </div>

      <div class="col-md-4">
    
    <button type="button" class="btn btn-primary mt-3" id="add_speaker"><i class="fa fa-plus" aria-hidden="true"></i>  Add Speaker</button>
     
    </div>
      
  </div>

</div>
    
   
@endsection 
  
   
