@extends('web.layout.main')
@section('content')


        <section class="section-padding">
            <div class="wrapper">
                <div class="container">
                    <h3 class="color-darkblue mb-4">Terms of Service</h3>

                    <div class="row border-blue align-items-center">
                        
                        <div class="col-md-9">
                            <div class="content">
                                {!! $terms_service->description ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
  

    @endsection