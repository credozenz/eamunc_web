
@extends('admin.layout.main')
@section('content')

<div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Student</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin/school_delegates') }}">Student</a></li>
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
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('admin/student_edit',$data->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                                    <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('admin/student_delete',$data->id) }}" data-replaceurl="{{ url('admin/students') }}" title="Delete Project">Delete</a>
                                    <a href="{{ url('admin/student_password',$data->id) }}" class="btn-sm btn-secondary shadow-md mr-2">Change Password</a>
                                       
                                </li>
                            </ol>
                        </nav>
                    </div>

                    <div class="card-content">
                    @if($data->school_id != '0')
                        <div class="card-body">
                            <div class="row">
                                <h4 class="color-darkblue mb-5">School Details</h4>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">School Name</label>
                                            <input type="text" name="name" value="{{ $school->name }}" class="form-control" disabled placeholder="Title">
                      
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
                                <h4 class="color-darkblue mb-5">Student Details</h4>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Name</label>
                                            <input type="text" name="name" value="{{ $data->name }}" class="form-control" disabled placeholder="Title">
                      
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Email</label>
                                            <input type="text" name="email" value="{{ $data->email }}" class="form-control" disabled placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Class & Section</label>
                                            <input type="text" name="class" value="{{ $data->class }}" class="form-control" disabled placeholder="class">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">WhatsApp NO</label>
                                            <div class="row">
                                            <div class="col-md-3 col-12">
                                            <input type="text" name="phone_code" value="{{ $data->phone_code }}" class="form-control" disabled placeholder="Code">
                                            </div>
                                            <div class="col-md-9 col-12">
                                            <input type="text" name="whatsapp_no" value="{{ $data->whatsapp_no }}" class="form-control" disabled placeholder="Whatsapp no">
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">MUN Experience</label>
                                            <input type="text" name="mun_experience" value="{{ $data->mun_experience }}" class="form-control" disabled placeholder="MUN Experience">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Bureau Member Experience</label>
                                            <input type="text" name="bureaumem_experience" value="{{ $data->bureaumem_experience }}" class="form-control" disabled placeholder="MUN Experience">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="">Committee of Choice</label>
                                            <select name="committee_choice" disabled class="form-control @error('committee_choice') border-danger @enderror" {{ $errors->has('committee_choice') ? 'autofocus' : '' }} placeholder="Committee of Choice" required>
                                                <option value=""> Select Committee of Choice </option>
                                                @foreach ($committees as $key => $value)
                                                <option value="{{ $value->id ?? '' }}" {{ ($data->committee_choice == $value->id ? "selected":"") }}> {{ $value->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('committee_choice')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="form-label">Country of Choice</label>
                                            <select name="country_choice" disabled class="form-control @error('country_choice') border-danger @enderror" {{ $errors->has('country_choice') ? 'autofocus' : '' }} placeholder="Country of Choice" required>
                                                <option value=""> </option>
                                                @foreach ($countries as $key => $value)
                                                <option value="{{ $value->id }}" {{ ($data->country_choice == $value->id ? "selected":"") }}> {{ $value->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_choice')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
 
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                        <label for="form-label">Status</label>
                                            <select name="status" class="form-control " placeholder="Committee of Choice" required="" disabled>
                                                <option value="0" {{ ($data->status == 0 ? "selected":"") }}> Pending</option>
                                                <option value="1" {{ ($data->status == 1 ? "selected":"") }}> Approve</option>
                                                <option value="2" {{ ($data->status == 2 ? "selected":"") }} disabled> Invite</option>
                                                <option value="3" {{ ($data->status == 3 ? "selected":"") }} disabled> Active</option>
                                                <option value="4" {{ ($data->status == 4 ? "selected":"") }}> Reject</option>
                                            </select>
                                        </div>
                                    </div>
                                       
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                        <label for="form-label">Role</label>
                                            <select name="role" class="form-control" id="role_member" placeholder="Role" required="" disabled>
                                                <option value="2" {{ ($user->role == 2 ? "selected":"") }}> Delegate</option>
                                                <option value="3" {{ ($user->role == 3 ? "selected":"") }}> Bureau member</option>
                                            </select>
                                        </div>
                                      </div>
                                        
                                    </div>

                                    <div class="col-md-6 col-12" id="delegaterol" style="display:none;">
                                        <div class="form-group">
                                            <label for="form-label">Position</label>
                                            <input type="text" name="position" value="{{ $data->position }}" maxlength="80" class="form-control @error('position') border-danger @enderror" disabled>
                                            @error('position')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>     
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
     @endsection

