@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <h3 class="color-darkblue mb-4">Code Of Conduct</h3>

                    <div class="row mt-5">
                        <img src="{{ asset('uploads/'.$virtualcode->image) ?? '' }}" alt="{{ $virtualcode->title ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="letter-container">
                    <div class="row">
                    @if (!empty($virtualcode) && $virtualcode->count())
                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                               {!! $virtualcode->description ?? '' !!}
                            </div>
                        </div>
                    @else
                    <div class="col-md-6 text-center text-md-end color-darkblue">
                        Code Of Conduct isn't available right Now !
                    </div>
                    @endif

                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="regulations" class="section-padding">
    @if (!empty($virtualcode->file))
        <div class="wrapper">
            <div class="container p-0">
                <div class="box border-black">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">Code Of Conduct</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                        <a href="{{ asset('uploads/'.$virtualcode->file) ?? '' }}" target="_blank">
                            <button class="download-btn">Download Now</button>
                        </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        @endif
    </section>


    @endsection