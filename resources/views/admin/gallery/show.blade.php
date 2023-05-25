@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Gallery</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/gallery') }}">Gallery</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Add Images</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
            @if(Session::has('success'))
            <div class="alert alert-success"><i class="bi bi-star"></i>{{ Session::get('success') }}</div>
             @elseif(Session::has('error'))
            <div class="alert alert-danger"><i class="bi bi-file-excel"></i> {{ Session::get('error') }}</div>
            @endif
    <!-- // Basic multiple Column Form section start -->
    
    
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $gallery->name }}</h5>
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                        <a href="{{ url('admin/gallery_images',$gallery->id) }}" class="btn-sm btn-warning shadow-md mr-2">Add Images</a>
                            <a href="{{ url('admin/gallery_edit',$gallery->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                            <a class="btn-sm btn-danger shadow-md mr-2 dltButton" data-url="{{ url('admin/gallery_delete',$gallery->id) }}" data-replaceurl="{{ url('admin/gallery') }}" title="Delete Project">Delete</a>
                        </li>
                    </ol>
                    </nav>
                    </div>
                    <div class="card-body">
                        <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                        @if (!empty($images) && $images->count())
                                @foreach ($images as $key => $value)
                           

                            @if(!empty($value->image))
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                           
                                    <img class="w-100 active" src="{{ asset('uploads/'.$value->image) }}" data-bs-slide-to="0">
                                
                            </div>
                            @elseif(!empty($value->video))
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                
                                    <iframe width="250" height="145" src="https://www.youtube.com/embed/{{ $value->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                            </div>
                            @endif




                            @endforeach
                            @else
                            <div>empty images !</div>
                            @endif
                        </div>
                        @include('admin.layout.pagination', ['paginator' => $images])
                    </div>
                    </div>
                   
            </div>
        </div>
    </section>
    
    <!-- // Basic multiple Column Form section end -->
</div>



 @endsection