@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Committee</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/committee') }}">Committee</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Create</li>
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
                    <h4 class="card-title">Create</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form method="post" action="{{ url('admin/committee_store') }}"  enctype="multipart/form-data">
                        @csrf
                
                            <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                        <label class="form-label text-danger">Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') border-danger @enderror" placeholder="Name">
                                        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Image</label>
                                        <input type="file" name="image" class="form-control  @error('image') border-danger @enderror">
                                        @error('image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Title</label>
                                        <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') border-danger @enderror" placeholder="Title">
                                        @error('title')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Agenda</label>
                                        <input type="text" name="agenda" value="{{ old('agenda') }}" class="form-control @error('agenda') border-danger @enderror" placeholder="Agenda">
                                        @error('agenda')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Sub Title</label>
                                        <input type="text" name="sub_title" value="{{ old('sub_title') }}" class="form-control @error('sub_title') border-danger @enderror" placeholder="Sub Title">
                                        @error('sub_title')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Description</label>
                                        <textarea type="text" name="description" class="form-control @error('description') border-danger @enderror" placeholder="Description" style="height: 250px;">{{ old('description') }}</textarea>
                                        @error('description')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">File</label>
                                        <input type="file" name="file" class="form-control  @error('file') border-danger @enderror">
                                        @error('file')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Video</label>
                                        <input type="text" name="video" class="form-control  @error('video') border-danger @enderror">
                                        @error('video')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 d-flex justify-content-end">
                                <a href="{{ url('admin/committee') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                <button class="btn btn-primary me-1 mb-1">Submit</button>
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