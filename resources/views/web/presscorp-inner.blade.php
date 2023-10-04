@extends('web.layout.main')
@section('content')


@if (!empty($press_corp) && $press_corp->count())
    <section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                       <div class="row committee-card" style="background: white;">
                            <div class="col-md-5 committee-thumb" style="background: blue;">
                                <img src="{{ asset('uploads/'.$press_corp->image) ?? '' }}" class="commitee-image" alt="{{ $press_corp->name ?? '' }}">
                            </div>

                            <div class="col-md-7">
                                <div class="content p-4">
                                    <strong><h4 style="color: #2763AB;">{{ $press_corp->title ?? '' }}</h4></strong>
                                </div>
                            </div>
                           
                        </div>
                   
                    <span class="spacer"></span>

                    @if (!empty($press_corp_members) && $press_corp_members->count())
                    <div class="row mt-5">
                        <div class="col-12">
                            <h4 class="color-darkblue mb-4">Members</h4>
                        </div>

                        @foreach ($press_corp_members as $key => $value)

                        <div class="col-lg-3 col-md-4 col-6 image-box mb-4">
                              @if(!empty($value->image)) 
                              <img src="{{ asset('uploads/'.$value->image) ?? '' }}" style ="min-height: 93%;" alt="{{ $value->name ?? '' }}">
                              @else
                              <img class="w-100 active" src="{{ asset('assets/img/avatar.svg') }}" style ="min-height: 93%;" data-bs-slide-to="0">
                              @endif
                       
                            <p class="mentor-name text-center">{{ $value->name ?? '' }}</p>
                        </div>

                        @endforeach

                    </div>
                    @endif


                </div>
            </div>

            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">{{ $press_corp->post ?? '' }}</h3>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                                 {!! $press_corp->description ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

   



   







@endif

    @endsection