@extends('web.layout.main')
@section('content')
    <section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
            @if(Session::has('success'))
            <div class="alert alert-success"><i class="bi bi-star"></i>{{ Session::get('success') }}</div>
             @elseif(Session::has('error'))
            <div class="alert alert-danger"><i class="bi bi-file-excel"></i> {{ Session::get('error') }}</div>
            @endif
                    <h3 class="color-darkblue mb-4">Alumni Registration</h3>

                    <div class="row mt-5">
                        <img src="{{ asset('assets/web/img/isg.jpg') }}" alt="">
                    </div>
                    <span class="spacer"></span>
                  
                    <div class="form-container">
                    <form method="post" id="alumni-regForm" action="{{ url('alumni-registration-store') }}"  enctype="multipart/form-data">
                          @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Name*</label>
                                        <input type="text" name="name" value="{{ old('name') }}" maxlength="80" class="form-control @error('name') border-danger @enderror" {{ $errors->has('name') ? 'autofocus' : '' }} placeholder="Name" aria-describedby="textHelp" required>
                                        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Email*</label>
                                        <input type="email" name="email" value="{{ old('email') }}" maxlength="80" class="form-control @error('email') border-danger @enderror" {{ $errors->has('email') ? 'autofocus' : '' }} placeholder="Email" aria-describedby="textHelp" required>
                                        @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Phone Number with Country Code</label>
                                        <div class="row">
                                         <div class="col-md-3">
                                         <input type="text" name="phone_code" value="{{ old('phone_code') }}" maxlength="15" class="form-control @error('phone_no') border-danger @enderror" {{ $errors->has('phone_code') ? 'autofocus' : '' }} placeholder="Code" aria-describedby="textHelp" >
                                        </div>
                                        <div class="col-md-9">
                                        <input type="text" name="phone_no" value="{{ old('phone_no') }}" maxlength="15" class="form-control @error('phone_no') border-danger @enderror" {{ $errors->has('phone_no') ? 'autofocus' : '' }} placeholder="Phone Number" aria-describedby="textHelp" >
                                        </div>
                                        </div>
                                        @error('phone_no')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Education Qualification*</label>
                                        <input type="text" name="qualification" value="{{ old('qualification') }}" maxlength="80" class="form-control qualification @error('qualification') border-danger @enderror" {{ $errors->has('qualification') ? 'autofocus' : '' }} placeholder="Education Qualification" aria-describedby="textHelp" required>
                                       
                                        @error('qualification')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Date of Birth*</label>
                                       
                                        <input type="date" name="dob" value="{{ old('dob') }}" maxlength="80" class="form-control dob @error('dob') border-danger @enderror" {{ $errors->has('dob') ? 'autofocus' : '' }} placeholder="Date of Birth" aria-describedby="textHelp" required>
                                       
                                        @error('country_choice')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                               
                            
                          
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Present Portfolio</label>
                                        <input type="text" name="portfolio" value="{{ old('portfolio') }}" maxlength="80" class="form-control @error('portfolio') border-danger @enderror" {{ $errors->has('portfolio') ? 'autofocus' : '' }} placeholder="Present Portfolio" aria-describedby="textHelp" >
                                        @error('portfolio')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="download-btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <span class="spacer"></span>
                  
                  
                </div>
            </div>

        </div>
    </section>
    @endsection