@extends('web.layout.main')
@section('content')
@if (!empty($alumni_news))
    <section id="hero" class="section-padding">
        <div class="wrapper">

       
            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">{{ ucfirst(trans($alumni_news->title)) ?? '' }}</h3>

                    <div class="row border-black ">
                        <div class="col-md-4 image-box fixed-thumb">
                          
                               <img src="{{ asset('uploads/'.$alumni_news->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                           
                        </div>
                        <div class="col-md-8">
                            <div class="content lh-2">
                            {{ $alumni_news->description ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       

        </div>
    </section>
@endif

              
@endsection
