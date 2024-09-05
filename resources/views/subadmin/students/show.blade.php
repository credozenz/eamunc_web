
@extends('subadmin.layout.main')
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
                            <li class="breadcrumb-item"><a href="{{ url('subadmin/students') }}">Student</a></li>
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
                                    <a href="{{ url('subadmin/student_edit',$data->id) }}" class="btn-sm btn-primary shadow-md mr-2">Edit</a>
                                    <!-- <a class="btn-sm btn-danger shadow-md mr-2 dltButton"  data-url="{{ url('subadmin/student_delete',$data->id) }}" data-replaceurl="{{ url('subadmin/students') }}" title="Delete Project">Delete</a> -->
                                    <a href="{{ url('subadmin/student_password',$data->id) }}" class="btn-sm btn-secondary shadow-md mr-2">Change Password</a>
                               
                                  <a class="btn-sm btn-primary shadow-md mr-2" onclick="openForm()">Generate Certificate</a>
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
                                            <div class="stats-icon green"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
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
                                            <label for="text-danger">Class</label>
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
                                            <label for="text-danger">Awards Received</label>
                                            <input type="text" name="awards_received" value="{{ $data->awards_received }}" class="form-control" disabled placeholder="Awards Received">
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








<style>
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  width: 800px;
  top: 10;
  right: 20%;
  border: 3px solid #f1f1f1;
  z-index: 9;
  background-color: white;
}

/* Add styles to the form container */
.form-container {
  max-width: 800px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password],.form-container input[type=date],.form-container select {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus,.form-container input[type=date]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

.blur {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 8;
  backdrop-filter: blur(5px);
}
</style>


    <div class="form-popup" id="myForm">
        <div class="d-flex justify-content-end">
           <button type="button" class="btn cancel btn-sm btn-danger shadow-md mr-2" onclick="closeForm()">X</button>
        </div>
           
            <form method="post" action="{{ url('subadmin/student_certificate',$data->id) }}"  enctype="multipart/form-data" class="form-container">
                @csrf
                <h4>Generate Certificate</h4>
                <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="name"><b>Full Name</b></label>
                        <input type="text" placeholder="Enter Full Name" name="name" value="{{ $data->name }}" required>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="name"><b>Committee Name</b></label>
                        <select name="committee_choice" class="form-control @error('committee_choice') border-danger @enderror" {{ $errors->has('committee_choice') ? 'autofocus' : '' }} placeholder="Committee of Choice" required>
                            <option value=""> Select Committee of Choice </option>
                            @foreach ($committees as $key => $value)
                            <option value="{{ $value->name ?? '' }}" {{ ($data->committee_choice == $value->id ? "selected":"") }}> {{ $value->name ?? '' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
              
                <div class="row">
                    
                </div>

                <button type="submit" class="btn-sm btn-Primary shadow-md mr-2">Generate</button>
                
            </form>
    </div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
  var blur = document.createElement("div");
  blur.classList.add("blur");
  document.body.appendChild(blur);
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  var blur = document.querySelector(".blur");
  blur.parentNode.removeChild(blur);
}
</script>