@extends('app.delegate.layouts.layout')
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
      
        <div class="col-md-12 text-center">
    
          <h5 class="text-primary mt-5 mb-3 fs-2">Vienna Formula</h5>
<p class="fs-6">Once each bloc has completed formulating their working papers, we move on to an important phase, i.e, merging of the various bloc positions to form a single complete draft resolution. This process is known as the Vienna formula and is facilitated by the bureau. One representative from each bloc sits together, with the chair acting as the mediator, and engage in dialogue in order to effectively merge the individual working papers</p>
          <label class="form-label text-dark">
           </label>
                <div class="col-md-12 col-12">
                    <div class="form-group">
                      
                    @if(isset($main_vienna->content))
                    <div class="col-md-12 col-12">
                      <div class="form-group main_vienna">
                        
                          <textarea id="view_editor" type="text" class="form-control @error('vienna') border-danger @enderror" style="height: auto;">{{ isset($main_vienna->content) ? $main_vienna->content : '' }}</textarea>
                      </div>
                  </div>
                    <form method="post" action="{{ url('app/delegate_vienna_formula_store') }}" class="mt-5 col-md-12"  enctype="multipart/form-data">
                      @csrf
                          <div class="col-md-12 col-12">
                              <div class="form-group">
                                
                                  <textarea id="txt_editor" type="text" name="vienna" class="form-control @error('vienna') border-danger @enderror" style="height: auto;">{{ isset($vienna->content) ? $vienna->content : '' }}</textarea>
                                  @error('vienna')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                              </div>
                          </div>
                          @if($main_vienna->is_closed == 0)
                          <button type="submit" class="btn btn-primary mt-3"> Submit</button>
                          @else
                          <button class="btn btn-danger mt-3" disabled> Closed</button>
                          @endif
                    </form>
                    @else
                     <div class="blue-box mt-3">
                                <h4>Please wait !</h4>
                         <p class="mt-2 mb-3">This session has not started !</p>
                     </div>
                     @endif



                  
                        
                    </div>
                </div>
                 
        </div>
      
    </div>

</div>
   

@endsection 
@section('script')
<script>
    $(function() {
        setInterval(function() {
            load_delegate_vienna();
        }, 30000);
    });

    function load_delegate_vienna() {
        $.ajax({
            url: "{{url('app/delegate_load_main_vienna')}}",
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(res) {
                if (res['status'] == 1) {
                  $(".main_vienna").html(res['main_vienna']);
                    tinymce.remove("#view_editor");
                    tinymce.init({
                      selector: '#view_editor',
                      menubar: false,
                      toolbar: false,
                      statusbar: false,
                      readonly:true
                    });

                } else {
                   
                }
            },
            error: function(e) {
            }
        });
    }
</script>
@stop
   
