@extends('app.delegate.layouts.layout')
@section('content')
   
<div class="container-fluid dasboard my-profile">
        <!-- Breadcrumbs-->
           
        <div class="row">

          <div class="col-md-8">
            <h4 class="dash-main-head">{{ $committee->name ?? '' }}</h4>
            <p class="sub-head">{{ $committee->title ?? '' }}</p>
          </div>

          <div class="col-md-4">
            <div class="d-flex flex-row  mb-3">
              <a href="{{ url('') }}" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
              <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United Nations Conference </h5>
            </div>
          </div>  

          <div class="col-md-12">
            <h4 class="mb-3 mt-3 text-primary fs-3">General Assembly</h4>
            <p class="fs-6 mb-4">Below are the adopted resolutions of each committees accessible for
review.We encourage delegates to explore these resolutions as these
resolutions represent the culmination of extensive research, thought-
ful debate, and collaboration among delegates with various perspec-
tives.</p>

           <table class="table">         
            <tbody>
            @if(!empty($general_assembly[0]))
              @foreach($general_assembly as $key => $value)
              <tr class="pt-2 pb-2" style="border-bottom: 1px solid rgba(0, 0, 0, 0.2);">
                <td><span class="number-round ">{{ $key+1 }}</span></td>
                <td class="text-center"><h6 class="fw-light text-primary fs-5">{{ $value->committee_title ?? '' }}</h6></td>
                <td class="text-end">
                  <a href="{{ url('app/delegate_assembly_show',$value->id) }}" type="button" class="btn btn-primary ">View Resolution</a>
                </td>
              </tr>

              @endforeach
              @else

              <div class="blue-box mt-3 text-center">
                                    <h4>Please wait !</h4>
                            <p class="mt-2 mb-3">This session has not started !</p>
                        </div>
            @endif
              
              
            </tbody>
           </table>
          </div>
      
        </div>

</div>
   
@endsection 
  
   
