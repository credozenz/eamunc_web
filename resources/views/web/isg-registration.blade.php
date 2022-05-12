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
                    <h3 class="color-darkblue mb-4">Registration for ISG Students</h3>

                    <div class="row mt-5">
                        <img src="{{ asset('assets/web/img/isg.jpg') }}" alt="">
                    </div>
                    <span class="spacer"></span>

                    <div class="form-container">
                    <form method="post" action="{{ url('isg-registration-store') }}"  enctype="multipart/form-data">
                          @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Delegate Name*</label>
                                        <input type="text" name="name" value="{{ old('name') }}" maxlength="80" class="form-control @error('name') border-danger @enderror" {{ $errors->has('name') ? 'autofocus' : '' }} placeholder="Delegate Name" aria-describedby="textHelp" required>
                                        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Email*</label>
                                        <input type="email" name="email" value="{{ old('email') }}" maxlength="80" class="form-control user_email @error('email') border-danger @enderror" {{ $errors->has('email') ? 'autofocus' : '' }} placeholder="Email" aria-describedby="textHelp" required>
                                        @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Class & Section*</label>
                                        <input type="text" name="class" value="{{ old('class') }}" maxlength="80" class="form-control @error('class') border-danger @enderror" {{ $errors->has('class') ? 'autofocus' : '' }} placeholder="Class & Section" aria-describedby="textHelp" required>
                                        @error('class')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Committee of Choice*</label>
                                        <select name="committee_choice" class="form-control @error('committee_choice') border-danger @enderror" {{ $errors->has('committee_choice') ? 'autofocus' : '' }} placeholder="Committee of Choice" required>
                                            <option value=""> Select Committee of Choice </option>
                                            @foreach ($committees as $key => $value)
                                            <option value="{{ $value->id ?? '' }}" {{ (old('committee_choice') == $value->id ? "selected":"") }}> {{ $value->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                        @error('committee_choice')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Country of Choice*</label>
                                        <input type="text" name="country_choice" value="{{ old('country_choice') }}" maxlength="80" class="form-control @error('country_choice') border-danger @enderror" {{ $errors->has('country_choice') ? 'autofocus' : '' }} placeholder="Country of Choice" aria-describedby="textHelp" required>
                                        @error('country_choice')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">WhatsApp Number with country code*</label>
                                        <input type="text" name="whatsapp_no" value="{{ old('whatsapp_no') }}" maxlength="15" class="form-control user_phone @error('whatsapp_no') border-danger @enderror" {{ $errors->has('whatsapp_no') ? 'autofocus' : '' }} placeholder="WhatsApp Number with country code" aria-describedby="textHelp" required>
                                        @error('whatsapp_no')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">MUN Experience (if any) *</label>
                                        <input type="text" name="mun_experience" value="{{ old('mun_experience') }}" maxlength="80" class="form-control @error('mun_experience') border-danger @enderror" {{ $errors->has('mun_experience') ? 'autofocus' : '' }} placeholder="MUN Experience (if any)" aria-describedby="textHelp" required>
                                        @error('mun_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="form-label">Bureau Member Experience*</label>
                                        <input type="text" name="bureaumem_experience" value="{{ old('bureaumem_experience') }}" maxlength="80" class="form-control @error('bureaumem_experience') border-danger @enderror" {{ $errors->has('bureaumem_experience') ? 'autofocus' : '' }} placeholder="Bureau Member Experience" aria-describedby="textHelp" required>
                                        @error('bureaumem_experience')<div class="text-danger mt-2">{{ $message }}</div>@enderror
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