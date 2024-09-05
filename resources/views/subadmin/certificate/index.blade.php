@extends('subadmin.layout.main')
@section('content')
         
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Certificate Settings</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('subadmin/banner') }}">Certificate</a></li>
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
                            <h5 class="card-title">Certificate Inputs</h5>
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                    <a class="btn-sm btn-primary shadow-md mr-2" onclick="openForm()">Add Inputs</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>

                        <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Index Name</th>
                                            <th>Index Value</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-bold-500">1</td>
                                        <td> %student_name% </td>
                                        <td> </td>
                                        <!-- <td></td> -->
                                    </tr>
                                    <tr>
                                        <td class="text-bold-500">2</td>
                                        <td>%committee_name%</td>
                                        <td> </td>
                                        <!-- <td></td> -->
                                    </tr>
                                   
                                    @if (!empty($data) && $data->count())
                                        @foreach ($data as $key => $value)
                                            <tr>
                                                <td class="text-bold-500">{{ $key+4 }}</td>
                                                <td>{{ $value->index_name }}</td>
                                                <td>
                                                   @if($value->index_type=='text') 
                                                     {{ $value->index_value }}
                                                   @elseif($value->index_type=='file')
                                                   <div class="w-30 h-30 relative image-fit  mb-2 mr-5 ">
                                                      <img alt="{{ $value->index_name }}" class="rounded-full" src="{{ $value->index_value }}" width="80px" height="50px">
                                                   </div>
                                                   @endif
                                                </td>
                                                <!-- <td>
                                                <a class="btn-sm btn-danger shadow-md mr-2 dltButton" data-url="{{ url('subadmin/certificate_input_delete',$value->id) }}" data-replaceurl="{{ url('subadmin/certificate_design') }}" title="Delete Setup">Delete</a>
                                                </td> -->
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
                </div>
                <div class="col-12">
                <div class="card table-responsive">
                <div class="card-header">
                            <h5 class="card-title">Certificate Design</h5>
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                </ol>
                            </nav>
                        </div>
                        <form method="post" action="{{ url('subadmin/certificate_design_store',$certi->id) }}"  enctype="multipart/form-data">
                        @csrf
                        <textarea name="certificate_design" style="width: 100%;height: 25rem;padding: 39px;">{{ $certi->certi_design }}</textarea>
                        <div class="col-12 d-flex mt-4 justify-content-end">
                                <a href="{{ url('subadmin/certificate_show') }}" class="btn btn-light-secondary me-1 mb-1">View</a>
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        </div>
                        </form>
                </div>
                
                </div>
            </div>
        </section>
    </div>
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

.hidden {
  display: none;
}


</style>


    <div class="form-popup" id="myForm">
        <div class="d-flex justify-content-end">
           <button type="button" class="btn cancel btn-sm btn-danger shadow-md mr-2" onclick="closeForm()">X</button>
        </div>
           
            <form method="post" action="{{ url('subadmin/certificate_input_store') }}"  enctype="multipart/form-data" class="form-container">
                @csrf
                <h4>Add Inputs</h4>
                <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="name"><b>Type</b></label>
                        <select name="type" class="form-control intype @error('type') border-danger @enderror" {{ $errors->has('type') ? 'autofocus' : '' }} placeholder="Input Type" required>
                            <option value=""> Input Type </option>
                            <option value="text"> Text</option>
                            <option value="file"> File </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="name"><b>Name</b></label>
                        <input type="text" placeholder="Name" class="form-control" name="name" value="" required>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 intext hidden">
                        <div class="form-group ">
                            <label for="email"><b>Value</b></label>
                            <input type="text" placeholder="Value" class="form-control" name="value" value="" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 infile hidden">
                    <div class="form-group ">
                            <label for="email"><b>Image</b></label>
                            <input type="file" placeholder="Value" class="form-control" name="image" value="" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    
                </div>

                <button type="submit" class="btn-sm btn-Primary shadow-md mr-2">ADD</button>
                
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