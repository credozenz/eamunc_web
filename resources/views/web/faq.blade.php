@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">

            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">FAQs</h3>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                                <div class="accordion accordion-flush" id="accordionFlushExample">

                                @if (!empty($faq) && $faq->count())
                                  @foreach ($faq as $key => $value)

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading">
                                            <button class="accordion-button collapsed h6" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $key }}"
                                                aria-expanded="false" aria-controls="flush-collapse{{ $key }}">
                                                {{ $value->title ?? '' }}
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{ $key }}" class="accordion-collapse collapse"
                                            aria-labelledby="flush-heading{{ $key }}" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                            {!! $value->description ?? '' !!}
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                    @else
                                    <div class="col-md-6 text-center text-md-end color-darkblue">
                                   Faq isn't available right Now !
                                    </div>
                                    @endif
                                   

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    @endsection