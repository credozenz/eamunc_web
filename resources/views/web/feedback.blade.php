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
                    <h3 class="color-darkblue mb-4">Feedback Form</h3>

                    <span class="blue-block"></span>

                    <div class="form-container">
                    <form method="post" action="{{ url('feedback-store') }}"  enctype="multipart/form-data">
                          @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">Delegate Name</label>
                                            <input type="text" name="delegate_name" value="{{ old('delegate_name') }}" class="form-control @error('delegate_name') border-danger @enderror" {{ $errors->has('delegate_name') ? 'autofocus' : '' }} aria-describedby="textHelp" placeholder="Delegate Name">
                                            @error('delegate_name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">Email</label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') border-danger @enderror" {{ $errors->has('email') ? 'autofocus' : '' }} aria-describedby="textHelp" placeholder="Email">
                                            @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">Committee*</label>
                                        <select class="form-control" name="committee" placeholder="Select" required>
                                            <option value=''> Select your choice </option>
                                            @foreach ($committees as $key => $value)
                                            <option value="{{ $value->id ?? '' }}" {{ (old('committee') == $value->id ? "selected":"") }}> {{ $value->name ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group w-70">
                                        <label for="">Country Represented</label>
                                        <input type="text" name="country" value="{{ old('country') }}" class="form-control @error('country') border-danger @enderror" {{ $errors->has('country') ? 'autofocus' : '' }} aria-describedby="textHelp" placeholder="Country">
                                            @error('country')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                              
                              
                                <div class="col-12">
                                    <span class="spacer"></span>
                                </div>

                                @if (!empty($question) && $question->count())
                                   @foreach ($question as $key => $value)

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{ $value->question ?? '' }} </label>
                                        <input type="hidden" name="question[{{$key}}]" value="{{ $value->id ?? '' }}">
                                        <input type="text" name="answer[{{$key}}]" class="form-control" aria-describedby="textHelp"
                                            placeholder="Your Answer">
                                    </div>
                                </div>
                        
                                     @endforeach
                                 @endif

                               
                               
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