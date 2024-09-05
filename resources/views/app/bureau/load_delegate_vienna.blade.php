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
