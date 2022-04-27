@extends('web.layout.main')
@section('content')

@if (!empty($alumni) && $alumni->count())
<section id="hero" class="section-padding">
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
                               {{ $alumni->description ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif
    @if (!empty($alumni_news) && $alumni_news->count())
    <section id="updates" class="section-padding pb-0">
        <div class="container">
            <h3 class="color-darkblue mb-md-4 mb-5">Alumni in the News</h3>
        </div>
        <div class="bg-black">
            <div class="container">
                <div class="row justify-content-between">
                   
                @foreach ($alumni_news as $key => $value)
                    <div class="col-md-4 image-box fixed-thumb">
                    <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->title ?? '' }}">
                        <p class="update-description color-white">{{ $value->description ?? '' }}</p>
                    </div>
                @endforeach

                </div>
            </div>
        </div>

    </section>
    @endif
    
    <section id="regulations" class="section-padding">
   
        <div class="wrapper">
            <div class="container p-0">
                <div class="box border-black">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">Be a part of the E.A.MUNC Alumni Network</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                        <a href="#">
                            <button class="download-btn">Register Now</button>
                        </a>
                        </div>


                    </div>
                </div>

            </div>
        </div>
       
    </section>
   
    @endsection