@extends('app.bureau.layouts.layout')
@section('content')
   
<div class="container-fluid dasboard add-speaker-page">
    
       
        <div class="row">
       
       <div class="col-md-4 offset-md-8">
        
        <div class="d-flex flex-row  mb-3">
          <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
          <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;">  {{ $committee->title ?? '' }}</h5>
          
          </div>
         
         
         
        
        </div>

        <div class="col-md-6 text-center offset-md-3">
    
          <h5 class="text-primary mt-5 mb-3 fs-2">Line By Line </h5>
          <form method="post" action="{{ url('app/bureau_line_by_line_store') }}" class="mt-5 col-md-12"  enctype="multipart/form-data">
            @csrf
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea id="ckeditor" type="text" name="line" class="form-control @error('line') border-danger @enderror" style="height: 850px;">{{ $line->content ?? old('line') }}</textarea>
                        @error('line')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3"> Submit</button>
          </form>
           
         </div>
      
      </div>
      </div>
   
@endsection 
  
   