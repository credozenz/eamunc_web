
@extends('admin.layout.main')
@section('content')


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Faculties Messages</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/facultiesmessages') }}"> Faculties Messages</a></li>
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
                    
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/facultiesmessages_edit',$data->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                            <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('admin/facultiesmessages_delete',$data->id) }}" data-replaceurl="{{ url('admin/facultiesmessages') }}" title="Delete Project">Delete</a>
                        </li>
                    </ol>
                    </nav>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
              
                    <div class="row">
                                <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Name</label>
                        <input type="text" name="name" value="{{ $data->name }}" disabled class="form-control @error('name') border-danger @enderror" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <label class="form-label text-danger">Post</label>
                        <input type="text" name="post" value="{{ $data->post }}" disabled class="form-control @error('post') border-danger @enderror" placeholder="Post">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Title</label>
                        <input type="text" name="title" value="{{ $data->title }}" class="form-control @error('title') border-danger @enderror" disabled placeholder="Title">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12"></div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Thumbnail</label>
                                            <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                 <img class="rounded-md img-preview" src="{{ asset('uploads/'.$data->image) }}" style="width: 103px;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Youtube link</label>

                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $data->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        
                                        </div>
                                    </div>
                                   
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

  @endsection