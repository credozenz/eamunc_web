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
          <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
          <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United Nations Conference </h5>
        </div>
      </div>
            
      <div class="col-md-6 offset-md-3 pt-2">
        <h4 class="dash-main-head mb-3 text-center">Paper Submission</h4>
        <p style="color:#4D4D4D; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
      
      
        @if(empty($paper))
          <form method="post" id="paper_submit" action="{{ url('app/delegate_paper_submit') }}"  enctype="multipart/form-data">
              @csrf
                  
              <div class="file-upload text-center">   
                <div class="image-upload-wrap">
                  <input type="file" class="file-upload-input" name="paper" id="paper_submission" onchange="readURL(this);" accept="pdf*/doc*">
                
                  <div class="drag-text">
                    <i class="fa fa-cloud-upload mb-2" style="font-size: 18px;" aria-hidden="true"></i>
                    <h3>Drag and Drop here <br> Or</h3>
                  </div>
                  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Select file</button>
                </div>
                @error('paper')<div class="text-danger mt-2">{{ $message }}</div>@enderror
              </div>

          </form>

          @else

          <div class="file-upload text-center">   
              <div class="image-upload-wrap">
              
                <div class="drag-text">
                <i class="fa fa-file" style="font-size: 18px;" aria-hidden="true"></i>
                  <h3> {{ $paper->paper_name ?? '' }} </h3>
                </div>

              </div>
          </div>

        @endif

      </div>
     
      
    </div>

</div>
     
@endsection 
  
   
