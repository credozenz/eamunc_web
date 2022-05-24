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
                    <form method="post" action="{{ url('admin/committee_update',$data->id) }}"  enctype="multipart/form-data">
                        @csrf
                
                            <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                        <label class="form-label text-danger">Short Name</label>
                                        <input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') border-danger @enderror" placeholder="Name">
                                        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"></div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Image</label>
                                    @if(!empty($data->image))
                                        <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                 <img class="rounded-md img-preview" src="{{ asset('uploads/'.$data->image) }}" style="width: 103px;">
                                       </div>
                                    @endif
                                        <input type="file" name="image" class="form-control  @error('image') border-danger @enderror">
                                        <small>Image Dimension:443x161, Size below 3MB</small>
                                        @error('image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"></div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Full Name</label>
                                        <input type="text" name="title" value="{{ $data->title }}" class="form-control @error('title') border-danger @enderror" placeholder="Title">
                                        @error('title')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Agenda</label>
                                        <input type="text" name="agenda" value="{{ $data->agenda }}" class="form-control @error('agenda') border-danger @enderror" placeholder="Agenda">
                                        @error('agenda')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Title</label>
                                        <input type="text" name="sub_title" value="{{ $data->sub_title }}" class="form-control @error('sub_title') border-danger @enderror" placeholder="Sub Title">
                                        @error('sub_title')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Description</label>
                                        <textarea type="text" name="description" class="form-control @error('description') border-danger @enderror" placeholder="Description" style="height: 250px;">{{ $data->description }}</textarea>
                                        @error('description')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">File</label>
                                        @if($files)
                                        @foreach ($files as $key => $file)
                                        <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                        <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('admin/committee_file_delete',$file->id) }}" data-replaceurl="{{ url('admin/committee_show',$data->id) }}" title="Delete Project">x</a>
                                         <a href="{{ asset('uploads/'.$file->file) }}" >
                                            <img class="rounded-md img-preview" src="{{asset('assets/admin/img/file_demo.png')}}" style="width: 47px;"> 
                                         </a>
                                         {{ $file->name ?? '' }}
                                         
                                        </div>
                                        @endforeach
                                        @endif
                                        <input type="file" name="file[]" multiple="multiple" class="form-control  @error('file') border-danger @enderror">
                                        @error('file')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"></div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Video</label>
                                        <input type="text" name="video" class="form-control  @error('video') border-danger @enderror" value="https://www.youtube.com/watch?v={{ $data->video }}">
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