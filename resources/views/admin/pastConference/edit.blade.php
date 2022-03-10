
@extends('admin.layout.main')
@section('content')


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Past Conference</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/newsletter') }}">Past Conference</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Edit</li>
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
                        <h4 class="card-title">Edit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                <form method="post" action="{{ url('admin/pastconference_update',$data->id) }}"  enctype="multipart/form-data">
                    @csrf
                    
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Title</label>
                        <input type="text" name="title" value="{{ $data->title }}" class="form-control @error('title') border-danger @enderror" placeholder="Title">
                        @error('title')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                      
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Image</label>
                            <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                 <img class="rounded-md img-preview" src="{{ asset('uploads/'.$data->image) }}" style="width: 103px;">
                            </div>
                        <input type="file" name="image" class="form-control @error('image') border-danger @enderror">
                        @error('image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">News File</label>
                            <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                            <a href="{{ asset('uploads/'.$data->file) }}" >
                                <img class="rounded-md img-preview" src="{{asset('assets/admin/img/file_demo.png')}}" style="width: 58px;"> 
                            </a>
                            </div>
                        <input type="file" name="file" class="form-control">
                       @error('file')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Description</label>
                        <textarea id="input-filter-5" type="text" name="description" class="form-control @error('description') border-danger @enderror" placeholder="Description" style="height: 250px;">{{ $data->description }}</textarea>
                        @error('description')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                  
                                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/pastconference') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    <button class="btn btn-primary me-1 mb-1">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

  @endsection