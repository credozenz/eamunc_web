@extends('app.vipuser.layouts.layout')
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
     
     <p style="color:#4D4D4D; font-size: 15px;">Delegates have to  ensure that their position paper adheres
to these specifications to maintain consistency and read-
ability throughout the conference.<br>
1. Font size-12<br>
2. Font style-Times New Roman <br>
3. Position paper-1 Page length <br>
Additionally, delegates have to include the bibliography at 
the end of your position paper to provide proper attribution
for their research sources.</p>
   
     
     <div class="file-upload text-center">
     
    
      <div class="image-upload-wrap">
        <input class="file-upload-input" type="file" onchange="readURL(this);" accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
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
  
   
