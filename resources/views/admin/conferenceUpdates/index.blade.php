@extends('admin.layout.main')
@section('content')
         
<div class="page-heading">
<div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Conference Updates</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/conference_updates') }}">Conference Updates</a></li>
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
                            <a href="{{ url('admin/conference_updates_create') }}" class="btn btn-primary shadow-md mr-2">Add</a>
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
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                            @if (!empty($data) && $data->count())
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td class="text-bold-500">{{ $key+1 }}</td>
                                        <td class="text-bold-500">{{ $value->title }}</td>
                                        <td>

                                        <div class="tabulator-cell" role="gridcell" tabulator-field="images" title="" style="width: 224px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"><div class="flex lg:justify-center">
                                        <div class="intro-x w-10 h-10 image-fit">
                                            <img alt="{{ $value->title }}" class="rounded-full" src="{{ asset('uploads/'.$value->image) }}">
                                        </div>
    
                                        </td>
                                        <td>
                                        <a href="{{ url('admin/conference_updates_show',$value->id) }}" class="btn btn-sm btn-primary w-24 mr-1 mb-2">View</a>
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
</div>
              
@endsection
