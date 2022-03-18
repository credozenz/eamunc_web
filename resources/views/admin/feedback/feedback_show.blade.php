
@extends('admin.layout.main')
@section('content')


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Feedback</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/feedback') }}"> Feedback</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Show</li>
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
                        <h4 class="card-title">Show</h4>
                    </div>
                @if (!empty($feedback) && $feedback->count())
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Name</label>
                                             <input id="input-filter-5" type="text" value="{{ $feedback->delegate_name }}" class="form-control" placeholder="Name" >
                                    </div>
                                </div>  
                   
                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                         <label class="form-label text-danger">Email</label>
                                             <input id="input-filter-5" type="text" value="{{ $feedback->email }}" class="form-control" placeholder="Email" >
                   
                                    </div>
                                </div> 

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                         <label class="form-label text-danger">Committee</label>
                                             <input id="input-filter-5" type="text" value="{{ $feedback->committee_name }}" class="form-control" placeholder="Committee" >
                   
                                    </div>
                                </div> 

                                <div class="col-md-6 col-6">
                                    <div class="form-group">
                                         <label class="form-label text-danger">Country</label>
                                             <input id="input-filter-5" type="text" value="{{ $feedback->country }}" class="form-control" placeholder="Country" >
                   
                                    </div>
                                </div> 
                                
                                

                            </div>
                        </div>
                    </div>
                @endif

                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label text-danger">Question</label>
                    <textarea id="input-filter-5" type="text" name="question" class="form-control @error('question') border-danger @enderror" placeholder="Question" style="height: 250px;">{{ $data->question }}</textarea>
                    @error('question')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
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