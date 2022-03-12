@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <div class="mb-4">
                        <h3 class="color-darkblue">Conference</h3>
                    </div>

                    <div class="row mt-5">

                    @if (!empty($images) && $images->count())
                        @foreach ($images as $key => $value)

                        <div class="col-md-6 image-box mb-5">
                        <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                        </div>
                        @endforeach
                    @else
                    <div class="col-md-6 text-center text-md-end color-darkblue">
                       Gallery Images isn't available right Now !
                    </div>
                    @endif
                       

                    </div>
                </div>

                <span class="spacer"></span>
            </div>

        </div>
    </section>


    @endsection