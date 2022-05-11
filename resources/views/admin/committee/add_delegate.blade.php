@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Committee Delegates</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/committee') }}">Committee Delegates</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Add Delegate</li>
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
                        <h4 class="card-title">Add Delegates</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <form method="post" action="{{ url('admin/committee_add_delegate') }}"  enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="committe_id" value="{{ $id }}" class="form-control  @error('committe_id') border-danger @enderror">
                                <div class="row">
                                <div class="col-md-6 col-12">
                                <div class="form-group ">
                                        <label class="form-label text-danger">Delegates</label>
                                        <select name="delegate_member" class="form-control select2-multiple delegate_member" required="">
                                            <option value=""> Select Delegates </option>
                                            @foreach ($delegate_members as $key => $value)
                                            <option value="{{ $value->id ?? '' }}" {{ (old('delegate_member') == $value->id ? "selected":"") }}> {{ $value->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('delegate_member')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                               
                                </div>

                                
                <div class="card" id="delegatedtl" style="display: none;">
                    <div class="card-content">
                        
                            <div class="card-body">
                                <div class="row">
                                <h4 class="color-darkblue mb-5">Delegate Details</h4>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Name</label>
                                            <input type="text" name="name" value="" class="form-control" id="del_name" disabled="" placeholder="Title">
                      
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">School</label>
                                            <input type="text" name="name" value="" class="form-control" id="del_school" disabled="" placeholder="Title">
                      
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Email</label>
                                            <input type="text" name="email" value="" class="form-control" id="del_email" disabled="" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Class &amp; Section</label>
                                            <input type="text" name="class" value="" class="form-control" id="del_class" disabled="" placeholder="class">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">WhatsApp No</label>
                                            <input type="text" name="whatsapp_no" value="" class="form-control" id="del_no" disabled="" placeholder="Whatsapp no">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">MUN Experience</label>
                                            <input type="text" name="mun_experience" value="" class="form-control" id="del_munexp" disabled="" placeholder="MUN Experience">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Bureau Member Experience</label>
                                            <input type="text" name="bureaumem_experience" value="" class="form-control" id="del_buroexp" disabled="" placeholder="MUN Experience">
                                        </div>
                                    </div>
                                   
                                                                                                                                                <div class="col-md-6 col-12">
                                      
                                    </div>

                                  
                                </div>
                            </div>

                    </div>
                </div>

                              
                                <div class="col-md-6 col-12">
                                        <div class="form-group">
                                <button class="btn btn-primary">ADD</button>
                                         </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (!empty($data) && $data->count())
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Delegates</h5>
                    </div>
                    <div class="card-body">

                        <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                       
                            @foreach ($data as $key => $value)
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2" style="margin-bottom: 5rem !important;">
                            <a class="btn-sm icon btn-danger dltButton"  data-url="{{ url('admin/committee_dlt_delegate',$value->id) }}" data-replaceurl="{{ url('admin/committee_delegate',$id) }}" title="Delete Member">x</a>
                              @if(!empty($value->image)) 
                              <img class="w-100 active" src="{{ asset('uploads/'.$value->image) }}" data-bs-slide-to="0">
                              @else
                              <img class="w-100 active" src="{{ asset('assets/img/avatar.svg') }}" style ="min-height: 83%;" data-bs-slide-to="0">
                              @endif
                                <span>{{ $value->name ?? '' }}</span><br>
                            </div>
                            @endforeach
                           
                        </div>
                        @include('admin.layout.pagination', ['paginator' => $data])
                    </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/committee') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    <a href="{{ url('admin/committee') }}" class="btn btn-primary me-1 mb-1">Done</a>
                                    </div>
                
            </div>
        </div>
    </section>
    @endif
    <!-- // Basic multiple Column Form section end -->
</div>



 @endsection