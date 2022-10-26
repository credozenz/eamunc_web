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
                        <li class="breadcrumb-item active" aria-current="page"> Show</li>
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
                    <h4 class="card-title">Show</h4>
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                       
                        <a href="{{ url('admin/committee_bureau',$data->id) }}" class="btn-sm btn-success shadow-md mr-2">Bureau Members</a>
                        <a href="{{ url('admin/committee_delegate',$data->id) }}" class="btn-sm btn-warning shadow-md mr-2">Delegates</a>
                        <a href="{{ url('admin/committee_edit',$data->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                            <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('admin/committee_delete',$data->id) }}" data-replaceurl="{{ url('admin/committee') }}" title="Delete Project">Delete</a>
                        </li>
                    </ol>
                    </nav>
                </div>
                <div class="card-content">
                  <div class="card-body">
                   
                            <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                        <label class="form-label text-danger">Short Name</label>
                                        <input type="text" name="name" disabled value="{{ $data->name }}" class="form-control @error('name') border-danger @enderror" placeholder="Name">
                                        
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
                                        
                                    </div>
                                </div>
                                <div class="col-md-6 col-12"></div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Full Name</label>
                                        <input type="text" name="title" disabled value="{{ $data->title }}" class="form-control @error('title') border-danger @enderror" placeholder="Title">
                                       
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Agenda</label>
                                        <input type="text" name="agenda" disabled value="{{ $data->agenda }}" class="form-control @error('agenda') border-danger @enderror" placeholder="Agenda">
                                       
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Title</label>
                                        <input type="text" name="sub_title" disabled value="{{ $data->sub_title }}" class="form-control @error('sub_title') border-danger @enderror" placeholder="Sub Title">
                                        
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Description</label>
                                        <textarea type="text" name="description" disabled class="form-control @error('description') border-danger @enderror" placeholder="Description" style="height: 250px;">{{ $data->description }}</textarea>
                                       
                                    </div>
                                </div>
                                @if(sizeof($files))
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">File</label>
                                        
                                        @foreach ($files as $key => $file)
                                        <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                        <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('admin/committee_file_delete',$file->id) }}" data-replaceurl="{{ url('admin/committee_show',$data->id) }}" title="Delete Project">x</a>
                                         <a href="{{ asset('uploads/'.$file->file) }}" >
                                            <img class="rounded-md img-preview" src="{{asset('assets/admin/img/file_demo.png')}}" style="width: 47px;"> 
                                         </a>
                                         {{ $file->name ?? '' }}
                                         
                                        </div>
                                        @endforeach
                                       
                                        
                                    </div>
                                </div>
                                @endif
                                @if(!empty($data->video))
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Video</label>
                                       
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                
                                                    <iframe width="auto" height="300" src="https://www.youtube.com/embed/{{ $data->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                                </div>
                                            </div>
                                           
                                    </div>
                                </div>
                                @endif
                                
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