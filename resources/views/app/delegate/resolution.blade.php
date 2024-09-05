  
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
    
          <h5 class="text-primary mt-5 mb-3 fs-2">Resolution Corner</h5>
          <label class="form-label text-dark">
          Once all the changes have been made and amendments been added, 
the committee moves into the action phase. At this point in time, the
chair will ask the delegates if there are any objections to the draft 
resolution. If there are none, the draft resolution is adopted by consensus and is renamed resolution 1.1.
          </label>
                <div class="col-md-12 col-12">
                    
                    @if(isset($resolution->content))
                     <div class="form-group place_here">
                        <textarea id="view_editor" > {!! $resolution->content ?? '' !!}</textarea>
                     </div>
                     @else
                     <div class="form-group">
                     <div class="blue-box mt-3">
                                <h4>Please wait !</h4>
                         <p class="mt-2 mb-3">This session has not started !</p>
                     </div>
                     @endif
                    </div>
                    @if(!$accepted)
                    <form method="post" action="{{ url('app/delegate_resolution_accept') }}" class="mt-5 col-md-12"  enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-primary mt-3"> Accept</button>
                    </form>
                    @else

                    <button type="submit" class="btn btn-success mt-3"> <i class="fa fa-check-square-o" aria-hidden="true"></i> Accepted </button>
                    @endif
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
            url: "{{url('app/delegate_load_resolution')}}",
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
   