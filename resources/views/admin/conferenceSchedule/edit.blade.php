
@extends('admin.layout.main')
@section('content')


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Conference Schedule</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/conference_schedule') }}"> Conference Schedule</a></li>
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
                <form method="post" action="{{ url('admin/conference_schedule_update',$data->id) }}"  enctype="multipart/form-data">
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
                                    <div class="form-group">
                                            <label class="form-label text-danger">Date</label>
                        <input type="text" name="date" value="{{ $data->date }}" class="form-control @error('date') border-danger @enderror" placeholder="Name">
                        @error('date')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Name</label>
                        <input type="text" name="name[]" value="{{ old('name') }}" class="form-control " placeholder="Name">  
                           
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Start Date</label>
                        <input type="time" name="time_start[]" value="{{ old('time_start') }}" class="form-control " placeholder="Start Date">
                           
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">End Date</label>
                        <input type="time" name="time_end[]" value="{{ old('time_end') }}" class="form-control" placeholder="End Date">
                           
                                    </div>
                                </div>

                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                       <br>
                                        <button type="button" class="btn btn-primary me-1 mb-1 mt-2" name="add" id="add">+</button>
                                    </div>
                                </div>

                            @if (!empty($time) && $time->count())
                              @foreach ($time as $key => $value)
                              <div class="row key{{ $key }}">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                        <input type="text" name="name[]" value="{{ $value->name }}" class="form-control " placeholder="Name">  
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                        <input type="time" name="time_start[]" value="{{ $value->time_start }}" class="form-control " placeholder="Start Date">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                        <input type="time" name="time_end[]" value="{{ $value->time_end }}" class="form-control" placeholder="End Date">
                                    </div>
                                </div>

                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary me-1 mb-1 mt-2 btn_remove_xst" name="add" key="{{ $key }}">-</button>
                                    </div>
                                </div>
                            </div>
                                @endforeach
                            @endif

                                    


                                <div id="dynamic_field"></div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Description</label>
                        <textarea id="input-filter-5" type="text" name="description" class="form-control @error('description') border-danger @enderror" placeholder="Description" style="height: 250px;">{{ $data->description }}</textarea>
                        @error('description')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                  
                                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/newsletter') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
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