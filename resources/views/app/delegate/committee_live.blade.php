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

      <div class="col-md-12">
        <h4 class="fs-3 text-primary mb-3 mt-5">Committee Live Stream</h4>
        <p style="color:#4D4D4D; font-size: 15px;">All committee sessions at our conference will be streamed live on 
our website. This live streaming feature reflects our commitment to 
transparency and inclusivity, ensuring that our conference is accessible to a global audience. </p>    
      </div>

      
      <br>
      


      <div class="row mt-5">
                    @if (!empty($committee_lives) && $committee_lives->count())
                        @foreach ($committee_lives as $key => $value)
                        @if(!empty($value->video))
                        <div class="col-md-4 image-box mb-5">
                            <div class="form-group video-wrapper">
                                <div class="youtube-thumbnail" data-video="{{ $value->video }}">
                                    <img src="https://img.youtube.com/vi/{{ $value->video }}/0.jpg" alt="YouTube Thumbnail">
                                    <button onclick="document.getElementById('modal'+{{$key+1}}).style.display='block'" class="btn-sm btn-success shadow-md mr-2">Play <i class="fa fa-play"></i></button>
                                   
                                  </div>
                            </div>
                            
                        </div>
                       

                        <div id="modal{{$key+1}}" class="w3-modal">
                            <div class="w3-modal-content">
                            <div class="w3-container">
                                <span onclick="closePopup({{$key+1}})" class="w3-button w3-display-topright">&times;</span>
                                <iframe id="iframe{{$key+1}}" width="100%" height="400" src="https://www.youtube-nocookie.com/embed/{{ $value->video ?? '' }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="">
                                </iframe>
                            </div>
                            </div>
                        </div>
                        
                        @endif

                        @endforeach
                        @else
                        <div class="col-12 px-0">
                          <div class="col-md-8 mt-5 text-center text-md-end color-darkblue">
                            Live Streaming isn't available right Now !
                          </div>
                        </div>
                        @endif   
                    </div>
               






                </div>



     
    </div>

  </div>
   
<script>
  function closePopup(id) {
    document.getElementById("modal"+id).style.display='none';
    $("#iframe"+id).attr('src','');
    location.reload();
  }
</script>

@endsection 
  
   
