
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
                        <li class="breadcrumb-item"><a href="{{ url('admin/students') }}">Student</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit </li>
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
                        <h4 class="card-title">Edit</h4>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ url('admin/student_update',$data->id) }}"  enctype="multipart/form-data">
                              @csrf
                                <div class="row">
                                  
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Name</label>
                                            <input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') border-danger @enderror" {{ $errors->has('name') ? 'autofocus' : '' }} placeholder="Delegate Name" aria-describedby="textHelp" required>
                                            @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Email</label>
                                            <input type="email" name="email" value="{{ $data->email  }}" class="form-control user_email @error('email') border-danger @enderror" {{ $errors->has('email') ? 'autofocus' : '' }} placeholder="Email" aria-describedby="textHelp" required>
                                            @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Class & Section</label>
                                            <input type="text" name="class" value="{{  $data->class }}" class="form-control @error('class') border-danger @enderror" {{ $errors->has('class') ? 'autofocus' : '' }} placeholder="Class & Section" aria-describedby="textHelp" required>
                                             @error('class')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">WhatsApp NO</label>
                                            <input type="text" name="whatsapp_no" value="{{ $data->whatsapp_no }}" class="form-control user_phone @error('whatsapp_no') border-danger @enderror" {{ $errors->has('whatsapp_no') ? 'autofocus' : '' }} placeholder="WhatsApp Number with country code" aria-describedby="textHelp" required>
                                            @error('whatsapp_no')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">MUN Experience</label>
                                            
                                            <input type="text" name="mun_experience" value="{{ $data->mun_experience }}" class="form-control @error('mun_experience') border-danger @enderror" {{ $errors->has('mun_experience') ? 'autofocus' : '' }} placeholder="" required>
                                            @error('mun_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="text-danger">Bureau Member Experience</label>
                                            
                                            <input type="text" name="bureaumem_experience" value="{{ $data->bureaumem_experience }}" class="form-control @error('bureaumem_experience') border-danger @enderror" {{ $errors->has('bureaumem_experience') ? 'autofocus' : '' }} placeholder="" required>
                                            @error('bureaumem_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="">Committee of Choice*</label>
                                            <select name="committee_choice" class="form-control @error('committee_choice') border-danger @enderror" {{ $errors->has('committee_choice') ? 'autofocus' : '' }} placeholder="Committee of Choice" required>
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
                                            <label for="form-label">Country of Choice*</label>
                                            <input type="text" name="country_choice" value="{{ $data->country_choice }}" maxlength="80" class="form-control @error('country_choice') border-danger @enderror" {{ $errors->has('country_choice') ? 'autofocus' : '' }} placeholder="Country of Choice" aria-describedby="textHelp" required>
                                            @error('country_choice')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                           <label for="form-label">Status</label>
                                            <select name="status" class="form-control " placeholder="Committee of Choice" required="">
                                                <option value="0" {{ ($user->status == 0 ? "selected":"") }}> Pending</option>
                                                <option value="1" {{ ($user->status == 1 ? "selected":"") }}> Approve</option>
                                                <option value="1" {{ ($user->status == 2 ? "selected":"") }} disabled> Invite</option>
                                                <option value="1" {{ ($user->status == 3 ? "selected":"") }} disabled> Active</option>
                                                <option value="3" {{ ($user->status == 4 ? "selected":"") }}> Reject</option>
                                            </select>
                                        </div>
                                    </div>
                                       
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                        <label for="form-label">Role</label>
                                            <select name="role" class="form-control" id="role_member" placeholder="Role" required="">
                                                <option value="2" {{ ($user->role == 2 ? "selected":"") }}> Delegate</option>
                                                <option value="3" {{ ($user->role == 3 ? "selected":"") }}> Bureau member</option>
                                            </select>
                                        </div>
                                    </div>
                                        
                                    <div class="col-md-6 col-12" id="delegaterol" style="display:none;">
                                        <div class="form-group">
                                            <label for="form-label">Position</label>
                                            <input type="text" name="position" value="{{ $data->position }}" maxlength="80" class="form-control @error('position') border-danger @enderror" {{ $errors->has('position') ? 'autofocus' : '' }} placeholder="Position" aria-describedby="textHelp">
                                            @error('position')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                
                                    <div class="col-12 d-flex justify-content-end">
                                        <a href="{{ url('admin/students') }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
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
   
</div>

     @endsection

