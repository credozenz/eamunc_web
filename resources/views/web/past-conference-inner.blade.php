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
                        <div class="col-md-4 image-box mb-5">
                        <img width="40%" height="100%" src="{{ asset('uploads/'.$value->image) ?? '' }}" class="open-img" alt="{{ $value->name ?? '' }}">
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
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">Resolutions of {{ $past_conferences->title ?? '' }}</p>
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

    <!-- The Modal -->
<div id="myModal" class="modal">
<!-- The Close Button -->
<span class="close">&times;</span>
<!-- Modal Content (The Image) -->
<img class="modal-content" id="img01">
<div class="w3-content" style="max-width:1200px">
 
  <div class="w3-row-padding w3-section">
        @if (!empty($images) && $images->count())
            <div class="row mt-2">
            @if (!empty($images) && $images->count())
                @foreach ($images as $key => $value)
                    @if(!empty($value->image))
                    <div class="col-md-1 mb-2">
                    <img width="100%" height="100%" src="{{ asset('uploads/'.$value->image) ?? '' }}" class="open-img" alt="{{ $value->name ?? '' }}">
                    </div> 
                    @endif
                @endforeach
            @endif   
            </div>
        @endif
  </div>

</div>
<!-- Modal Caption (Image Text) -->
<div id="caption"></div>
</div>
