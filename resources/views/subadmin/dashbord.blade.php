@extends('subadmin.layout.main')
@section('content')


<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">

                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                    <i class="fa fa-th-large" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold mb-4">Total<br> Committee</h6>
                                    <h6 class="font-extrabold mb-0">{{ $cmtecount }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                    <i class="fa fa-university" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold mb-4">Total<br> School</h6>
                                    <h6 class="font-extrabold mb-0">{{ $schoolcount }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section>
</div>

@endsection
