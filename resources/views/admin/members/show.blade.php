
@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Member</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/school_delegates') }}">Members</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Show </li>
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

   
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Show</h4>
                        
                    </div>
                    <div class="card-content">

                    @if($type == '2')

                            <div class="card-body">
                                <div class="row">
                                <h4 class="color-darkblue mb-5">School Details</h4>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">School Name</label>
                                            <input type="text" name="name" value="{{ $school->name ?? '' }}" class="form-control" disabled placeholder="Title">
                      
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-2 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">School logo</label>
                                            <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                            @if(!empty($school->logo))
                                            <img alt="School logo" class="rounded-full" src="{{ asset('uploads/'.$school->logo) }}" width="150" height="80">
                                            @else
                                            <div class="stats-icon red">
                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                            </div>
                                            @endif
                                           </div>
                                        </div>
                                    </div>
                                   

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Faculty Advisor’s Name</label>
                                            <input type="text" name="advisor_name" value="{{ $school->advisor_name }}" class="form-control" disabled placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Email</label>
                                            <input type="text" name="email" value="{{ $school->email }}" class="form-control" disabled placeholder="class">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Mobile</label>
                                            <input type="text" name="mobile" value="{{ $school->mobile }}" class="form-control" disabled placeholder="Whatsapp no">
                                        </div>
                                    </div>

                                   
                                </div>
                            </div>


                        @endif

                            <div class="card-body">
                                <div class="row">
                                <h4 class="color-darkblue mb-5">Delegate Details</h4>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Name</label>
                                            <input type="text" name="name" value="{{ $data->name ?? '' }}" class="form-control" disabled placeholder="Title">
                      
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Email</label>
                                            <input type="text" name="email" value="{{ $data->email ?? '' }}" class="form-control" disabled placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Class & Section</label>
                                            <input type="text" name="class" value="{{ $data->class ?? '' }}" class="form-control" disabled placeholder="class">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">WhatsApp NO</label>
                                            <input type="text" name="whatsapp_no" value="{{ $data->whatsapp_no ?? '' }}" class="form-control" disabled placeholder="Whatsapp no">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">MUN Experience</label>
                                            <input type="text" name="mun_experience" value="{{ $data->mun_experience ?? '' }}" class="form-control" disabled placeholder="MUN Experience">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Bureau Member Experience</label>
                                            <input type="text" name="bureaumem_experience" value="{{ $data->bureaumem_experience ?? '' }}" class="form-control" disabled placeholder="MUN Experience">
                                        </div>
                                    </div>
                                   
                                    @if($user->role=='2')
                                    @php $role ="Delegates"; @endphp
                                    @elseif($user->role=='3')
                                    @php $role ="Bureau member"; @endphp
                                    @endif
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger"> Member Role</label>
                                            <div class="row">
                                            <div class="col-md-10 col-12">
                                            <input type="text" name="role" value="{{ $role }}" class="form-control" disabled placeholder="Role">
                                            </div>
                                            <div class="col-md-2 col-12">
                                            <div class="dropdown">
                                                <button class="btn btn-sm dropbtn form-control">Change Role</button>
                                                <div class="dropdown-content">
                                                @if($user->role=='2')
                                                <a class="btn btn-sm btn-warning shadow-md mr-2 roleButton"  data-url="{{ url('admin/member_rolechange',$user->id) }}" data-replaceurl="{{ url('admin/members_show',$id) }}" data-dataval="3" title="Role Change">Bureau member
                                                </a>
                                                
                                                @elseif($user->role=='3')
                                                <a class="btn btn-sm btn-info shadow-md mr-2 roleButton"  data-url="{{ url('admin/member_rolechange',$user->id) }}" data-replaceurl="{{ url('admin/members_show',$id) }}" data-dataval="2" title="Role Change">Delegates</a>
                                                
                                                @endif
                                               </div>
                                            </div>
                                            </div>
                                            </div>
                                           
                                        </div>
                                    </div>

                                  
                                   
                                    <div class="col-12 d-flex justify-content-end">
                                         <a href="{{ url('admin/members') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    </div>
                                </div>
                            </div>

                   

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

     @endsection

