@extends('web.layout.main')
@section('content')


@if (!empty($committees) && $committees->count())
    <section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <div class="mb-4">
                        <h3 class="color-darkblue">{{ $committees->title ?? '' }}</h3>
                        <p class="subnote"><strong>AGENDA : </strong>{{ $committees->agenda ?? '' }} </p>
                    </div>
                    <span class="spacer"></span>

                    @if (!empty($members) && $members->count())
                    <div class="row mt-5">
                        <div class="col-12">
                            <h4 class="color-darkblue mb-4">Bureau Members</h4>
                        </div>

                        @foreach ($members as $key => $value)

                        <div class="col-lg-3 col-md-4 col-6 image-box mb-4">
                              @if(!empty($value->image)) 
                              <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                              @else
                              <img class="w-100 active" src="{{ asset('assets/img/avatar.svg') }}" style ="min-height: 93%;" data-bs-slide-to="0">
                              @endif
                       
                            <p class="mentor-name text-center">{{ $value->name ?? '' }}</p>
                            <p class="mentor-designation text-center color-blue">{{ $value->post ?? '' }}</p>
                        </div>

                        @endforeach

                    </div>
                    @endif


                </div>
            </div>

            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">{{ $committees->sub_title ?? '' }}</h3>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                                 {{ $committees->description ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="mentors" class="section-padding">
        <div class="container">
            <h3 class="color-darkblue mb-md-4 mb-5">Committee Webinar</h3>
            <div class="row">

                <div class="col-12 px-0">
                    <iframe width="100%" height="800" src="https://www.youtube-nocookie.com/embed/{{ $committees->video ?? '' }}" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>

            </div>
        </div>
    </section>




    @if (!empty($files) || !empty($committees->file))
  
    <section id="regulations" class="section-padding">
        <div class="wrapper">
            <div class="container p-0">
                <div class="box border-black">
                    
                        @if(!empty($committees->file))
                        <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">{{ $committees->name ?? '' }} Background Guide</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end mb-3">
                        <a href="{{ asset('uploads/'.$committees->file) }}" target="_blank">
                            <button class="download-btn">Download Now</button>
                        </a>
                        </div>
                        </div>
                        @endif
                        @if (!empty($files) && $files->count())
                        <div class="row align-items-center">
                        <div class="col-md-4 mb-3">
                            <p class="color-darkblue h5 mb-3 mb-md-0 text-center text-md-start">Other Documents</p>
                        </div>
                        @foreach ($files as $key => $value)
                        <div class="col-md-1  mb-3">
                        @php
                        $file_without_ext = substr($value->name, 0, strrpos($value->name,"."));
                        $filename = preg_replace('/[^A-Za-z0-9\-]/', ' ', $file_without_ext);
                       
                        @endphp
                        <a href="{{ asset('uploads/'.$committees->file) }}" class="mt-5" data-title="{{ $filename ?? ''}}">
                           <img class="rounded-md img-preview" src="{{asset('assets/admin/img/file_demo.png')}}"  style="width: 47px;"> 
                         </a>
                      
                         </div>
                        @endforeach
                        
                        </div>
                        @endif
                   
                </div>
            </div>

        </div>
    </section>
    @endif










@endif

    @endsection