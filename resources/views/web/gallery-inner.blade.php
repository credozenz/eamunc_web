@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <div class="mb-4">
                        <h3 class="color-darkblue">Conference</h3>
                    </div>

                @if (!empty($images) && $images->count())
                    <div class="row mt-5">
                    @if (!empty($images) && $images->count())
                        @foreach ($images as $key => $value)

                        @if(!empty($value->image))
                        <div class="col-md-4 image-box mb-5">
                        <img width="40%" height="100%" src="{{ asset('uploads/'.$value->image) ?? '' }}" class="open-img" alt="{{ $value->name ?? '' }}">
                        </div> 
                      
                        @endif
                        @endforeach
                    @endif   
                    </div>

                    <div class="row mt-5">
                    @if (!empty($images) && $images->count())
                        @foreach ($images as $key => $value)
                        @if(!empty($value->video))
                        <div class="col-md-4 image-box mb-5">
                            <div class="form-group video-wrapper">
                                <div class="youtube-thumbnail" data-video="{{ $value->video }}">
                                    <img src="https://img.youtube.com/vi/{{ $value->video }}/0.jpg" alt="YouTube Thumbnail">
                                    <button onclick="document.getElementById('modal'+{{$key+1}}).style.display='block'" >Play Video <i class="fa fa-play"></i></button>
                                </div>
                            </div>
                        </div>
                       

                        <div id="modal{{$key+1}}" class="w3-modal">
                            <div class="w3-modal-content">
                            <div class="w3-container">
                                <span onclick="videoPopup({{$key+1}})" class="w3-button w3-display-topright">&times;</span>
                                <iframe id="iframe{{$key+1}}" width="100%" height="400" src="https://www.youtube-nocookie.com/embed/{{ $value->video ?? '' }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="">
                                </iframe>
                            </div>
                            </div>
                        </div>
                        @endif

                        @endforeach
                    @endif   
                    </div>
                @else
                    <div class="col-md-6 text-center text-md-end color-darkblue">
                        Gallery Images isn't available right Now !
                    </div>
                @endif






                </div>
                @include('web.layout.pagination', ['paginator' => $images])
                <span class="spacer"></span>
            </div>

        </div>
    </section>


    @endsection

<!-- The Modal -->
<div id="myModal" class="modal">
<!-- The Close Button -->
<span class="close">&times;</span>
<!-- Modal Content (The Image) -->
<img class="modal-content" id="img01">
<div class="w3-content" style="max-width:1200px">
 
  <div class="w3-row-padding w3-section">
        @if (!empty($images) && $images->count())
            <div class="row mt-2">
            @if (!empty($images) && $images->count())
                @foreach ($images as $key => $value)
                    @if(!empty($value->image))
                    <div class="col-md-1 mb-2">
                    <img width="100%" height="100%" src="{{ asset('uploads/'.$value->image) ?? '' }}" class="open-img" alt="{{ $value->name ?? '' }}">
                    </div> 
                    @endif
                @endforeach
            @endif   
            </div>
        @endif
  </div>

</div>
<!-- Modal Caption (Image Text) -->
<div id="caption"></div>
</div>
