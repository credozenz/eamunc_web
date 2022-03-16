@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">Past Conferences</h3>

                    @if (!empty($past_conferences) && $past_conferences->count())
                        @foreach ($past_conferences as $key => $value)

                    <div class="row border-black p-0 mb-5">
                        <div class="col-md-6 p-0">
                           <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}" class="h-100" style="max-height:300px;">
                        </div>
                        <div class="col-md-6 py-4 px-5">
                        <a href="{{ route('past-conference-inner',$value->id ?? '') }}" class="color-white">
                            <div class="content h-100 lh-2 d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <h4 class="color-darkblue mb-3 mb-md-0">{{ $value->title ?? '' }}</h4>
                                <button class="download-btn">More Details</button>
                            </div>
                        </div>
                        </a>
                    </div>
                    @endforeach
                    @else
                    <div class="col-md-6 text-center text-md-end color-darkblue">
                    Past Conferences isn't available right Now !
                    </div>
                    @endif
                   


                </div>
            </div>

        </div>
    </section>
    @endsection