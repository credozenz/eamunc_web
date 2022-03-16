@extends('web.layout.main')
@section('content')

@if (!empty($committees) && $committees->count())

    <section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <h3 class="color-darkblue mb-4">Committees</h3>

                <div class="row">

                @foreach ($committees as $key => $value)
                    <div class="col-12 px-0">
                        <h4 class="color-darkblue mb-4">{{ $value->name ?? '' }}</h4>
                        <div class="row committee-card">
                            <div class="col-md-5 committee-thumb">
                                <img src="{{ asset('uploads/'.$value->image) ?? '' }}" class="commitee-image" alt="{{ $value->name ?? '' }}">
                            </div>
                            <div class="col-md-7">
                                <div class="content p-4">
                                    <strong><a href="{{ route('committees-inner',$value->id ?? '') }}" class="color-white">{{ $value->title ?? '' }}</a></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            
                </div>
                <span class="spacer"></span>
            </div>
        </div>
    </section>

    @endif

    <section id="regulations" class="section-padding pt-0">
        <div class="wrapper">
            <div class="container p-0">
                <div class="box border-black">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">Be a part of the EAMUNC Alumni Network</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                        <a href="{{ route('registration') }}">
                             <button class="download-btn">Register Now</button>
                        </a>
                            
                        </div>

                    </div>
                </div>
            </div>
            <span class="spacer"></span>

        </div>
    </section>


    @endsection