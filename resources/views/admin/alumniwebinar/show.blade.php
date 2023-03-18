
@extends('admin.layout.main')
@section('content')



<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Alumni Webinar</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/alumniwebinar') }}">Alumni Webinar</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Show </li>
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

                        @if($data->status=='1')
                           <a class="btn-sm btn-warning shadow-md mr-2 archButton"  data-url="{{ url('admin/alumniwebinar_archive',$data->id) }}" data-status="0" data-replaceurl="{{ url('admin/alumniwebinar') }}" title="Archive webinar">Archive</a>
                        @else
                           <a class="btn-sm btn-warning shadow-md mr-2 archButton"  data-url="{{ url('admin/alumniwebinar_archive',$data->id) }}" data-status="1" data-replaceurl="{{ url('admin/alumniwebinar') }}" title="Archive webinar">Unarchive</a>
                        @endif   
                           
                           
                           <a href="{{ url('admin/alumniwebinar_edit',$data->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                            <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('admin/alumniwebinar_delete',$data->id) }}" data-replaceurl="{{ url('admin/alumniwebinar') }}" title="Delete webinar">Delete</a>
                        </li>
                    </ol>
                    </nav>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <div class="row">
                              
                                    <div class="col-md-6 col-12">
                                    <div class="form-group">
                                            <label for="text-danger">Title</label>
                        <input type="text" name="title" value="{{ $data->title }}" class="form-control" disabled placeholder="Title">
                      
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Image</label>
                            <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                 <img class="rounded-md img-preview" src="{{ asset('uploads/'.$data->image) }}" style="width: 103px;">
                            </div>
                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Video</label>
                                            <iframe width="100%" height="445" src="https://www.youtube.com/embed/{{ $data->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                        
                                        </div>
                                    </div>
                                   
                                  
                                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/alumniwebinar') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    
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

