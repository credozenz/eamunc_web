@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Liability Waiver Form</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Add Liability Waiver Form</li>
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
                        <h4 class="card-title">Add Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <form method="post" action="{{ url('admin/liability_waiver_form_update') }}"  enctype="multipart/form-data">
                          @csrf
                          
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                <label class="form-label text-danger">Form File</label>
                                    @if(!empty($data->file))
                                        <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                        <a href="{{ asset('uploads/'.$data->file) }}" >
                                            <img class="rounded-md img-preview" src="{{asset('assets/admin/img/file_demo.png')}}" style="width: 57px;"> 
                                        </a>
                                    </div>
                                    @endif
                                    <div class="input-group">
                                      <input type="file" name="form"  class="form-control  @error('form') border-danger @enderror"  accept=".doc,.docx,.pdf"  aria-label="Upload">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                      @error('form')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                            </div>
                        </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>



 @endsection