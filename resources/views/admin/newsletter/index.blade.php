@extends('admin.layout.main')
@section('content')
         
<div class="page-heading">
    <h3>News Letter</h3>
</div>
<div class="page-content">
<section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Our Gallery</h5>
                    </div>
                    <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                            @if (!empty($data) && $data->count())
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td class="text-bold-500">{{ $key+1 }}</td>
                                        <td class="text-bold-500">{{ $value->title }}</td>
                                        <td>

                                        <div class="tabulator-cell" role="gridcell" tabulator-field="images" title="" style="width: 224px; text-align: center; display: inline-flex; align-items: center; justify-content: center; height: 64px;"><div class="flex lg:justify-center">
                                        <div class="intro-x w-10 h-10 image-fit">
                                            <img alt="{{ $value->title }}" class="rounded-full" src="{{ asset('uploads/'.$value->image) }}">
                                        </div>
    
                                        </td>
                                        <td>
                                        <a href="{{ url('admin/newsletter_show',$value->id) }}" class="btn btn-sm btn-primary w-24 mr-1 mb-2">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">There are no data.</td>
                                </tr>
                            @endif
                                   
                                </tbody>
                            </table>
                            {!! $data->links() !!}
                        </div>
                   
                </div>
            </div>
        </div>
    </section>
</div>
              
@endsection
