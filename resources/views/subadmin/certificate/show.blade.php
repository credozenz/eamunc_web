
@extends('subadmin.layout.main')
@section('content')



<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3> Certificate</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('subadmin/banner') }}">Certificate</a></li>
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
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                
                        
                   <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('subadmin/certificate_design') }}" class="btn-sm btn-primary shadow-md mr-2">Design Settings </a>
                        </li>
                    </ol>
                    </nav>
                   
                   
                     
                       

                       
                        
                
            </div>
            {!! $html ?? '' !!}
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

     @endsection