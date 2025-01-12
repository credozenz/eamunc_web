@extends('admin.layout.main')
@section('content')
         
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Conference Schedule</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/conference_schedule') }}">Conference Schedule</a></li>
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


<div class="page-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Index</h5>
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/conference_schedule_create') }}" class="btn btn-primary shadow-md mr-2">Add</a>
                        </li>
                    </ol>
                    </nav>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                            @if (!empty($data) && $data->count())
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td class="text-bold-500">{{ $key+1 }}</td>
                                        <td class="text-bold-500">{{ $value->title }}</td>
                                        <td class="text-bold-500"><h6>{{ date('d M Y l',strtotime($value->date)) }}</h6></td>
                                        <td>
                                        <a href="{{ url('admin/conference_schedule_show',$value->id) }}" class="btn btn-sm btn-primary w-24 mr-1 mb-2">View</a>
                                        <a class="btn btn-sm btn-danger shadow-md  w-24 mr-1 mb-2 dltButton"  data-url="{{ url('admin/conference_schedule_delete',$value->id) }}" data-replaceurl="{{ url('admin/conference_schedule') }}" title="Delete Project"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                         
                    @include('admin.layout.pagination', ['paginator' => $data])
                     
            </div>
        </div>
    </section>

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Conference Schedule Note</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                    <form method="post" action="{{ url('admin/conference_schedule_note') }}"  enctype="multipart/form-data">
                          @csrf
                    
                            <div class="row">
                            <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label class="form-label text-danger">Note</label>
                        <textarea id="input-filter-5" type="text" name="description" class="form-control @error('description') border-danger @enderror" placeholder="Description" style="height: 250px;">{{ $note->description ?? '' }}</textarea>
                        @error('description')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                  
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ url('admin/conference_schedule') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    <button class="btn btn-primary me-1 mb-1">Submit</button>
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
</div>
</div>             
@endsection
