@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">
                    <h3 class="color-darkblue mb-4 text-center">Welcome to E.A.MUNC 2022</h3>

                    <div class="row my-5">
                    
                        <img src="{{ asset('assets/web/img/welcome.jpg') }}" alt="Registration for ISG Students" class="p-0">
                   
                    </div>


                    @if($reg_status->name=='open') 
                    <div class="row py-3">
                        <div class="col-md-6 pe-0 pe-md-3 mb-3 mb-md-0 p-0">
                        <a href="{{ route('isg-registration') }}" class="color-white">
                            <button class="download-btn-inverse w-100 py-3">Registration for ISG Students</button>
                        </a>
                        </div>
                        <div class="col-md-6 p-0">
                        <a href="{{ route('school-registration') }}" class="color-white">
                            <button class="download-btn w-100 py-3">Registration for Participating Schools</button>
                        </a>
                        </div>
                    </div>        
                    @else
                    <div class="row py-3">
                       
                      <div class="col-md-12 pe-0 pe-md-3 mb-3 mb-md-0 p-0">
                        
                            <button class="download-btn-inverse w-100 py-3">Registration for this event now closed !</button>
                        
                        </div>

                    </div>
                    @endif



                    
                </div>
            </div>

            <div class="container mt-5 py-3" id="contact_line">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-sm-6 col-12 py-3 text-center">
                        <p class="color-white text-center">Contact For Registration</p>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 py-3 text-center">
                        <p class="color-white text-center"><i class="fa fa-whatsapp"></i> +968 222 000 00</p>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 py-3 text-center">
                        <p class="color-white text-center"><i class="fa fa-envelope-o"></i> info@eamunc.com</p>
                    </div>
                </div>
            </div>

            <span class="spacer"></span>

        </div>
    </section>

    @endsection