@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">

        @if (!empty($past_conferences) && $past_conferences->count())

            <div class="container">
                <div class="letter-container">
                    <h3 class="color-darkblue mb-4">{{ $past_conferences->title ?? '' }}</h3>

                    <div class="row mt-5">
                        <img src="{{ asset('uploads/'.$past_conferences->image) ?? '' }}" alt="{{ $past_conferences->name ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="letter-container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                               {{ $past_conferences->description ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif

        </div>
    </section>

    <section id="updates" class="section-padding pb-0">
        <div class="container">
            <h3 class="color-darkblue mb-md-4 mb-5">E.A.MUNC In Action</h3>
        </div>
        <div class="container">
            <div class="row justify-content-between">
            @if (!empty($images) && $images->count())
                        @foreach ($images as $key => $value)

                <div class="col-md-4 image-box mb-3 fixed-thumb">
                <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                </div>
                @endforeach
            @else
            <div class="col-md-6 text-center text-md-end color-darkblue">
            E.A.MUNC In Action isn't available right Now !
            </div>
            @endif
               

            </div>
            @include('web.layout.pagination', ['paginator' => $images])
        </div>

    </section>

    @if (!empty($past_conferences->file))
    <section id="regulations" class="section-padding">
        <div class="wrapper">
            <div class="container p-0">
                <div class="box border-black">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">Resolutions of E.A.MUNC 2022</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                        <a href="{{ asset('uploads/'.$past_conferences->file) ?? '' }}" target="_blank">
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