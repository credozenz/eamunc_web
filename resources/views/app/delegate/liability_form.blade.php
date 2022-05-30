
@extends('app.delegate.layouts.layout')
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

      <div class="col-md-8">
      </div>

      <div class="col-md-4">
        <div class="d-flex flex-row  mb-3">
            @if(!empty($data->file))
                <div class="d-grid">
                   <a href="{{ asset('uploads/'.$data->file) }}" class="btn btn-primary "><i class="fa fa-file-text-o" aria-hidden="true"></i> Downlode Liability Waiver Form</a>
                </div>
            @endif
          </div>
      </div>
            
      <div class="col-md-6 offset-md-3 pt-2">
        <h4 class="dash-main-head mb-3 text-center">Liability Waiver Form</h4>
        <p style="color:#4D4D4D; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
      
      
        @if(empty($student->liability_form))
          <form method="post" id="paper_submit" action="{{ url('app/liability_waiver_form_submit') }}"  enctype="multipart/form-data">
              @csrf
                  
              <div class="file-upload text-center">   
                <div class="image-upload-wrap">
                  <input type="file" class="file-upload-input" name="form" id="paper_submission" onchange="readURL(this);" accept="pdf*/doc*">
                
                  <div class="drag-text">
                    <i class="fa fa-cloud-upload mb-2" style="font-size: 18px;" aria-hidden="true"></i>
                    <h3>Drag and Drop here <br> Or</h3>
                  </div>
                  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Select file</button>
                </div>
                @error('form')<div class="text-danger mt-2">{{ $message }}</div>@enderror
              </div>

          </form>

          @else

          <div class="file-upload text-center">   
              <div class="image-upload-wrap">
              
                <div class="drag-text">
               
               
                <a href="{{ asset('uploads/'.$student->liability_form) }}" >
                <i class="fa fa-file" style="font-size: 18px;" aria-hidden="true"></i>
                  {{ $student->name ?? '' }}  Liability Waiver Form
                </a>
                 
                </div>

              </div>
          </div>

        @endif

      </div>
     
      
    </div>

</div>
     
@endsection 
  