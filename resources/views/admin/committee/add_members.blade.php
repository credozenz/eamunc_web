@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Committee Members</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/committee') }}">Committee Members</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Add Members</li>
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
                        <h4 class="card-title">Add Bureau Members</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <form method="post" action="{{ url('admin/committee_add_members') }}"  enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="committe_id" value="{{ $id }}" class="form-control  @error('committe_id') border-danger @enderror">
                                <div class="row">
                                <div class="col-md-6 col-12">
                                <div class="form-group ">
                                        <label class="form-label text-danger">Bureau Members</label>
                                        <select name="bureau_member" class="form-control select2-multiple" required="">
                                            <option value=""> Select Bureau Member </option>
                                            @foreach ($bureau_members as $key => $value)
                                            <option value="{{ $value->id ?? '' }}" {{ (old('bureau_member') == $value->id ? "selected":"") }}> {{ $value->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                <div class="form-group">
                                        <label class="form-label text-danger">Position</label>
                                        <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') border-danger @enderror" placeholder="Position">
                                        @error('title')<div class="text-danger mt-2">{{ $message }}</div>@enderror
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
                        <h5 class="card-title">Bureau Members</h5>
                    </div>
                    <div class="card-body">

                        <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                       
                            @foreach ($data as $key => $value)
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2" style="margin-bottom: 5rem !important;">
                            <a class="btn-sm icon btn-danger dltButton"  data-url="{{ url('admin/member_delete',$value->id) }}" data-replaceurl="{{ url('admin/committee_members',$id) }}" title="Delete Member">x</a>
                              @if(!empty($value->image)) 
                              <img class="w-100 active" src="{{ asset('uploads/'.$value->image) }}" data-bs-slide-to="0">
                              @else
                              <img class="w-100 active" src="{{ asset('assets/img/avatar.svg') }}" style ="min-height: 83%;" data-bs-slide-to="0">
                              @endif
                                <span>{{ $value->name }}</span><br>
                                <span>{{ $value->title }}</span>
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