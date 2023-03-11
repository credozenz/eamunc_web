@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">Host Educational Institiutions</h3>

                    @if (!empty($schools) && $schools->count())
                        @foreach ($schools as $key => $value)

                    <div class="row p-0 mb-5">
                        <div class="col-md-2 p-0">
                            <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="" class="h-100 fit-contain" style="max-height:300px;">
                        </div>
                        <div class="col-md-9 p-0 p-md-5">
                            <div class="content h-100 lh-2">
                                <h4 class="text-start color-darkblue mb-3">{{ $value->name ?? '' }}</h4>
                                <div class="content border-black lh-2">
                                    <p>
                                    {{ $value->description ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @else
                    <div class="col-md-6 text-center text-md-end color-darkblue">
                    Host Educational Institiutions isn't available right Now !
                    </div>
                    @endif
                    

                </div>
            </div>

        </div>
    </section>

    <!-- <section id="regulations" class="section-padding pt-0">
        <div class="wrapper">
            <div class="container p-0">
                <div class="box border-black">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">Be a part of the E.A.MUNC Alumni Network</p>
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
    </section> -->

    @endsection