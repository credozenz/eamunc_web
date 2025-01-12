@extends('app.vipuser.layouts.layout')
@section('content')
   
<div class="container-fluid dasboard add-speaker-page">      
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
        
        <h5 class="text-primary mt-5 mb-3">Position Papers</h5>
        <p style="color: #4D4D4D; font-size: 14px;"> </p>
        
        <div class="table-responsive dash-table">
          <table class="table table-bordered w-100">
            <thead>
              <tr>
                <th scope="col">Delegate Name</th>
                <th scope="col">Position Paper   </th>
              
              </tr>
            </thead>
            <tbody>

            @if($papers)
                @foreach($papers as $each)
              <tr>
                <td>
                    @if(!empty($each->avatar)) 
                        <img src="{{ asset('uploads/'.$each->avatar) ?? '' }}" alt="{{ $each->name ?? '' }}" class="float-start rounded-circle" style="width: 32px; height: 32px;">
                        @else
                        <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $each->name ?? '' }}" class="float-start rounded-circle" style="width: 32px; height: 32px;">
                      @endif
                  
                  <p class="d-inline float-start p-2 fw-bold">{{ $each->name ?? '' }}</p>
                </td>
                <td>
                  <a href="{{ asset('uploads/'.$each->paper) ?? '' }}" target="_blank"><span class="text-primary text-decoration-underline p-1">View Paper</span></a>
                
                  <a class="dltButton" data-url="{{ url('app/bureau_paper_delete',$each->paper_id) }}" data-replaceurl="{{ url('app/bureau_general_papers') }}" title="Delete Position Papers"><i class="fa fa-trash text-danger" aria-hidden="true" target="_blank"></i></a>
                </td>
              
              </tr>
                @endforeach
              @endif
            
            </tbody>
          </table>
        </div>
        
      
      </div>
          
      
    </div>
</div>
   
@endsection 
  
   
