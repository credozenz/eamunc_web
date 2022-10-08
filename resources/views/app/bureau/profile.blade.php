@extends('app.bureau.layouts.layout')
@section('content')
   

      <div class="container-fluid dasboard my-profile">
       
        <div class="row">
          <div class="col-md-8">
            <h4 class="mb-3 mt-3 text-primary fs-3">My Profile</h4>
           
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Bureau Name</label>
                  <input type="text" name="name" disabled value="{{ $member->name ?? '' }}" style="border: none;background: white;" class="form-control flex-1 @error('title') border-danger @enderror" placeholder="Title">
                     
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="text" name="email" disabled value="{{ $member->email ?? '' }}" style="border: none;background: white;" class="form-control flex-1 @error('email') border-danger @enderror" placeholder="Email">
                       
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Class &amp; Section</label>
                  <input type="text" name="class" disabled value="{{ $member->class ?? '' }}" style="border: none;background: white;" class="form-control flex-1 @error('class') border-danger @enderror" placeholder="Title">
                        
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Committee</label>
                  <select name="country_choice" disabled style="border: none;background: white;" class="form-control @error('country_choice') border-danger @enderror" {{ $errors->has('country_choice') ? 'autofocus' : '' }} placeholder="Country of Choice" required>
                      <option value="">Select Country of Choice</option>
                      @foreach ($countries as $key => $value)
                      <option value="{{ $value->id }}" {{ ($member->country_choice == $value->id ? "selected":"") }}> {{ $value->name ?? '' }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">Country </label>
                  <select name="committee_choice" disabled style="border: none;background: white;" class="form-control @error('committee_choice') border-danger @enderror" {{ $errors->has('committee_choice') ? 'autofocus' : '' }} placeholder="Committee of Choice" required>
                      <option value=""> Select Committee of Choice </option>
                      @foreach ($committees as $key => $value)
                      <option value="{{ $value->id ?? '' }}" {{ ($member->committee_choice == $value->id ? "selected":"") }}> {{ $value->name ?? '' }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label">WhatsApp Number </label>
                  <div class="row">
                  <!-- <div class="col-md-3 col-12">
                  <input type="text" name="phone_code" disabled value="{{ $member->phone_code }}" class="form-control" placeholder="Code">
                  </div> -->
                  <div class="col-md-12 col-12">
                  <input type="text" name="whatsapp_no" disabled style="border: none;background: white;" value="{{ $member->phone_code }} {{ $member->whatsapp_no }}" class="form-control user_phone @error('whatsapp_no') border-danger @enderror" {{ $errors->has('whatsapp_no') ? 'autofocus' : '' }} placeholder="WhatsApp Number" aria-describedby="textHelp" required>
                  </div>
                  </div>
                        @error('class')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                </div>
              </div>
            </div>
                <h4 class="mb-3 mt-3 text-primary  fs-3">Change Password</h4>
                <form method="post" action="{{ url('app/bureau_password') }}"  enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">New Password* </label>
                          <input type="password" name="password" value="" class="form-control @error('password') border-danger @enderror" placeholder="New Password">
                                            @error('password')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Confirm New Password* </label>
                          <input type="password" name="password_confirm" value="" class="form-control @error('password_confirm') border-danger @enderror" placeholder="Confirm New Password">
                                            @error('password_confirm')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary ">CONFIRM</button>
                </form>
          
          </div>

          <div class="col-md-4">
            <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;">  {{ $committee->title ?? '' }} </h5>
              <div class="text-center">
                  @if(!empty($member->avatar)) 
                  <img src="{{ asset('uploads/'.$member->avatar) }}" style="width: 150px;" class="rounded m-auto" alt="{{ $member->name ?? '' }}">
                  @else
                  <img src="{{ asset('assets/img/avatar.svg') }}" style="width: 150px;" class="rounded m-auto"  alt="{{ $member->name ?? '' }}">
                  @endif
                    <form method="post" id="avatar_form" action="{{ url('app/bureau_avatar') }}"  enctype="multipart/form-data">
                          @csrf
                      <label>
                        <input id="avatar" type="file" class="form-control-image" name="avatar" style="width: 0; height: 0;overflow: hidden;opacity: 0;">
                        <span class="btn rounded-circle edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                      </label>
                    </form>
              </div>
          </div>


          <div class="row">

          <div class="col-md-10">
          
          </div>

          <div class="col-md-2">
            <div class="d-flex flex-row  mb-3">
              <a href="{{ url('app/bureau_log_out') }}" class="text-danger fs-11 mt-2"><i class="fa fa-power-off" aria-hidden="true"></i>
              <span class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 37px;"> Sign Out </span></a>
            </div>
          </div>  

          </div>





        </div>

      </div>
    
   
@endsection 
  
   
