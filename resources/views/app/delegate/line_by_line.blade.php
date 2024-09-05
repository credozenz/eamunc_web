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
    
          <h5 class="text-primary mt-5 mb-3 fs-2">Line By Line</h5>
 <p class="fs-6">Once the draft resolution has been tabled/approved by the Bureau, it may be circulated around the committee or displayed for all delegates. Following this would be a line by line review of the draft resolution. Delegates can utilize this opportunity to make amendments. Changes by the committee as a whole are called amendments and each draft amendment must be formally proposed (i.e. tabled) to the conference. A proposed amendment can add a paragraph, delete a paragraph or modify an existing paragraph. The delegate making an amendment must support his/her claim with reasoning.</p>
          <label class="form-label text-dark">
          
          </label>
                <div class="col-md-12 col-12">
                   @if(!empty($line->content))
                    <div class="form-group place_here">
                    
                        <textarea id="view_editor" > {!! $line->content ?? '' !!}</textarea>
                      </div>
                     @else
                     <div class="form-group">
                      <div class="blue-box mt-3">
                                  <h4>Please wait !</h4>
                          <p class="mt-2 mb-3">This session has not started !</p>
                      </div>
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
            url: "{{url('app/delegate_load_line_by_line')}}",
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(res) {
                if (res['status'] == 1) {
                  $(".place_here").html(res['content']);
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
   
  
   
