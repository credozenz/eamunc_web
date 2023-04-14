@extends('web.layout.main')
@section('content')

@if (!empty($committees) && $committees->count())

<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <h3 class="color-darkblue mb-4">Committees</h3>

                <div class="row">
                @foreach ($committees as $key => $value)
                    <div class="col-md-3 mb-4">
                       <div class="card">
                           <div class="card-body text-center">
                           <a href="/app/signin/{{$value->id ?? '' }}" > <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}" class="commitee-image"></a>
                            <a href="/app/signin/{{$value->id ?? '' }}" style="margin-top: 20px; display: block; color: #000;">{{ $value->name ?? '' }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                @include('web.layout.pagination', ['paginator' => $committees])
                <span class="spacer"></span>
            </div>
        </div>
    </section>

    @endif


    @endsection