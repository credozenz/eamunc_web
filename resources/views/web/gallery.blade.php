@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <div class="mb-4">
                        <h3 class="color-darkblue">Gallery</h3>
                    </div>

                    <div class="row mt-5">
                    @if (!empty($gallery) && $gallery->count())
                        @foreach ($gallery as $key => $value)
                        <a href="{{ route('gallery-inner',$value->id ?? '') }}" class="color-white">
                        <div class="col-lg-3 col-md-4 col-6 image-box mb-4 mb-5">
                        <img src="{{ asset('uploads/'.$value->cover_image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                            <p class="mentor-name text-start">{{ $value->name ?? '' }}</p>
                        </div>
                        </a>
                        @endforeach
                    @else
                    <div class="col-md-6 text-center text-md-end color-darkblue">
                       Gallerys isn't available right Now !
                    </div>
                    @endif

                    </div>

                </div>

                <span class="spacer"></span>
            </div>

        </div>
    </section>


    @endsection