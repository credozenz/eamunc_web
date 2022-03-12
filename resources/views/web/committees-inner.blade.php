@extends('web.layout.main')
@section('content')


@if (!empty($committees) && $committees->count())
    <section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <div class="mb-4">
                        <h3 class="color-darkblue">{{ $committees->title ?? '' }}</h3>
                        <p class="subnote"><strong>AGENDA : </strong>{{ $committees->agenda ?? '' }} </p>
                    </div>
                    <span class="spacer"></span>

                    @if (!empty($members) && $members->count())
                    <div class="row mt-5">
                        <div class="col-12">
                            <h4 class="color-darkblue mb-4">Bureau Members</h4>
                        </div>

                        @foreach ($members as $key => $value)

                        <div class="col-lg-3 col-md-4 col-6 image-box mb-4">
                        <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                            <p class="mentor-name text-center">{{ $value->name ?? '' }}</p>
                            <p class="mentor-designation text-center color-blue">{{ $value->post ?? '' }}</p>
                        </div>

                        @endforeach

                    </div>
                    @endif


                </div>
            </div>

            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">{{ $committees->sub_title ?? '' }}</h3>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                                 {{ $committees->description ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="mentors" class="section-padding">
        <div class="container">
            <h3 class="color-darkblue mb-md-4 mb-5">Committee Webinar</h3>
            <div class="row">

                <div class="col-12 px-0">
                    <iframe width="100%" height="800" src="https://www.youtube-nocookie.com/embed/{{ $committees->video ?? '' }}" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>

            </div>
        </div>
    </section>
    @if (!empty($committees->file))
    <section id="regulations" class="section-padding">
        <div class="wrapper">
            <div class="container p-0">
                <div class="box border-black">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">{{ $committees->name ?? '' }} Background Guide</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                        <a href="{{ asset('uploads/'.$committees->file) ?? '' }}" target="_blank">
                            <button class="download-btn">Download Now</button>
                        </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif
@endif

    @endsection