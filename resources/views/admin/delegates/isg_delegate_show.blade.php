
@extends('admin.layout.main')
@section('content')



<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>ISG Student</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/isg_delegates') }}">ISG Student</a></li>
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
                            <a href="{{ url('admin/isg_delegates_edit',$data->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                            <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('admin/isg_delegates_delete',$data->id) }}" data-replaceurl="{{ url('admin/delegate') }}" title="Delete Project">Delete</a>
                        </li>
                    </ol>
                    </nav>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <div class="row">
                                  
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Name</label>
                                            <input type="text" name="title" value="{{ $data->name }}" class="form-control" disabled placeholder="Title">
                      
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Email</label>
                                            <input type="text" name="email" value="{{ $data->email }}" class="form-control" disabled placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Class & Section</label>
                                            <input type="text" name="class" value="{{ $data->class }}" class="form-control" disabled placeholder="class">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Committee Choice</label>
                                            <input type="text" name="committee_choice" value="{{ $data->committee_choice }}" class="form-control" disabled placeholder="Committee choice">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Country choice</label>
                                            <input type="text" name="country_choice" value="{{ $data->country_choice }}" class="form-control" disabled placeholder="Country choice">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">WhatsApp NO</label>
                                            <input type="text" name="whatsapp_no" value="{{ $data->whatsapp_no }}" class="form-control" disabled placeholder="Whatsapp no">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">MUN Experience</label>
                                            <input type="text" name="mun_experience" value="{{ $data->mun_experience }}" class="form-control" disabled placeholder="MUN Experience">
                                        </div>
                                    </div>
                                   
                                   
                                   
                                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/isg_delegates') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    
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

