@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Committee Members</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/committee') }}">Committee Members</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Add Members</li>
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
                        <h4 class="card-title">Add Members</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <form method="post" action="{{ url('admin/committee_add_members') }}"  enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="committe_id" value="{{ $id }}" class="form-control  @error('committe_id') border-danger @enderror">
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
                                        <label class="form-label text-danger">Title</label>
                                        <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') border-danger @enderror" placeholder="Title">
                                        @error('title')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">image</label>
                                     <fieldset>
                                        <div class="input-group">
                                            <input type="file" name="image"  class="form-control  @error('image') border-danger @enderror"  aria-label="Upload">
                                            <button class="btn btn-primary">Upload</button>
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
    </section>
    @if (!empty($data) && $data->count())
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Members</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                       
                            @foreach ($data as $key => $value)
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                            <a class="btn-sm icon btn-danger rounded-pill dltButton"  data-url="{{ url('admin/member_delete',$value->id) }}" data-replaceurl="{{ url('admin/committee_members',$id) }}" title="Delete Member">x</a>
                                <img class="w-100 active" src="{{ asset('uploads/'.$value->image) }}" data-bs-slide-to="0">
                                    
                                <span>{{ $value->name }}</span><br>
                                <span>{{ $value->title }}</span>
                            </div>
                            @endforeach
                           
                        </div>

                    </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/committee') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    <a href="{{ url('admin/committee') }}" class="btn btn-primary me-1 mb-1">Done</a>
                                    </div>
                
            </div>
        </div>
    </section>
    @endif
    <!-- // Basic multiple Column Form section end -->
</div>



 @endsection