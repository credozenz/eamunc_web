@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Users</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Create</li>
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
                    <h4 class="card-title">Create</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form method="post" action="{{ url('admin/users_store') }}"  enctype="multipart/form-data">
                        @csrf
                
                            <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                        <label class="form-label text-danger"> Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') border-danger @enderror" placeholder="Name" required>
                                        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Avatar</label>
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" class="form-control  @error('image') border-danger @enderror" required>
                                        <small>Image Dimension:443x161, Size below 3MB</small>
                                        @error('image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') border-danger @enderror" placeholder="Phone" required>
                                        @error('phone')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Email</label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') border-danger @enderror" placeholder="Email" required>
                                        @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Password</label>
                                        <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') border-danger @enderror" placeholder="Password" required>
                                        @error('password')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Confirm Password</label>
                                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') border-danger @enderror" placeholder="Confirm Password" required>
                                        @error('password_confirmation')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                               
                                <div class="col-12 d-flex justify-content-end">
                                <a href="{{ url('admin/committee') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
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