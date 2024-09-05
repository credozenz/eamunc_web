@extends('web.layout.main')
@section('content')

@if (!empty($alumni) && $alumni->count())

<section id="regulations" class="section-padding pb-0">
   
    <div class="wrapper">
        <div class="container p-0">
            <div class="box border-black">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">Be a part of the E.A.MUNC Alumni Network</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                    <a href="{{ route('alumni-registration') }}">
                        <button class="download-btn">Register Now</button>
                    </a>
                    </div>
                </div> 
            </div>

        </div>
    </div>
   
</section>
<section id="hero" class="section-padding pt-0">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <h3 class="color-darkblue mb-4">Alumni</h3>

                    <div class="row mt-5">
                    <img src="{{ asset('uploads/'.$alumni->image) ?? '' }}" alt="{{ $alumni->title ?? '' }}">

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">{{ $alumni->title ?? '' }}</h3>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                               {!! $alumni->description ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif
    {{-- @if (!empty($alumni_news) && $alumni_news->count())
    <section id="updates" class="section-padding pb-0">
        <div class="container">
            <h3 class="color-darkblue mb-md-4 mb-5">Alumni in the News</h3>
        </div>
        <div class="bg-black">
            <div class="container">
                <div class="row justify-content-between">
                   
                @foreach ($alumni_news as $key => $value)
                    <div class="col-md-4 image-box fixed-thumb">
                    <a href="{{ route('alumni-news-inner',$value->id ?? '') }}" class="color-white">
                    <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->title ?? '' }}">
                        <p class="update-description color-white">{{ $value->title ?? '' }}</p>
                      </a>
                    </div>
                @endforeach

                </div>
            </div>
        </div>

    </section>
    @endif --}}

{{-- 
    @if (!empty($webinar) && $webinar->count())
    <section id="updates" class="section-padding pb-0">

        <div class="container">
            <h3 class="color-darkblue mb-md-4 mb-5">Alumni Webinars</h3>
        </div>

        <div class="bg-black">
          <div class="container box">
            <div class="row multi-message-box">

            @foreach ($webinar as $key => $value)

                 <div class="col-md-4 col-sm-5 content-box">
                    <div class="image-box">
                    <div class="btm-img videoWrapper">
                    <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->title ?? '' }}">
                         <div class="overlay-thumbnail">
                            <span onclick="document.getElementById('modal'+{{$key}}).style.display='block'"><i class="fa fa-play"></i></span>
                        </div>
                    </div>
                    <p class="update-description color-white">{{ $value->title }}</p>
                    </div>
                </div>

                <div id="modal{{$key}}" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="videoPopup({{$key}})" class="w3-button w3-display-topright">×</span>
                            <iframe id="iframe1" width="100%" height="400" src="https://www.youtube.com/embed/{{ $value->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="">
                            </iframe>
                        </div>
                    </div>
                </div>

            @endforeach




            </div>    
          </div>
        </div>

    </section>
    @endif --}}
    
   
   
    @endsection