@extends('web.layout.main')
@section('content')
         
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <h3 class="color-darkblue mb-4">Act to Impact</h3>

                    <div class="row mt-5">
                    <img src="{{ asset('uploads/'.$impact->image) ?? '' }}" alt="{{ $impact->title ?? '' }}">
                    </div>
                </div>
            </div>
            @if (!empty($impact) && $impact->count())
            <div class="container">
                <div class="letter-container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                                {!! $impact->description ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-6 text-center text-md-end color-darkblue">
                Act to Impact isn't available right Now !
            </div>
            @endif
        </div>
    </section>

              
@endsection
