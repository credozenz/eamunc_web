@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Live</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/newsletter') }}">Live</a></li>
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
                    <form method="post" action="{{ url('admin/live_update') }}"  enctype="multipart/form-data">
                    @csrf   
                    
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Youtube Live Url</label>
                            <input type="text" name="live_url" value="https://www.youtube.com/watch?v={{ $data->video ?? '' }}" class="form-control" placeholder="Live URL">
                            @error('live_url')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    @if(!empty($data->video))

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                        
                                            <iframe width="250" height="300" src="https://www.youtube.com/embed/{{ $data->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                        </div>
                                    </div>
                                    @endif
                                  
                                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/dashbord') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
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