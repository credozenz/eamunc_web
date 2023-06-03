
@extends('admin.layout.main')
@section('content')


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Schools</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/schools') }}"> Schools</a></li>
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
                        <h4 class="card-title">School Edit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                <form method="post" action="{{ url('admin/school_update',$data->id) }}"  enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-section mb-5">
                                <h4 class="color-darkblue mb-5"></h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">School Name*</label>
                                            <input type="text" name="school_name" value="{{ $data->name ?? '' }}" maxlength="80" class="form-control " aria-describedby="textHelp" placeholder="School Name" required="">
                                                                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">School Logo</label>
                                            <div class="row">
                                            <div class="col-md-4">
                                            <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                            @if(!empty($data->logo))
                                            <img alt="{{ $data->name }}" class="rounded-full" src="{{ asset('uploads/'.$data->logo) }}" width="150" height="80">
                                            @else
                                            <div class="stats-icon green"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                                            @endif
                                            </div>
                                             </div>
                                            <div class="col-md-8">
                                            <input type="file" name="school_logo" value="" class="form-control img_valid " aria-describedby="textHelp" placeholder="School Logo">
                                            </div>
                                             </div>                                     </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Faculty Advisor’s Name*</label>
                                            <input type="text" name="advisor_name" value="{{ $data->advisor_name ?? '' }}" maxlength="80" class="form-control " aria-describedby="textHelp" placeholder="Faculty Advisor’s Name" required="">
                                                                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email*</label>
                                            <input type="email" name="advisor_email" value="{{ $data->email ?? '' }}" maxlength="80" class="form-control user_email " aria-describedby="textHelp" placeholder="Email" required="">
                                                                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Mobile*</label>
                                            <input type="phone" name="advisor_mobile" value="{{ $data->mobile ?? '' }}" maxlength="15" class="form-control user_phone " aria-describedby="textHelp" placeholder="Mobile" required="">
                                                                                        </div>
                                    </div>
                                </div>
                            </div>
                                  
                                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/schools') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
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