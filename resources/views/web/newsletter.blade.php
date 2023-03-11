@extends('web.layout.main')
@section('content')

<section id="hero" class="section-padding pb-0">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">Consensus Chronicles</h3>


                    @if (!empty($newsletter) && $newsletter->count())
                                    @foreach ($newsletter as $key => $value)    

                    <div class="row border-black p-0 mb-5">
                        <div class="col-md-6 p-0">
                            <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}" class="h-100" style="max-height:300px;">
                        </div>

                        <div class="col-md-6 py-4 px-5">
                            <div class="content h-100 lh-2 d-flex flex-column justify-content-between align-items-start">
                                <h4 class="color-darkblue mb-3 mb-md-0">{{ $value->title ?? '' }} </h4>
                                <a href="{{ asset('uploads/'.$value->file) ?? '' }}" target="_blank">
                                    <button class="download-btn">Download Now</button>
                               </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                                @else
                                <div class="col-md-6 text-center text-md-end color-darkblue">
                                Consensus Chronicles isn't available right Now !
                                </div>
                                @endif
                  


                </div>
            </div>
            <span class="spacer"></span>
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