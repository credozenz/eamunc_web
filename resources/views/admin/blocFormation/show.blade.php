@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Block</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/blocformation',$bloc->commitee_id) }}">Blocks</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Index</li>
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
                            <a href="{{ url('admin/blocformation_edit',$bloc->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                            <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('admin/blocformation_delete',$bloc->id) }}" data-replaceurl="{{ url('admin/blocformation',$bloc->committe_id) }}" title="Delete Bloc">Delete</a>
                        </li>
                    </ol>
                    </nav>
                </div>
                <div class="card-content">
                <div class="card-body">
                <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Bloc Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $bloc->name ?? ''}}" maxlength="55" disabled>
                            
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Committee:</label>
                            <input type="text" class="form-control" name="name" value="{{ $committee->name ?? ''}}" maxlength="55" disabled>
                          </div>

                <div class="row p-5">
                        <div class="col-12">
                            <h6 class="color-darkblue mb-4">Members</h6>
                        </div>

                @if (!empty($blocs_members) && $blocs_members->count())
                    @foreach ($blocs_members as $key => $value)    
                    <div class="col-lg-3 col-md-4 col-6 image-box mb-4">
                              @if(!empty($value->image)) 
                              <img src="{{ asset('uploads/'.$value->image) ?? '' }}" alt="{{ $value->name ?? '' }}">
                              @else
                              <img class="w-100 active" src="{{ asset('assets/img/avatar.svg') }}" style ="min-height: 93%;" data-bs-slide-to="0">
                              @endif
                       
                            <p class="mentor-name text-center">{{ $value->name ?? '' }}</p>
                            <p class="mentor-designation text-center color-blue"></p>
                    </div>
                    @endforeach
                @endif
                        
                </div>

               
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- // Basic multiple Column Form section end -->
</div>



 @endsection