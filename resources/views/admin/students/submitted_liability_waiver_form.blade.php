@extends('admin.layout.main')
@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Submitted Liability Waiver Forms</h3>

                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page"> List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success"><i class="bi bi-star"></i>{{ Session::get('success') }}</div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger"><i class="bi bi-file-excel"></i> {{ Session::get('error') }}</div>
        @endif

        <div class="page-content">
            <section class="section">

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-12 d-flex align-items-center">
                                        <div class="col-6 d-flex align-items-center">
                                            <form action="{{ url('/admin/submitted_liability_waiver_form') }}"
                                                method="get" class="input-group m-0">
                                                <input type="text" class="form-control search border-right-0"
                                                    placeholder="Search" id="main_q" name="q"
                                                    value="{{ $request->q ?? '' }}">
                                                <button class="btn-info">Search</button>
                                            </form>
                                        </div>
                                        <div class="col-5 m-4 d-flex align-items-center">

                                        </div>

                                        <div class="col-1">
                                            <a href="{{ url('/admin/submitted_liability_waiver_form') }}"
                                                class="text-dark mr-4"
                                                style="text-decoration: underline !important;">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">List</h5>

                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Uploaded Form</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (!empty($data) && $data->count())
                                            @php
                                                $currentPage = $data->currentPage();
                                                $itemsPerPage = $data->perPage();
                                                $startingRowNumber = ($currentPage - 1) * $itemsPerPage + 1;
                                            @endphp
                                            @foreach ($data as $key => $value)
                                                <tr>
                                                    <td class="text-bold-500">{{ $startingRowNumber }}</td>
                                                    <td class="text-bold-500">{{ $value->cntry_name }}</td>
                                                    <td class="text-bold-500">
                                                        <a href="{{ asset('uploads/' . $value->liability_form) }}"
                                                            target="_blank" rel="noopener noreferrer">View</a>
                                                    </td>

                                                </tr>
                                                @php
                                                    $startingRowNumber++;
                                                @endphp
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">There are no data.</td>
                                            </tr>
                                        @endif



                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @include('admin.layout.pagination', ['paginator' => $data])

                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
