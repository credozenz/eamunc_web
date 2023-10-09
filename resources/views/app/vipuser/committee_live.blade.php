@extends('app.vipuser.layouts.layout')
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
        <p style="color:#4D4D4D; font-size: 15px;">All committee sessions at our conference will be streamed live on 
our website. This live streaming feature reflects our commitment to 
transparency and inclusivity, ensuring that our conference is acces-
sible to a global audience.</p>    
      </div>

      <div class="col-md-10"> </div>
      <div class="col-md-2 mb-3">
         </div>
      
      <div class="row mt-6 mb-3">

     
      <div class="col-12 px-0">
      @if (!empty($committee->live_url))
          <iframe width="100%" height="800"
              src="https://www.youtube-nocookie.com/embed/{{ $committee->live_url ?? '' }}"
              title="YouTube video player" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen>
          </iframe>
      @else
      <div class="col-md-6 text-center text-md-end color-darkblue">
        Live Streaming isn't available right Now !
      </div>
      @endif
      </div>

      
       
      
      </div>
     
    </div>

  </div>
   



  <!-- Button trigger modal -->
    <div class="blue block">
       <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Live Stream URL</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" action="{{ url('app/bureau_live_update',$committee->id) }}"  enctype="multipart/form-data">
                        @csrf
                
                    <div class="modal-body">
                          
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Youtube URL:</label>
                            <input type="text" class="form-control" name="live_url" id="recipient-name" value="https://www.youtube.com/watch?v={{$committee->live_url ?? '' }}" maxlength="55" required>
                          </div>
                          <div class="form-group">
                            
                            <div >
                              
                            </div>
                          </div>
                      
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary close">Close</button>
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                  </form>
                </div>  
            </div>
        </div>
    </div>
  
@endsection 
  
   
