@extends('app.bureau.layouts.layout')
@section('content')
   
  <div class="container-fluid dasboard">
        <!-- Breadcrumbs-->
    <div class="row">    
        
      <div class="col-md-8">
        <h4 class="dash-main-head">{{ $committee->name ?? '' }}</h4>
        <p class="sub-head">{{ $committee->title ?? '' }}</p>
      </div>

      <div class="col-md-4">
        <div class="d-flex flex-row  mb-3">
          <a href="{{ url('') }}" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
          <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United Nations Conference </h5>
        </div>
      </div>

      <div class="col-md-12">
        <h4 class="fs-3 text-primary mb-3 mt-5">Block Formation</h4>
        <p style="color:#4D4D4D; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>    
      </div>

      <div class="col-md-10"> </div>
      <div class="col-md-2 mb-3">
        <button type="button" class="btn btn-primary mt-3" id="mdlbtn"><i class="fa fa-plus" aria-hidden="true"></i>  Create Block</button>
      </div>
      
      <div class="row mt-6 mb-3">

        @if($committee_bloc)
          @foreach($committee_bloc as $value)
          <div class="col-md-3 mb-3">
            <div class="bloc-box text-center">
                <h6>{{ ucfirst($value->name) ?? '' }}</h6>
                <a href="{{ url('app/bureau_bloc_show',$value->id) }}">View</a>
            </div>
          </div>
          @endforeach
        @endif
       
      
      </div>
     
    </div>

  </div>
   



  <!-- Button trigger modal -->
    <div class="blue block">
       <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Create Block</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  <form method="post" action="{{ url('app/bureau_bloc_store') }}" class="col-md-12"  enctype="multipart/form-data">
                            @csrf 
                    <div class="modal-body">
                          
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Block Name:</label>
                            <input type="text" class="form-control" name="name" id="recipient-name" maxlength="55" required>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Members:</label>
                            <div >
                              <select class="js-states form-control select2" name="user_id[]" multiple="multiple" style="width: 100%" required="">
                                <option value="">Select Member</option>
                                  @if($committee_member)
                                    @foreach($committee_member as $value)
                                    <option value="{{ $value->id }}" >{{ $value->name }}</option>
                                    @endforeach
                                  @endif
                              </select>
                            </div>
                          </div>
                      
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary close">Close</button>
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                </div>  
            </div>
        </div>
    </div>
  
@endsection 
  
   
