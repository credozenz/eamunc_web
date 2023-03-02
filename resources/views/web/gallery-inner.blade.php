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

                       
                       
                       
                        @if(!empty($value->image))
                        
                        <div class="col-md-4 image-box mb-5">
                        <img width="40%" height="100%" src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                        </div> 
                        
                        @endif
                       
                       

                        @endforeach
                    @else
                    <div class="col-md-6 text-center text-md-end color-darkblue">
                       Gallery Images isn't available right Now !
                    </div>
                    @endif
                       

                    </div>


                    <div class="row mt-5">

                        @if (!empty($images) && $images->count())
                            @foreach ($images as $key => $value)

                        

                            @if(!empty($value->video))
                        
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <iframe width="550" height="245" src="https://www.youtube.com/embed/{{ $value->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                            
                            @endif
                        
                            @endforeach
                        @else
                        <div class="col-md-6 text-center text-md-end color-darkblue">
                        Gallery Images isn't available right Now !
                        </div>
                        @endif
                        

                        </div>











                </div>
                @include('web.layout.pagination', ['paginator' => $images])
                <span class="spacer"></span>
            </div>

        </div>
    </section>


    @endsection