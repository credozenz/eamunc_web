@extends('admin.layout.main')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Blocs</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/blocformation',$committee->id) }}">Blocs</a></li>
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
    <!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                  <form method="post" action="{{ url('admin/blocformation_store') }}" class="col-md-12"  enctype="multipart/form-data">
                            @csrf 
                    <div class="modal-body">
                          
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Bloc Name:</label>
                            <input type="text" class="form-control" name="name" maxlength="55" required>
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Committee:</label>
                              <select class="js-states form-control select2" name="committee_id" style="width: 100%" required="" readonly>
                                <option value="">Select Committee</option>
                                  @if($committee)
                                    <option value="{{ $committee->id }}" selected>{{ $committee->name }}</option>
                                  @endif
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Members:</label>
                            <div >
                              <select class="js-states form-control select2-multiple" name="user_id[]" multiple="multiple" style="width: 100%" required="">
                                <option value="">Select Delegates</option>
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
                    <a href="{{ url('admin/blocformation',$bloc->committe_id) }}" class="btn btn-light-secondary me-1 mb-1">Back</a>
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- // Basic multiple Column Form section end -->
</div>



 @endsection