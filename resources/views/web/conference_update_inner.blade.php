@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <h3 class="color-darkblue mb-4">{{ $conference_update->title ?? '' }}</h3>

                    <div class="row mt-5">
                        <img src="{{ asset('uploads/'.$conference_update->image) ?? '' }}" alt="{{ $conference_update->title ?? '' }}" >
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="letter-container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                            {!! $conference_update->description ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endsection