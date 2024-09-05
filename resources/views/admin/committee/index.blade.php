@extends('admin.layout.main')
@section('content')
         
<div class="page-heading">
<div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Committee</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/committee') }}">Committee</a></li>
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
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-12 d-flex align-items-center">
                                <div class="col-6 d-flex align-items-center">
                                    <form action="{{ url('/admin/committee') }}" method="get" class="input-group m-0"> 
                                    <input type="text" class="form-control search border-right-0" placeholder="Search" id="main_q" name="q" value="{{ $request->q ?? ''}}">
                                    <button class="btn-info">Search</button>
                                    </form>
                                    </div>
                                    <div class="col-5 d-flex align-items-center">
                                    </div>
                                    <div class="col-1 d-flex align-items-center">
                                    <a href="{{ url('/admin/committee') }}" class="text-dark mr-4" style="text-decoration: underline !important;">Reset</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Index</h5>
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/committee_create') }}" class="btn btn-primary shadow-md mr-2">Add</a>
                        </li>
                    </ol>
                    </nav>
                    </div>
                    <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Members</th>
                                        <th>Bloc Manage</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                            @if (!empty($data) && $data->count())
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td class="text-bold-500">{{ $key+1 }}</td>
                                        <td class="text-bold-500">{{ $value->name ?? '' }}  ({{ $value->title ?? '' }})</td>
                                        <td>
                                        <a href="{{ url('admin/committee_bureau',$value->id) }}" class="btn-sm btn-success shadow-md mr-2">Bureau Members</a>
                                        <a href="{{ url('admin/committee_delegate',$value->id) }}" class="btn-sm btn-warning shadow-md mr-2">Delegates</a>
                                        </td>
                                        <td>
                                        <a href="{{ url('admin/blocformation',$value->id) }}" class="btn-sm btn-info shadow-md mr-2">Bloc</a>
                                        </td>
                                        <td>
                                        <a href="{{ url('admin/committee_show',$value->id) }}" class="btn btn-sm btn-primary w-24 mr-1 mb-2">View</a>
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
