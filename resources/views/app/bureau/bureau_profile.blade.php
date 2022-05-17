@extends('app.bureau.layouts.layout')
@section('content')
   

      <div class="container-fluid dasboard add-speaker-page">
        <div class="row">
            <div class="col-md-4 offset-md-8">
              <div class="d-flex flex-row  mb-3">
              <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
              <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;">  {{ $committee->title ?? '' }} </h5>
              </div>    
            </div>
            <div class="col-md-12">
          
              <h5 class="text-primary mt-5 mb-3">Student Profile</h5>
                <div class="student-profile-box">
                  <div class="row">

                      <div class="col-md-3">
                              @if(!empty($member->image)) 
                                <img src="{{ asset('uploads/'.$member->image) }}" class="rounded-circle" alt="{{ $member->name ?? '' }}">
                                @else
                                <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $member->name ?? '' }}">
                                @endif
                      </div>

                      <div class="col-md-3">
                        <span class="mt-3">Delegate Name</span>
                        <p>{{ $member->name ?? '' }}</p>

                        <span class="mt-3">Class &amp; Section </span>
                        <p>{{ $member->class ?? '' }}</p>
                      </div>

                      <div class="col-md-3">
                        <span class="mt-3">Email</span>
                        <p>{{ $member->email ?? '' }}</p>

                        <span class="mt-3">Committee </span>
                        <p>{{ $committee->title ?? '' }}</p>
                      </div>

                      <div class="col-md-3">
                        <span class="mt-3">Country </span>
                        <p>{{ $country->name ?? '' }}</p>

                        <span class="mt-3">WhatsApp Number  </span>
                        <p>{{ $member->whatsapp_no ?? '' }}</p>
                      </div>

                  </div>
                </div>
          
            </div>
        </div>
      </div>
    
   
@endsection 
  
   
