@extends('web.layout.main')
@section('content')

<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <h3 class="color-darkblue mb-4">🔴 Watch E.A.MUNC Live</h3>

                <div class="row pt-5">

                    <div class="col-12 px-0">
                    @if (!empty($live) && $live->count())
                        <iframe width="100%" height="800"
                            src="https://www.youtube-nocookie.com/embed/{{ $live->video ?? '' }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    @else
                    <div class="col-md-6 text-center text-md-end color-darkblue">
                       Live Streaming isn't available right Now !
                    </div>
                    @endif
                    </div>

                </div>
                <span class="spacer"></span>
            </div>
        </div>
    </section>
    @endsection