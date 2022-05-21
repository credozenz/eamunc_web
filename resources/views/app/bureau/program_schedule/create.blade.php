@extends('app.bureau.layouts.layout')
@section('content')
<div class="row">
      <div class="col-md-8">
        <h4 class="dash-main-head">{{ $committee->name ?? '' }}</h4>
        <p class="sub-head">{{ $committee->title ?? '' }}</p>
      </div>

      <div class="col-md-4">
        <div class="d-flex flex-row  mb-3">
          <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
          <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United Nations Conference </h5>
        </div>
      </div>

    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h6 class="text-primary ">Program Schedule</h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ url('app/program_schedule_store') }}"  enctype="multipart/form-data">
                                @csrf
                            
                                    <div class="row">
                                        
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label class="form-label text-danger">Date</label>
                                <input type="date" name="date" value="{{ old('date') }}" class="form-control @error('date') border-danger @enderror" placeholder="Date">
                                @error('date')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12"></div>
                                        
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label class="form-label text-danger">Title</label>
                                <input type="text" name="title[]" value="{{ old('title') }}" class="form-control " placeholder="Title">  
                                
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
                                            <br><br>
                                                <button type="button" class="btn btn-primary me-1 mb-1 mt-2" name="add" id="add">+</button>
                                            </div>
                                        </div>


                                        <div id="dynamic_field"></div>

                                        
                                        <div class="col-12 d-flex justify-content-end">
                                            <a href="{{ url('app/program_schedule') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                            <button class="btn btn-primary me-1 mb-1">Submit</button>
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
    <!-- // Basic multiple Column Form section end -->
</div>



 @endsection