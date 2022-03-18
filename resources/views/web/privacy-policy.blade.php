@extends('web.layout.main')
@section('content')
<section id="hero" class="section-padding">
        <div class="wrapper">

            <div class="container">
                <div class="letter-container">

                    <h3 class="color-darkblue mb-4">Privacy Policy</h3>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="content border-black lh-2">
                                <div class="accordion accordion-flush" id="accordionFlushExample">

                                {!! $privacy_policy->description ?? '' !!}
                                   

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

   
    
    @endsection