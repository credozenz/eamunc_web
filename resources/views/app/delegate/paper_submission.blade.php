@extends('app.delegate.layouts.layout')
@section('content')

      <div class="container-fluid dasboard">
        <!-- Breadcrumbs-->
        
      
       
       
        <div class="row">
          <div class="col-md-4 offset-md-8">
            <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;">  E.Ahamed Model
              United Nations Conference</h5>
            </div>
            
       <div class="col-md-6 offset-md-3 pt-2">
     <h4 class="dash-main-head mb-3 text-center">Paper Submission</h4>
     
     <p style="color:#4D4D4D; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>
   
     
     <div class="file-upload text-center">
     
    
      <div class="image-upload-wrap">
        <input class="file-upload-input" type="file" onchange="readURL(this);" accept="image/*">
        <div class="drag-text">
          <i class="fa fa-cloud-upload mb-2" style="font-size: 18px;" aria-hidden="true"></i>
          <h3>Drag and Drop here <br> Or</h3>
        </div>
        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Select file</button>
      </div>
      <div class="file-upload-content">
        <img class="file-upload-image" src="#" alt="your image">
        <div class="image-title-wrap">
          <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
        </div>
      </div>
    </div>
    
     
    </div>
     
      
      </div>
      </div>
     
     

   
@endsection 
  
   
