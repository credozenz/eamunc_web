
@extends('admin.layout.main')
@section('content')



<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Conference Schedule</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/conference_schedule') }}">Our Mentors</a></li>
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
                            <a href="{{ url('admin/conference_schedule_edit',$data->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                            <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('admin/conference_schedule_delete',$data->id) }}" data-replaceurl="{{ url('admin/our_mentors') }}" title="Delete Project">Delete</a>
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
                                            <label for="text-danger">Date</label>
                        <input type="text" name="date" value="{{ $data->date }}" class="form-control" disabled placeholder="Date">
                      
                                        </div>
                                    </div>


                                    <div class="col-md-4 col-12">
                                    <div class="form-group">
                                       <label>Name</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>Start time</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label>End time</label>
                                    </div>
                                </div>

                            @if (!empty($time) && $time->count())
                              @foreach ($time as $key => $value)
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <input type="text" name="name[]" disabled value="{{ $value->name }}" class="form-control " placeholder="Name">  
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <input type="time" name="time_start[]" disabled value="{{ $value->time_start }}" class="form-control " placeholder="Start Date">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <input type="time" name="time_end[]" disabled value="{{ $value->time_end }}" class="form-control" placeholder="End Date">
                                    </div>
                                </div>
                              @endforeach
                            @endif
                                   
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Description</label>
                        <textarea id="input-filter-5" type="text" name="description" class="form-control" placeholder="Description" disabled style="height: 250px;">{{ $data->description }}</textarea>
                        @error('description')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                  
                                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/conference_schedule') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    
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

