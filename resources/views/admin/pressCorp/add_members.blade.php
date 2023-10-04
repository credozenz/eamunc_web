@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Press Corp</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/press_corp') }}">Press Corp</a></li>
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
                        <h4 class="card-title">Add Press Corp Members</h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-content">
                                <div class="card-body">
                                <form method="post" action="{{ url('admin/press_corp_addmember') }}"  enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row">
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Name</label>
                                            <input type="text" name="name" value="{{ ($data->name) ?? '' }}" class="form-control" placeholder="Name">
                                            @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Image</label>
                                            @if(!empty($data->image))
                                                <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                                    <img class="rounded-md img-preview" src="{{ asset('uploads/'.$data->image) }}" style="width: 503px;">
                                                </div>
                                            @endif
                                            <input type="file" name="image" class="form-control  @error('image') border-danger @enderror">
                                            <small>Image Dimension:1080x480, Size below 3MB</small>
                                            @error('image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                        
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/press_corp') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    <button class="btn btn-primary me-1 mb-1">Add</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>


                <div class="page-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Members</h5>
                       
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @if (!empty($press_corp_members) && $press_corp_members->count())
                                    @foreach ($press_corp_members as $key => $value)
                                        <tr>
                                            <td class="text-bold-500">{{ $key+1 }}</td>
                                            <td class="text-bold-500">{{ $value->name }}</td>
                                            <td>

                                            <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                                <img alt="{{ $value->title }}" class="rounded-full" src="{{ asset('uploads/'.$value->image) }}" width="300" height="150">
                                            </div>
        
                                            </td>
                                            <td>
                                            <a href="{{ url('admin/press_corp_member_dlt',$value->id) }}" class="btn btn-sm btn-danger w-24 mr-1 mb-2">Delete</a>
                                        </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">There are no data.</td>
                                    </tr>
                                @endif
                                   
                                </tbody>
                        </table>
                    </div>
                </div>
                @include('admin.layout.pagination', ['paginator' => $press_corp_members]) 
               
                     
            </div>
        </div>
    </section>
</div>



            </div>
        </div>
    </section>
  
    <!-- // Basic multiple Column Form section end -->
</div>



 @endsection