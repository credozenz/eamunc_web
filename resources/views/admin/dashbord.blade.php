@extends('admin.layout.main')
@section('content')
            

            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total<br> ISG Students</h6>
                                    <h6 class="font-extrabold mb-0">{{ $Isg_count }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total<br> School Students</h6>
                                    <h6 class="font-extrabold mb-0">{{ $scoolDelecount }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                    <i class="fa fa-th-large" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total<br> Committee</h6>
                                    <h6 class="font-extrabold mb-0">{{ $cmtecount }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                    <i class="fa fa-university" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total<br> School</h6>
                                    <h6 class="font-extrabold mb-0">{{ $schoolcount }}</h6>
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
                            <h4></h4>
                        <center>
                                <h1>Registration</h1>
                                Students Registration 
                                @if(isset($reg_status->name) && $reg_status->name=='open') 
                                 <span class="label" style="color: green;"><b>Opend</b></span>
                                 @else
                                <span class="label" style="color: red;"><b>Closed</b></span>
                                @endif
                                <br><br>
                  
                            <form method="post" id="inaciveuser" style="display: none;" action="{{ url('admin/reg_status') }}">
                                @csrf
                                
                            <input type="checkbox" checked name="reg_status" class="checkbox toggle-checkbox"/>
                            </form>
                            @if(isset($reg_status->name) && $reg_status->name=='open') 
                            <label class="reg-closed"  onclick="if(confirm('Are you sure!, You Want Open Students registration ?')){ $(this).parent().find('#inaciveuser').submit() }">
                                        <p style="padding: 11px;text-color: white;color: white;"> Closed</p>
                            </label>         
                            @else
                            <label  class="reg-open"  onclick="if(confirm('Are you sure!, You Want Close Students registration ?')){ $(this).parent().find('#inaciveuser').submit() }">
                                        <p style="padding: 11px;text-color: white;color: white;"> Open</p>
                            </label>
                            @endif
                        </center>
                        </div>
                        <div class="card-body">
                        <div class="page-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Latest ISG Students</h5>
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Whatsapp NO</th>
                                        <th>Class & Section</th>
                                        <th>Country</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                            @if(!empty($delegate) && $delegate->count())
                                @foreach ($delegate as $key => $value)
                                    <tr>
                                        <td class="text-bold-500">{{ $key+1 }}</td>
                                        <td class="text-bold-500">{{ $value->name }}</td>
                                        <td class="text-bold-500">{{ $value->email }}</td>
                                        <td class="text-bold-500">{{ $value->phone_code }}-{{ $value->whatsapp_no }}</td>
                                        <td class="text-bold-500">{{ $value->class }}</td>
                                        <td class="text-bold-500">{{ $value->country_choice }}</td>

                                        <td>
                                        <a href="{{ url('admin/student_show',$value->id) }}" class="btn btn-sm btn-primary w-24 mr-1 mb-2">View</a>
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
                         
                    @include('admin.layout.pagination', ['paginator' => $delegate])
                     
            </div>
        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Latest Participating School Students</h5>
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Whatsapp NO</th>
                                        <th>Class & Section</th>
                                        <th>School</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                            @if(!empty($school) && $school->count())
                                @foreach ($school as $key => $value)
                                    <tr>
                                        <td class="text-bold-500">{{ $key+1 }}</td>
                                        <td class="text-bold-500">{{ $value->name }}</td>
                                        <td class="text-bold-500">{{ $value->email }}</td>
                                        <td class="text-bold-500">{{ $value->phone_code }}-{{ $value->whatsapp_no }}</td>
                                        <td class="text-bold-500">{{ $value->class }}</td>
                                        <td class="text-bold-500">{{ $value->school_name }}</td>

                                        <td>
                                        <a href="{{ url('admin/student_show',$value->id) }}" class="btn btn-sm btn-primary w-24 mr-1 mb-2">View</a>
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
                         
                    @include('admin.layout.pagination', ['paginator' => $school])
                     
            </div>
        </div>
    </section>
</div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
       
    </section>
</div>
              
@endsection