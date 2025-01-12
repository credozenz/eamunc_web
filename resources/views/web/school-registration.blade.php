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
                    @if(isset($reg_status->name) && $reg_status->name=='open')
                    <div class="form-container">
                    <form method="post" action="{{ url('school-registration-store') }}" id="school-regForm"  enctype="multipart/form-data">
                          @csrf
                            <div class="form-section mb-5">
                                <h4 class="color-darkblue mb-5">Faculty Advisor Details</h4>
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
                                            <input type="file" name="school_logo" value="{{ old('school_logo') }}" accept=".png, .jpg, .jpeg"  class="form-control img_valid @error('school_logo') border-danger @enderror" {{ $errors->has('school_logo') ? 'autofocus' : '' }} aria-describedby="textHelp" placeholder="School Logo">
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
                                            <label for="">Mobile Number with country code*</label>
                                            <div class="row">
                                         <div class="col-md-3">
                                         <input type="text" name="mob_code" value="{{ old('mob_code') }}" maxlength="15" class="form-control mob_code @error('mob_code') border-danger @enderror" {{ $errors->has('mob_code') ? 'autofocus' : '' }} placeholder="Code" aria-describedby="textHelp" required>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="phone" name="advisor_mobile" value="{{ old('advisor_mobile') }}" maxlength="15" class="form-control user_phone @error('advisor_mobile') border-danger @enderror" {{ $errors->has('advisor_mobile') ? 'autofocus' : '' }} aria-describedby="textHelp"
                                                placeholder="Mobile" required>
                                                </div>
                                                </div>
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
                                        <label for="form-label">Class*</label>
                                        <input type="text" name="class[]" value="{{ old('class.0') }}" maxlength="80" class="form-control @error('class') border-danger @enderror" {{ $errors->has('class') ? 'autofocus' : '' }} placeholder="Class" aria-describedby="textHelp" required>
                                        @error('class')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">WhatsApp Number with country code</label>
                                        <div class="row">
                                         <div class="col-md-3">
                                         <input type="text" name="phone_code[]" value="{{ old('phone_code.0') }}" maxlength="15" class="form-control user_phone @error('whatsapp_no') border-danger @enderror" {{ $errors->has('phone_code') ? 'autofocus' : '' }} placeholder="Code" aria-describedby="textHelp" >
                                        </div>
                                        <div class="col-md-9">
                                        <input type="text" name="whatsapp_no[]" value="{{ old('whatsapp_no.0') }}" maxlength="15" class="form-control user_phone @error('whatsapp_no') border-danger @enderror" {{ $errors->has('whatsapp_no') ? 'autofocus' : '' }} placeholder="WhatsApp Number" aria-describedby="textHelp" >
                                        </div>
                                        </div>
                                        @error('whatsapp_no')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Committee of Choice*</label>
                                        <select name="committee_choice[]" id="committee_choice" data-url="{{ url('committee_country') }}" class="form-control @error('committee_choice') border-danger @enderror" {{ $errors->has('committee_choice') ? 'autofocus' : '' }} placeholder="Committee of Choice" required>
                                            <option value=""> Select Committee of Choice </option>
                                            @foreach ($committees as $key => $value)
                                            <option value="{{ $value->id ?? '' }}" {{ (old('committee_choice') == $value->id ? "selected":"") }}> {{ $value->title ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('committee_choice')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Country of Choice*</label>
                                        <select name="country_choice[]" id="country_choice" class="form-control @error('country_choice') border-danger @enderror" {{ $errors->has('country_choice') ? 'autofocus' : '' }} placeholder="Country of Choice" required>
                                            <option value=""> Select Country of Choice </option>
                                            @foreach ($countries as $key => $value)
                                            <option value="{{ $value->id }}" {{ (old('country_choice') == $value->id ? "selected":"") }}> {{ $value->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_choice')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                             
                           
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">MUN Experience (if any)</label>
                                            <select name="mun_experience"  class="form-control @error('mun_experience') border-danger @enderror" {{ $errors->has('mun_experience') ? 'autofocus' : '' }}  aria-describedby="textHelp">
                                                <?php
                                                for ($i = 0; $i <= 20; $i++) {
                                                    echo "<option value=\"$i\">$i</option>";
                                                }
                                                ?>
                                            </select>
                                         @error('mun_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Bureau Member Experience</label>
                                            <select name="bureaumem_experience"  class="form-control @error('bureaumem_experience') border-danger @enderror" {{ $errors->has('bureaumem_experience') ? 'autofocus' : '' }}  aria-describedby="textHelp">
                                                <?php
                                                for ($i = 0; $i <= 10; $i++) {
                                                    echo "<option value=\"$i\">$i</option>";
                                                }
                                                ?>
                                            </select>
                                          @error('bureaumem_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Awards Received</label>
                                        <select name="awards_received"  class="form-control @error('awards_received') border-danger @enderror" {{ $errors->has('awards_received') ? 'autofocus' : '' }}  aria-describedby="textHelp">
                                                <?php
                                                for ($i = 0; $i <= 10; $i++) {
                                                    echo "<option value=\"$i\">$i</option>";
                                                }
                                                ?>
                                            </select>
                                         @error('awards_received')<div class="text-danger mt-2">{{ $message }}</div>@enderror
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
                    @else
                    <span class="spacer"></span>
                    <div class="row py-3">
                       
                      <div class="col-md-12 pe-0 pe-md-3 mb-3 mb-md-0 p-0">
                        
                            <button class="download-btn-inverse w-100 py-3">Registration for this event now closed !</button>
                        
                        </div>

                    </div>
                    @endif
                </div>
            </div>

        </div>
    </section>


    @endsection