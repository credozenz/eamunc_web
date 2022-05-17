@extends('app.bureau.layouts.layout')
@section('content')
   
      <div class="container-fluid dasboard">
        <!-- Breadcrumbs-->
        
      
       
       
        <div class="row">
         
            
       <div class="col-md-8">
     <h4 class="fs-3 text-primary mb-3 mt-5">Bloc Formation</h4>
     
     <p style="color:#4D4D4D; font-size: 15px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip </p>

     
 
     
    </div>
    <div class="col-md-4">
      <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;">  E.Ahamed Model
        United Nations Conference</h5>
        <button type="button" class="btn btn-primary mt-3" id="mdlbtn"><i class="fa fa-plus" aria-hidden="true"></i>  Create Bloc</button>
      </div>
   
      <div class="row mt-5">
        <div class="col-md-3">
          <div class="bloc-box text-center">
            <h6>Lorem Bloc Name</h6>
            <a href="#">View</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="bloc-box text-center">
            <h6>Lorem Bloc Name</h6>
            <a href="#">View</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="bloc-box text-center">
            <h6>Lorem Bloc Name</h6>
            <a href="#">View</a>
          </div>
        </div>

        <div class="col-md-3">
          <div class="bloc-box text-center">
            <h6>Lorem Bloc Name</h6>
            <a href="#">View</a>
          </div>
        </div>
      
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
            <h5 class="modal-title" id="exampleModalLabel">Create Bloc</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
          <form>


          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Bloc Name:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Members:</label>
            <div >
            <select class="form-control select2" width=12px></select>
            </div>
          </div>
        </form>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary close">Close</button>
        <button type="button" class="btn btn-primary">Create</button>
      </div>
        </div>
 
      </div>
    </div>
 </div>
  
</div>
@endsection 
  
   
