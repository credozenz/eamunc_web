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
                    <h3 class="color-darkblue mb-4">Registration for Participating School</h3>

                    <div class="row mt-5">
                        <img src="{{ asset('assets/web/img/host.jpg') }}" alt="Registration for School">
                    </div>
                    <span class="spacer"></span>
      
                    <div class="form-container">
                    <form method="post" action="{{ url('school-registration-store') }}"  enctype="multipart/form-data">
                          @csrf
                            <div class="form-section mb-5">
                                <h4 class="color-darkblue mb-5">School Details</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">School Name*</label>
                                            <input type="text" name="school_name" value="{{ old('school_name') }}" maxlength="80" class="form-control @error('school_name') border-danger @enderror" {{ $errors->has('school_name') ? 'autofocus' : '' }} aria-describedby="textHelp" placeholder="School Name" required>
                                            @error('school_name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">School Logo</label>
                                            <input type="file" name="school_logo" value="{{ old('school_logo') }}"  class="form-control img_valid @error('school_logo') border-danger @enderror" {{ $errors->has('school_logo') ? 'autofocus' : '' }} aria-describedby="textHelp" placeholder="School Logo">
                                            @error('school_logo')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Faculty Advisor’s Name*</label>
                                            <input type="text" name="advisor_name" value="{{ old('advisor_name') }}" maxlength="80" class="form-control @error('advisor_name') border-danger @enderror" {{ $errors->has('advisor_name') ? 'autofocus' : '' }} aria-describedby="textHelp" placeholder="Faculty Advisor’s Name" required>
                                            @error('advisor_name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email*</label>
                                            <input type="email" name="advisor_email" value="{{ old('advisor_email') }}" maxlength="80" class="form-control user_email @error('advisor_email') border-danger @enderror" {{ $errors->has('advisor_email') ? 'autofocus' : '' }} aria-describedby="textHelp"
                                                placeholder="Email" required>
                                                @error('advisor_email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Mobile*</label>
                                            <input type="phone" name="advisor_mobile" value="{{ old('advisor_mobile') }}" maxlength="15" class="form-control user_phone @error('advisor_mobile') border-danger @enderror" {{ $errors->has('advisor_mobile') ? 'autofocus' : '' }} aria-describedby="textHelp"
                                                placeholder="Mobile" required>
                                                @error('advisor_mobile')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="form-section mb-5 student1">
                                <h4 class="color-darkblue mb-5">Student 1</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Delegate Name*</label>
                                        <input type="text" name="name[]" value="{{ old('name.0') }}" maxlength="80" class="form-control @error('name') border-danger @enderror" {{ $errors->has('name') ? 'autofocus' : '' }} placeholder="Delegate Name" aria-describedby="textHelp" required>
                                        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Email*</label>
                                        <input type="email" name="email[]" value="{{ old('email.0') }}" maxlength="80" class="form-control user_email @error('email') border-danger @enderror" {{ $errors->has('email') ? 'autofocus' : '' }} placeholder="Email" aria-describedby="textHelp" required>
                                        @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                           
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Class & Section*</label>
                                        <input type="text" name="class[]" value="{{ old('class.0') }}" maxlength="80" class="form-control @error('class') border-danger @enderror" {{ $errors->has('class') ? 'autofocus' : '' }} placeholder="Class & Section" aria-describedby="textHelp" required>
                                        @error('class')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">WhatsApp Number with country code*</label>
                                        <input type="text" name="whatsapp_no[]" value="{{ old('whatsapp_no.0') }}" maxlength="15" class="form-control user_phone @error('whatsapp_no') border-danger @enderror" {{ $errors->has('whatsapp_no') ? 'autofocus' : '' }} placeholder="WhatsApp Number with country code" aria-describedby="textHelp" required>
                                        @error('whatsapp_no')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                           
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">MUN Experience (if any) *</label>
                                        <input type="phone" name="mun_experience[]" value="{{ old('mun_experience.0') }}" maxlength="80" class="form-control @error('mun_experience') border-danger @enderror" {{ $errors->has('mun_experience') ? 'autofocus' : '' }} placeholder="MUN Experience (if any)" aria-describedby="textHelp" required>
                                        @error('mun_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Bureau Member Experience*</label>
                                        <input type="text" name="bureaumem_experience[]" value="{{ old('bureaumem_experience.0') }}" maxlength="80" class="form-control @error('bureaumem_experience') border-danger @enderror" {{ $errors->has('bureaumem_experience') ? 'autofocus' : '' }} placeholder="Bureau Member Experience" aria-describedby="textHelp" required>
                                        @error('bureaumem_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-section mb-5 student2">
                                <h4 class="color-darkblue mb-5">Student 2</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Delegate Name*</label>
                                        <input type="text" name="name[]" value="{{ old('name.1') }}" maxlength="80" class="form-control @error('name') border-danger @enderror" {{ $errors->has('name') ? 'autofocus' : '' }} placeholder="Delegate Name" aria-describedby="textHelp" required>
                                        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Email*</label>
                                        <input type="email" name="email[]" value="{{ old('email.1') }}" maxlength="80" class="form-control user_email @error('email') border-danger @enderror" {{ $errors->has('email') ? 'autofocus' : '' }} placeholder="Email" aria-describedby="textHelp" required>
                                        @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                           
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Class & Section*</label>
                                        <input type="text" name="class[]" value="{{ old('class.1') }}" maxlength="80" class="form-control @error('class') border-danger @enderror" {{ $errors->has('class') ? 'autofocus' : '' }} placeholder="Class & Section" aria-describedby="textHelp" required>
                                        @error('class')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">WhatsApp Number with country code*</label>
                                        <input type="phone" name="whatsapp_no[]" value="{{ old('whatsapp_no.1') }}" maxlength="15" class="form-control user_phone @error('whatsapp_no') border-danger @enderror" {{ $errors->has('whatsapp_no') ? 'autofocus' : '' }} placeholder="WhatsApp Number with country code" aria-describedby="textHelp" required>
                                        @error('whatsapp_no')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                           
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">MUN Experience (if any) *</label>
                                        <input type="text" name="mun_experience[]" value="{{ old('mun_experience.1') }}" maxlength="80" class="form-control @error('mun_experience') border-danger @enderror" {{ $errors->has('mun_experience') ? 'autofocus' : '' }} placeholder="MUN Experience (if any)" aria-describedby="textHelp" required>
                                        @error('mun_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Bureau Member Experience*</label>
                                        <input type="text" name="bureaumem_experience[]" value="{{ old('bureaumem_experience.1') }}" maxlength="80" class="form-control @error('bureaumem_experience') border-danger @enderror" {{ $errors->has('bureaumem_experience') ? 'autofocus' : '' }} placeholder="Bureau Member Experience" aria-describedby="textHelp" required>
                                        @error('bureaumem_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-section mb-5 student3">
                                <h4 class="color-darkblue mb-5">Student 3</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Delegate Name*</label>
                                        <input type="text" name="name[]" value="{{ old('name.2') }}" maxlength="80" class="form-control @error('name') border-danger @enderror" {{ $errors->has('name') ? 'autofocus' : '' }} placeholder="Delegate Name" aria-describedby="textHelp" required>
                                        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Email*</label>
                                        <input type="email" name="email[]" value="{{ old('email.2') }}" maxlength="80" class="form-control user_email @error('email') border-danger @enderror" {{ $errors->has('email') ? 'autofocus' : '' }} placeholder="Email" aria-describedby="textHelp" required>
                                        @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>      
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Class & Section*</label>
                                        <input type="text" name="class[]" value="{{ old('class.2') }}" maxlength="80" class="form-control @error('class') border-danger @enderror" {{ $errors->has('class') ? 'autofocus' : '' }} placeholder="Class & Section" aria-describedby="textHelp" required>
                                        @error('class')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">WhatsApp Number with country code*</label>
                                        <input type="phone" name="whatsapp_no[]" value="{{ old('whatsapp_no.2') }}" maxlength="15" class="form-control user_phone @error('whatsapp_no') border-danger @enderror" {{ $errors->has('whatsapp_no') ? 'autofocus' : '' }} placeholder="WhatsApp Number with country code" aria-describedby="textHelp" required>
                                        @error('whatsapp_no')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>     
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">MUN Experience (if any) *</label>
                                        <input type="text" name="mun_experience[]" value="{{ old('mun_experience.2') }}" maxlength="80" class="form-control @error('mun_experience') border-danger @enderror" {{ $errors->has('mun_experience') ? 'autofocus' : '' }} placeholder="MUN Experience (if any)" aria-describedby="textHelp" required>
                                        @error('mun_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Bureau Member Experience*</label>
                                        <input type="text" name="bureaumem_experience[]" value="{{ old('bureaumem_experience.2') }}" maxlength="80" class="form-control @error('bureaumem_experience') border-danger @enderror" {{ $errors->has('bureaumem_experience') ? 'autofocus' : '' }} placeholder="Bureau Member Experience" aria-describedby="textHelp" required>
                                        @error('bureaumem_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div id="dynamic_field"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" id="add-student" class="download-btn">Add More</button>
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