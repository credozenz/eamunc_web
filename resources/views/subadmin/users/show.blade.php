@extends('subadmin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>VIP Users</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('subadmin/users') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Show</li>
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
                       
                        <a href="{{ url('subadmin/users_edit',$data->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                            <!-- <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('subadmin/users_delete',$data->id) }}" data-replaceurl="{{ url('subadmin/users') }}" title="Delete Project">Delete</a> -->
                        </li>
                    </ol>
                    </nav>
                </div>
                <div class="card-content">
                  <div class="card-body">
                   
                            <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                        <label class="form-label text-danger"> Name</label>
                                        <input type="text" name="name" disabled value="{{ $data->name }}" class="form-control @error('name') border-danger @enderror" placeholder="Name">
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Avatar</label>
                                    @if(!empty($data->avatar))
                                        <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                 <img class="rounded-md img-preview" src="{{ asset('uploads/'.$data->avatar) }}" style="width: 103px;">
                                       </div>
                                    @endif
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Email</label>
                                        <input type="text" name="email" disabled value="{{ $data->email }}" class="form-control @error('email') border-danger @enderror" placeholder="Email">
                                       
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Phone</label>
                                        <input type="text" name="phone" disabled value="{{ $data->phone }}" class="form-control @error('phone') border-danger @enderror" placeholder="Phone">
                                       
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