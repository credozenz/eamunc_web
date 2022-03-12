@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">
            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">Past Conferences</h3>

                    <div class="row border-black p-0 mb-5">
                        <div class="col-md-6 p-0">
                            <img src="assets/img/conference/1.jpg" alt="" class="h-100" style="max-height:300px;">
                        </div>
                        <div class="col-md-6 py-4 px-5">
                            <div class="content h-100 lh-2 d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <h4 class="color-darkblue mb-3 mb-md-0">EAMUNC 2022 </h4>
                                <button class="download-btn">More Details</button>
                            </div>
                        </div>
                    </div>

                    <div class="row border-black p-0 mb-5">
                        <div class="col-md-6 p-0">
                            <img src="assets/img/conference/2.jpg" alt="" class="h-100" style="max-height:300px;">
                        </div>

                        <div class="col-md-6 py-4 px-5">
                            <div class="content h-100 lh-2 d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <h4 class="color-darkblue mb-3 mb-md-0">EAMUNC 2023 </h4>
                                <button class="download-btn">More Details</button>
                            </div>
                        </div>
                    </div>

                    <div class="row border-black p-0 mb-5">
                        <div class="col-md-6 p-0">
                            <img src="assets/img/conference/3.jpg" alt="" class="h-100" style="max-height:300px;">
                        </div>

                        <div class="col-md-6 py-4 px-5">
                            <div class="content h-100 lh-2 d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <h4 class="color-darkblue mb-3 mb-md-0">EAMUNC 2024 </h4>
                                <button class="download-btn">More Details</button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </section>
    @endsection