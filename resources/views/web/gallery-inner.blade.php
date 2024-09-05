@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <div class="mb-4">
                        <h3 class="color-darkblue" style="display: inline-block;">{{$gallery->name}}</h3>
                        <a href="https://www.eamunc.org/gallery" class="button main-btn" style="display: inline-block; float: right; padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px; color: #166EE1; border: 1px solid #166EE1;     margin-top: 20px;">Back</a>
                    </div>

                @if (!empty($images) && $images->count())

                    <div class="row mt-5">
                    @if (!empty($images) && $images->count())
                        @foreach ($images as $key => $value)

                       
                       
                       
                        @if(!empty($value->image))
                        
                        <div class="col-md-4 image-box mb-5">
                            <a target="_blank" class="fancybox" rel="group" href="{{ asset('uploads/'.$value->image) ?? '' }}">
                                <img  height="100%" src="{{ asset('uploads/'.$value->image) ?? '' }}" class="open-img" alt="{{ $value->name ?? '' }}">
                            </a>
                            </div>
                  
                        
                        
                        
                        @endif
                       
                       

                        @endforeach
                  
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
                       
                        @endif
                    </div>



                @else
                <div class="col-md-6 text-center text-md-end color-darkblue">
                    Gallery Images isn't available right Now !
                </div>
                @endif






                </div>
                @include('web.layout.pagination', ['paginator' => $images])
                <span class="spacer"></span>
            </div>

        </div>
    </section>


    @endsection