@extends('web.layout.main')
@section('content')

    @if (!empty($banner) && $banner->count())   
        <section id="hero" class="mh-90" style="background-image:url('{{ asset('uploads/'.$banner->image) }}');"></section>
    @endif

    @if (!empty($timer) && $timer->count())
        <section id="counter" class="section-padding">
            <div class="container">
                <div id="clock-c" data-date="{{ $timer->date ?? '' }}" class="countdown color-white"></div>
            </div>
        </section>
    @endif
    
    
        <section id="message" class="section-padding">
            <div class="wrapper">
                <div class="container">

                @if (!empty($president_messages) && $president_messages->count())
                    <h3 class="color-darkblue mb-5">Message from the President</h3>
                    <div class="row box">
                        <div class="col-md-4 col-sm-3 image-box">
                            <img src="{{ asset('uploads/'.$president_messages->image) }}" alt="">
                        </div>
                        <div class="col-md-8 col-sm-9 content-box">
                            <p class="message-text color-white">{{ $president_messages->description ?? '' }}</p>
                            <div class="designation">
                                <p class="message-name color-white">{{ $president_messages->name ?? '' }}</p>
                                <p class="message-designation color-white">{{ $president_messages->post ?? '' }}
                                </p>
                            </div>

                        </div>
                    </div>
                @endif

                @if (!empty($faculties_messages) && $faculties_messages->count())
                    <div class="row multi-message-box">
                    @foreach ($faculties_messages as $key => $value)
                        <div class="col-md-6 col-sm-5 content-box">
                            <p class="message-title color-white">{{ $value->title ?? '' }}</p>
                            <div class="image-box">
                                <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                                <p class="message-name color-white">{{ $value->name ?? '' }}</p>
                                <p class="message-designation color-white">{{ $value->post ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endif


                </div>
            </div>
        </section>
   



    <section id="contact_line" class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-6 col-12 py-3 text-center">
                    <p class="color-white text-center">Contact For Registration</p>
                </div>
                <div class="col-md-4 col-sm-6 col-12 py-3 text-center">
                    <p class="color-white text-center"><i class="fa fa-whatsapp"></i> +968 222 000 00</p>
                </div>
                <div class="col-md-4 col-sm-6 col-12 py-3 text-center">
                    <p class="color-white text-center"><i class="fa fa-envelope-o"></i> info@eamunc.com</p>
                </div>
            </div>
        </div>
    </section>

    @if (!empty($our_mentors) && $our_mentors->count())

        <section id="mentors" class="section-padding">
            <div class="container">
                <h3 class="color-darkblue mb-md-4 mb-5">Our Mentors</h3>
                <div class="row">
                @foreach ($our_mentors as $key => $value)
                    <div class="col-lg-3 col-md-4 col-6 image-box mb-4">
                    <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                        <p class="mentor-name">{{ $value->name ?? '' }}</p>
                        <p class="mentor-designation color-blue">{{ $value->post ?? '' }}</p>
                    </div>
                @endforeach
                </div>

            </div>
        </section>

    @endif

    @if (!empty($conference_update) && $conference_update->count())

        <section id="updates" class="section-padding">
            <div class="container">
                <h3 class="color-darkblue mb-md-4 mb-5">Conference Updates</h3>
            </div>
            <div class="bg-black">
                <div class="container">
                    <div class="row justify-content-between">

                    @foreach ($conference_update as $key => $value)
                        <div class="col-md-4 image-box fixed-thumb">
                        <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->title ?? '' }}">
                            <p class="update-name color-blue">{{ $value->title ?? '' }}</p>
                            <p class="update-description color-white">{{ $value->description ?? '' }}</p>
                        </div>
                    @endforeach

                    </div>
                </div>
            </div>
        </section>

    @endif


    @if (!empty($conference_schedule) && $conference_schedule->count())

        <section id="schedule" class="section-padding">
            <div class="container">

                <h3 class="color-darkblue mb-md-4 mb-5">Conference Schedule</h3>

                @foreach ($conference_schedule as $key => $value)
                <div class="row schedule-card">
                    <div class="col-md-3 text-head">
                        <h6 class="color-blue">{{ $value['title'] ?? '' }}</h6>
                    </div>
                    <div class="col-md-9 info-line">
                        <div class="row text-info">
                            <div class="col-md-6 text-card">
                            @if (!empty($value['time']) && $conference_schedule->count())
                                @foreach ($value['time'] as $key => $time)
                                <div class="text-line color-black">
                                    <p>{{ $time->name ?? '' }}</p>
                                    <p>{{ date("g:i a", strtotime($time->time_start)) ?? '' }} - {{ date("g:i a", strtotime($time->time_end)) ?? '' ?? ''  }}</p>
                                </div>
                                @endforeach
                            @endif
                               
                            </div>
                            <div class="col-md-6 text-center text-card">
                                <h6 class="date-line color-black">{{ date('jS  F l Y',strtotime($value['date'])) ?? '' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="notes">
                    <p class="note">Note 1 : A separate Zoom link will be shared for opening ceremony, committee sessions &
                        valedictory session.</p>
                    <p class="note">Note 2 : 15 minutes break will be given as per the president’s discretion in all
                        commitee sessions.</p>
                </div>

            </div>
        </section>

    @endif
              
@endsection