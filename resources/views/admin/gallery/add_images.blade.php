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
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Gallery Images</h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-content">
                                <div class="card-body">
                                <form method="post" action="{{ url('admin/gallery_add_images') }}"  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="gallery_id" value="{{ $id }}" class="form-control  @error('gallery_id') border-danger @enderror">
                                        <div class="row">
                                        <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label text-danger">Image</label>
                                            <fieldset>
                                                <div class="input-group">
                                                    <input type="file" name="image"  class="form-control  @error('image') border-danger @enderror"  aria-label="Upload">
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </fieldset>
                                            <small>Image Dimension:532x300, Size below 3MB</small>
                                            @error('image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card-content">
                                <div class="card-body">
                                <form method="post" action="{{ url('admin/gallery_add_video') }}"  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="gallery_id" value="{{ $id }}" class="form-control  @error('gallery_id') border-danger @enderror">
                                        <div class="row">
                                        <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label text-danger">YouTube Video Url</label>
                                            <fieldset>
                                                <div class="input-group">
                                                    <input type="text" name="video"  class="form-control  @error('video') border-danger @enderror"  aria-label="Upload">
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </fieldset>
                                           
                                            @error('image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (!empty($data) && $data->count())
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                       
                                @foreach ($data as $key => $value)
                            <div class="col-6 col-sm-6 col-lg-3 mt-4 mb-2">
                            <a class="btn-sm icon btn-danger rounded-pill dltButton" style="padding: 0.25rem 0.5rem 1.25rem 0.5rem;" data-url="{{ url('admin/gallery_img_delete',$value->id) }}" data-replaceurl="{{ url('admin/gallery_images',$id) }}" title="Delete Project">x</a>
                                   
                            @if(!empty($value->image))
                            <img class="w-100 active" src="{{ asset('uploads/'.$value->image) }}" data-bs-slide-to="0">
                            @elseif(!empty($value->video))
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                
                                    <iframe width="250" height="245" src="https://www.youtube.com/embed/{{ $value->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                </div>
                            </div>
                            @endif
                            </div>
                            @endforeach
                           
                        </div>

                    </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/gallery') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    <a href="{{ url('admin/gallery') }}" class="btn btn-primary me-1 mb-1">Done</a>
                                    </div>
                
            </div>
        </div>
    </section>
    @endif
    <!-- // Basic multiple Column Form section end -->
</div>



 @endsection