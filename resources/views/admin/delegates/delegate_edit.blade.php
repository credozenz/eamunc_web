
@extends('admin.layout.main')
@section('content')



<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>School Delegates</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/school_delegates') }}">School Delegates</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit </li>
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
                        <form method="post" action="{{ url('admin/school_delegates_update',$data->id) }}"  enctype="multipart/form-data">
                        @csrf
                             <div class="row">
                                  
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Name</label>
                                            <input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') border-danger @enderror" {{ $errors->has('name') ? 'autofocus' : '' }} placeholder="Delegate Name" aria-describedby="textHelp" required>
                                            @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Email</label>
                                            <input type="email" name="email" value="{{ $data->email  }}" class="form-control user_email @error('email') border-danger @enderror" {{ $errors->has('email') ? 'autofocus' : '' }} placeholder="Email" aria-describedby="textHelp" required>
                                            @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Class & Section</label>
                                            <input type="text" name="class" value="{{  $data->class }}" class="form-control @error('class') border-danger @enderror" {{ $errors->has('class') ? 'autofocus' : '' }} placeholder="Class & Section" aria-describedby="textHelp" required>
                                             @error('class')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>


                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">WhatsApp NO</label>
                                            <input type="text" name="whatsapp_no" value="{{ $data->whatsapp_no }}" class="form-control user_phone @error('whatsapp_no') border-danger @enderror" {{ $errors->has('whatsapp_no') ? 'autofocus' : '' }} placeholder="WhatsApp Number with country code" aria-describedby="textHelp" required>
                                            @error('whatsapp_no')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">MUN Experience</label>
                                            
                                            <input type="text" name="mun_experience" value="{{ $data->mun_experience }}" class="form-control @error('mun_experience') border-danger @enderror" {{ $errors->has('mun_experience') ? 'autofocus' : '' }} placeholder="" required>
                                            @error('mun_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Bureau Member Experience</label>
                                            
                                            <input type="text" name="bureaumem_experience" value="{{ $data->bureaumem_experience }}" class="form-control @error('bureaumem_experience') border-danger @enderror" {{ $errors->has('bureaumem_experience') ? 'autofocus' : '' }} placeholder="" required>
                                            @error('bureaumem_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                   
                                   
                                   
                                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/school_delegates') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    <button class="btn btn-primary me-1 mb-1">Submit</button>
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

