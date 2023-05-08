@extends('web.layout.main')
@section('content')
        

    @if (!empty($vision) && $vision->count())
        <section id="hero" class="section-padding">
            <div class="wrapper">
                <div class="container">
                    <h3 class="color-darkblue mb-4">The Vision</h3>

                    <div class="row border-blue align-items-center">
                        <div class="col-md-3">
                            <div class="vision-thumb p-3">
                                <img src="{{ asset('uploads/'.$vision->image) ?? '' }}" alt="{{ $vision->name ?? '' }}" class="vision-image">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="content">
                                {!! $vision->description ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    @endif

    @if (!empty($mission) && $mission->count())
        <section id="hero" class="section-padding">
            <div class="wrapper">
                <div class="container">
                    <h3 class="color-darkblue mb-4">The Mission</h3>

                    <div class="row border-blue align-items-center">
                        <div class="col-md-3">
                            <div class="vision-thumb p-3">
                                <img src="{{ asset('uploads/'.$mission->image) ?? '' }}" alt="{{ $mission->name ?? '' }}" class="vision-image">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="content">
                                {!! $mission->description ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    @endif



    @if (!empty($our_mentors) && $our_mentors->count())

    <section id="mentors" class="section-padding">
        <div class="container">
            <h3 class="color-darkblue mb-lg-5 mb-4">Our Mentors</h3>

            @foreach ($our_mentors as $key => $value)
            <div class="row">
                <div class="col-lg-3 col-md-4 image-box mb-4 mb-0">
                    <div class="content p-4">
                        <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="content p-4">
                        <p class="mentor-name color-darkblue h4 text-start mt-0">{{ $value->name ?? '' }}</p>
                        <p class="mentor-description lh-2">
                            {!! $value->description ?? '' !!}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </section>

    @endif

@endsection
