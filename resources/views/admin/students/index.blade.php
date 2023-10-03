@extends('admin.layout.main')
@section('content')
         
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Students</h3>
               
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/students') }}">Students</a></li>
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
                                    <form action="{{ url('/admin/students') }}" method="get" class="input-group m-0"> 
                                    <input type="text" class="form-control search border-right-0" placeholder="Search" id="main_q" name="q" value="{{ $request->q ?? ''}}">
                                    <button class="btn-info">Search</button>
                                    </form>
                                    </div>
                                    <div class="col-5 m-4 d-flex align-items-center">
                                  
                                    </div>
                                    
                                    <div class="col-1">
                                    <a href="{{ url('/admin/students') }}" class="text-dark mr-4" style="text-decoration: underline !important;">Reset</a>
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
                        <form action="{{ url('/admin/students') }}" method="get" id="indexfilter"> 
                        <div class="row">
                        <div class="col-1 d-flex align-items-center">
                        </div>
                        
                                    <div class="col-9 d-flex align-items-center">
                                    <select name="school" class="custom-select mr-2 col-2 idx-school" style="border: hidden;text-align-last: end;">
                                    <option value="">School</option>
                                    @if(!empty($school) && $school->count())
                                       @foreach ($school as $key => $value)
                                    <option value="{{ $value->id }}" {{ ($request->school == $value->id ? "selected":"") }}>{{ $value->name }}</option>
                                       @endforeach
                                    @endif
                                    </select>
                                    <select name="r" class="custom-select mr-2 col-2 idx-role" style="border: hidden;text-align-last: end;">
                                    <option value="">Role</option>
                                    <option value="2" {{ ($request->r == '2' ? "selected":"") }}>Delegate</option>
                                    <option value="3" {{ ($request->r == '3' ? "selected":"") }}>Bureau member</option>
                                    </select>
                                    <select name="t" class="custom-select mr-2 col-2 idx-type" style="border: hidden;text-align-last: end;">
                                    <option value="">Type</option>
                                    <option value="1" {{ ($request->t == '1' ? "selected":"") }}>ISG Student</option>
                                    <option value="2" {{ ($request->t == '2' ? "selected":"") }}>Participating School Student</option>
                                    </select>
                                    <select name="s" class="custom-select mr-2 col-2 idx-status" style="border: hidden;text-align-last: end;">
                                    <option value="">Status</option>
                                    <option value="0" {{ ($request->s == '0' ? "selected":"") }}>Pending</option>
                                    <option value="1" {{ ($request->s == '1' ? "selected":"") }}>Approve</option>
                                    <option value="2" {{ ($request->s == '2' ? "selected":"") }}>Invite</option>
                                    <option value="3" {{ ($request->s == '3' ? "selected":"") }}>Active</option>
                                    <option value="4" {{ ($request->s == '4' ? "selected":"") }}>Reject</option>
                                    </select>
                                    <input type="checkbox" class="mr-1 col-1 idx-status" name="xls" value='1' {{ $request->xls == '1' ? 'checked' : '' }}> Excel Export
                                    </div>
                                    
                        </div>
                        </form>


                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Type</th>
                                        <th>School</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Invite</th>
                                    </tr>
                                </thead>
                                <tbody>

                            @if(!empty($data) && $data->count())
                            @php
                                $currentPage = $data->currentPage(); 
                                $itemsPerPage = $data->perPage(); 
                                $startingRowNumber = ($currentPage - 1) * $itemsPerPage + 1; 
                            @endphp
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td class="text-bold-500">{{ $startingRowNumber }}</td>
                                        <td class="text-bold-500">{{ $value->name }}</td>
                                        <td class="text-bold-500">{{ $value->class }}</td>
                                        <td class="text-bold-500">
                                            @if($value->type=='1')
                                             <span class="text text-secondary">ISG Student</span>
                                              @elseif($value->type=='2')
                                             <span class="text text-secondary">Participating School <br>Student</span>
                                            @endif
                                        </td>
                                        <td class="text-bold-500">
                                            @if($value->school_id=='0')
                                            {{ 'ISG' }}
                                            @else
                                            {{ $value->school_name }}
                                            @endif
                                        </td>
                                        <td class="text-bold-500">
                                        @if($value->role=='2')
                                             <span class="text text-primary">Delegate</span>
                                              @elseif($value->role=='3')
                                             <span class="text text-secondary">Bureau member</span>
                                            @endif
                                        </td>
                                        <td class="text-bold-500">
                                            @if($value->status=='0')
                                            <span class="text text-warning">Pending</span>
                                            @elseif($value->status=='1')
                                            <span class="text text-info">Approve</span>
                                            @elseif($value->status=='2')
                                            <span class="text text-success">Invite</span>
                                            @elseif($value->status=='3')
                                            <span class="text text-success">Active</span>
                                            @elseif($value->status=='4')
                                            <span class="text text-danger">Reject</span>
                                            @endif
                                        </td>
                                        <td>
                                        <a href="{{ url('admin/student_show',$value->id) }}" class="btn btn-sm btn-primary w-24 mr-1 mb-2">View</a>
                                        </td>
                                        <td>

                                            @if($value->status=='3')
                                            <span  class="text text-success w-24 mr-1 mb-2"> Active</span>
                                            @elseif($value->status=='4')
                                            <span  class="text text-danger w-24 mr-1 mb-2"> Rejected</span>
                                            @else
                                            <input type="checkbox" value="{{$value->id ?? ''}}" class="invitestudent checkbox-item" name="student">
                                           
                                            @endif
                                            
                                        </td>
                                    </tr>
                                    @php
                                        $startingRowNumber++;
                                    @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">There are no data.</td>
                                </tr>
                            @endif

                            <tr>
                                 <form method="post" action="{{ url('admin/student_bulk_invite') }}">
                                     @csrf   
                                    <td colspan="8">Invite Students 
                                        <input type="hidden" value="" name="students" id="students" required></td>
                                    <td colspan="1"> 
                                     <button type='submit' class="btn btn-sm btn-success w-24 mr-1 mb-2">Invite</button>
                                    </td>
                                </tr>
                                </form> 
                                   
                                </tbody>
                        </table>
                    </div>
                </div>              
                         
                    @include('admin.layout.pagination', ['paginator' => $data])
                     
            </div>
        </div>
    </section>
</div>
</div>
              
@endsection
