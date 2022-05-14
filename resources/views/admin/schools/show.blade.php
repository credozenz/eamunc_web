
@extends('admin.layout.main')
@section('content')



<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>School </h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/Schools') }}">School </a></li>
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
                        <h4 class="card-title">School Details</h4>
                   <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                        <a href="{{ url("/admin/students?school=".$data->id) }}" class="btn-sm btn-success shadow-md mr-2">Students</a>
                            <a href="{{ url('admin/school_edit',$data->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                            @if($data->id != 1)
                            <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('admin/school_delete',$data->id) }}" data-replaceurl="{{ url('admin/schools') }}" title="Delete School">Delete</a>
                            @endif
                        </li>
                    </ol>
                    </nav>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <div class="form-section mb-5">
                          
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">School Name*</label>
                                            <input type="text" name="school_name" value="{{ $data->name ?? '' }}" maxlength="80" class="form-control " aria-describedby="textHelp" placeholder="School Name" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">School Logo</label>
                                            <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                            <img alt="{{ $data->name }}" class="rounded-full" src="{{ asset('uploads/'.$data->logo) }}" width="200" height="80">
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Faculty Advisor’s Name*</label>
                                            <input type="text" name="advisor_name" value="{{ $data->advisor_name ?? '' }}" maxlength="80" class="form-control " aria-describedby="textHelp" placeholder="Faculty Advisor’s Name" disabled>
                                                                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email*</label>
                                            <input type="email" name="advisor_email" value="{{ $data->email ?? '' }}" maxlength="80" class="form-control user_email " aria-describedby="textHelp" placeholder="Email" disabled>
                                                                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Mobile*</label>
                                            <input type="phone" name="advisor_mobile" value="{{ $data->mobile ?? '' }}" maxlength="15" class="form-control user_phone " aria-describedby="textHelp" placeholder="Mobile" disabled>
                                                                                        </div>
                                    </div>
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

