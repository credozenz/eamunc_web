@extends('web.layout.main')
@section('content')


@if (!empty($letter) && $letter->count())
    <section id="hero" class="section-padding">
        <div class="wrapper">

        @foreach ($letter as $key => $value)
            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">{{ $value->title ?? '' }}</h3>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="vision-thumb">
                               <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                            </div>
                            <div class="head-container mb-4">
                                <p class="mentor-name text-center">{{ $value->name ?? '' }}</p>
                                <p class="mentor-designation text-center color-blue  text-center">{{ $value->post ?? '' }}</p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="content border-black lh-2">
                            {{ $value->description ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach  

        </div>
    </section>
@endif


@if (!empty($work_members) && $work_members->count())
    <section id="mentors" class="section-padding">
        <div class="container">
            <h3 class="color-darkblue mb-md-4 mb-5">Working Comittee Members</h3>
            <div class="row">
            @foreach ($work_members as $key => $value)

                <div class="col-lg-3 col-md-4 col-6 image-box mb-4">
                    <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                    <p class="mentor-name text-center">{{ $value->name ?? '' }}</p>
                    <p class="mentor-designation text-center color-blue  text-center">{{ $value->post ?? '' }}</p>
                </div>
            @endforeach  
               
            </div>
        </div>
    </section>
@endif

@if (!empty($important_date) && $important_date->count())
    <section id="dates" class="section-padding">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="color-darkblue mb-md-4 mb-5">Important Dates</h3>
                <a href="#" class="button register-btn">Register Now</a>
            </div>

            <div class="row dates-container">

            @foreach ($important_date as $key => $value)
                <div class="col-md-6 mb-3">
                    <p> <strong class="me-2">{{ date('jS  F l Y',strtotime($value->date)) ?? '' }}:</strong>{{ $value->title ?? '' }}</p>
                </div>
            @endforeach  
               
            </div>
        </div>
    </section>
@endif

@if (!empty($rules) && $rules->count())
    <section id="regulations" class="section-padding">
        <div class="wrapper">
            <div class="container p-0">
                <h3 class="color-darkblue mb-md-4 mb-5">Rules And Regulations</h3>
                <div class="box border-black">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">{{ $rules->title ?? '' }}</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                        <a href="{{ asset('uploads/'.$rules->file) ?? '' }}" target="_blank">
                            <button class="download-btn">Download Now</button>
                        </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endif


    @endsection