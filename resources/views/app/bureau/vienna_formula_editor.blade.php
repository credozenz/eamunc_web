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
                    <a href="{{ url('') }}" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle"
                            aria-hidden="true"></i></a>
                    <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United
                        Nations Conference </h5>
                </div>
            </div>

            <div class="col-md-4 offset-md-8">
            </div>

            <div class="col-md-12 text-center">

                <h5 class="text-primary mt-5 mb-3 fs-2">Vienna Formula</h5>

                <label class="form-label text-dark">

                </label>
                <form method="post" class="vienna_formula_store" action="{{ url('app/bureau_vienna_formula_store') }}" class="mt-5 col-md-12"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 col-12">
                        <div class="form-group">

                            <textarea id="txt_editor" type="text" name="vienna" class="form-control @error('vienna') border-danger @enderror"
                                style="height: auto;">{{ $vienna->content ?? old('vienna') }}</textarea>
                            @error('vienna')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 "> Submit</button>
                </form>
                <div class="deligatevienna">
                    @foreach ($deligatevienna as $frmla)
                        <div class="col-md-12 col-12 mb-2 mt-3">
                            <h5>{{ $frmla->cntry_name }}</h5>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <textarea id="view_editor" type="text" class="form-control @error('vienna') border-danger @enderror"
                                    style="height: auto;">{{ isset($frmla->content) ? $frmla->content : '' }}</textarea>
                            </div>
                        </div>
                    @endforeach
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
        $('.vienna_formula_store').on('submit', function(e) {
            e.preventDefault();
            document.querySelectorAll('#txt_editor').forEach(function(editorElement) {
                var editor = tinymce.get(editorElement.id);
                if (editor) {
                    editor.save();
                }
            });

            var form = $(this)[0];
            var data = new FormData(form);
            var url = $(this).attr("action");
            var method = $(this).attr("method");

            $.ajax({
                url: url,
                type: method,
                dataType: 'json',
                data: data,
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res);
                    if (res['success'] == true) {
                        load_delegate_vienna();
                        document.querySelectorAll('#txt_editor').forEach(function(editorElement) {
                            tinymce.init({
                                target: editorElement,
                            });
                        });
                    } else {
                        alert(res['message']);
                    }
                },
                error: function(e) {
                    console.error('Error:', e);
                }
            });
        });
        function load_delegate_vienna() {
            $.ajax({
                url: "{{url('app/bureau_load_delegate_vienna')}}",
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(res) {
                    if (res['status'] == 1) {
                        $(".deligatevienna").html(res['deligatevienna']);
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
