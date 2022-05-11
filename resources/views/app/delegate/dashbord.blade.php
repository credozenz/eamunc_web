@extends('app.delegate.layouts.layout')
@section('content')
   
<div class="container-fluid dasboard">
    
    <div class="row">
        
        <div class="col-md-8">
                <h4 class="dash-main-head">SOCHUM</h4>
                <p class="sub-head">Company Name</p>
                <h5 class="text-primary mt-5 mb-3">EAMUNC Guidelines Overview</h5>
                <ul>
                <li>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat</li>

                <li> Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.
                    Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus. </li>
                <li> Nam nulla quam, gravida non, commodo a, sodales sit amet, nisi.
                    Pellentesque fermentum dolor. Aliquam quam lectus, facilisis auctor, ultrices ut, elementum vulputate, nunc.
                    Sed adipiscing ornare risus. Morbi est est, blandit sit amet, sagittis vel, euismod vel, velit. Pellentesque egestas sem. </li>
                    <li>Suspendisse commodo ullamcorper magna.
                    Nulla sed leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                    Fusce lacinia arcu et nulla. </li>
                    <li>Nulla vitae mauris non felis mollis faucibus.
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</li>
                </ul>
            <button type="button" class="btn btn-primary "><i class="fa fa-calendar-o" aria-hidden="true"></i> View Program Schedule</button>
            <button type="button" class="btn btn-primary ms-3"><i class="fa fa-calendar-o" aria-hidden="true"></i> View Speakers List</button><br/>
            <a href="#" class="d-inline-block mt-5 fs-6 fw-bold text-primary text-decoration-underline" >View Program Resources</a>  
        </div>

        <div class="col-md-4">
            
            <div class="d-flex flex-row  mb-3">
                <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;">   Model
                United Nations Conference</h5>
            </div>

            <div class="d-grid">
                <button type="button" class="btn btn-primary "><i class="fa fa-file-text-o" aria-hidden="true"></i> Submit Liability Waiver Form</button>
            </div>
            
            <div class="commitee-box">
            
                <h6 class="text-primary">Comittee Members</h6>
                <div class="d-flex flex-row  mb-3">
                    <img src="assets/img/commitee/1.jpg" class="rounded-circle" alt="">
                    <p>Keerti Hegde</p>
                </div>

                <div class="d-flex flex-row  mb-3">
                    <img src="assets/img/commitee/1.jpg" class="rounded-circle" alt="">
                    <p>Keerti Hegde</p>
                </div>

                <div class="d-flex flex-row  mb-3">
                    <img src="assets/img/commitee/1.jpg" class="rounded-circle" alt="">
                    <p>Keerti Hegde</p>
                </div>

                <div class="d-flex flex-row  mb-3">
                    <img src="assets/img/commitee/1.jpg" class="rounded-circle" alt="">
                    <p>Keerti Hegde</p>
                </div>

                <div class="d-flex flex-row  mb-3">
                    <img src="assets/img/commitee/1.jpg" class="rounded-circle" alt="">
                    <p>Keerti Hegde</p>
                </div>

                <div class="d-flex flex-row  mb-3">
                    <img src="assets/img/commitee/1.jpg" class="rounded-circle" alt="">
                    <p>Keerti Hegde</p>
                </div>
                
                <div class="d-flex flex-row  mb-3 w">               
                </div>

            </div>
            
        </div>
            
    </div>

</div>
  
@endsection 
  
   
