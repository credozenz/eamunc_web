@extends('app.bureau.layouts.layout')
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
    

      <div class="col-md-6 text-center offset-md-3">
  
        <h5 class="text-primary mt-5 mb-3 fs-2">Vienna Formula</h5>
        <p class="fs-6">Once each bloc has completed formulating their working papers, we move on to an important phase, i.e, merging of the various bloc positions to form a single complete draft resolution. This process is known as the Vienna formula and is facilitated by the bureau. One representative from each bloc sits together, with the chair acting as the mediator, and engage in dialogue in order to effectively merge the individual working papers</p>
        @if(empty($vienna))
        <a href="{{ url('app/bureau_vienna_formula_editor') }}" type="button" class="btn btn-primary mt-3"> Start Session</a>
        @else
        <a href="{{ url('app/bureau_vienna_formula_editor') }}" type="button" class="btn btn-primary mt-3">View Vienna Formula</a>
        @endif
        @if($vienna->is_closed == 0)
          <button class="btn btn-danger mt-3" id="btn-close-vf">Close Vienna Formula</button>
        @else
          <button class="btn btn-danger mt-3" id="btn-close-vf" disabled>Vienna Formula Closed</button>
        @endif
      </div>
      
  </div>

</div>
   
@endsection 
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).on('click', '#btn-close-vf', function(e) {
    console.log('click');
    e.preventDefault();
    Swal.fire({
        title: 'Confirm',
        text: 'Are you sure you want to close this Vienna Formula?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Close',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route('app.bureau_vienna_formula_close',$vienna->id) }}',
                method: 'POST',
                data:{
                  _token:'{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            title: 'Closed!',
                            text: response.message,
                            icon: 'success',
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        Swal.fire({
                            title: 'Cancelled!',
                            text: response.message,
                            icon: 'error',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong while closing!',
                        icon: 'error',
                    });
                }
            });
        } else {
            Swal.fire({
                title: 'Cancelled',
                text: 'Your closing is cancelled.',
                icon: 'error',
            });
        }
    });
  });
</script>
@endsection
  
   
