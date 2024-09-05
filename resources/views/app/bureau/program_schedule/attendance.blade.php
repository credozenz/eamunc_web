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
                    <a href="#" class="text-secondary fs-4 mt-2"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                    <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 22px;"> E.Ahamed Model United
                        Nations Conference </h5>
                </div>
            </div>

            <div class="col-md-12">
                <h5 class="text-primary mt-5 mb-3">Attendance</h5>

            </div>

            <div class="col-md-12">
                <form action="{{ url('app/bureau_program_attendance_export') }}" method="get" id="indexfilter"> 
                    <div class="col-12 d-flex justify-content-end mt-5">
                        <button class="btn btn-primary me-1 mb-1">Export</button>
                    </div>
                </form>
                <form method="post" action="{{ url('app/program_attendance_store') }}" enctype="multipart/form-data">
                    @csrf
                    @if (!empty($program_schedule) && $program_schedule->count())
                        @foreach ($program_schedule as $key => $value)
                            <h5 class="fs-5 text-primary mt-4 d-inline-block ">
                                {{ date('d F, Y (l)', strtotime($value['date'])) ?? '' }}</h5>
                            @if (!empty($value->time) && $program_schedule->count())
                                @foreach ($value->time as $tkey => $time)
                                    <p class="">
                                        {{ date('g:i a', strtotime($time->time_start)) ?? '' }} -
                                        {{ date('g:i a', strtotime($time->time_end)) ?? ('' ?? '') }}</p>

                                    <p class="">
                                        {{ $time->title ?? '' }}</p>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered mb-0" style="border: 1px solid #dee2e6">
                                                    <thead>
                                                        <tr style="font-weight: bold;">
                                                            <th style="border: 1px solid #dee2e6">Bureau Member</th>
                                                            <th style="border: 1px solid #dee2e6">Attendance
                                                                <input type="checkbox" class="chk_all"
                                                                    data-cls="chk_{{ $time->id }}_{{ $time->schedule_id }}">
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <input type="hidden" name="at[{{ $time->id }}][schedule_id]"
                                                            value="{{ $time->schedule_id }}">

                                                        <input type="hidden" name="at[{{ $time->id }}][time_id]"
                                                            value="{{ $time->id }}">

                                                        @foreach ($time->members as $mkey => $mval)
                                                            @if ($mval->role == 3)
                                                                <input type="hidden"
                                                                    name="at[{{ $time->id }}][user][]"
                                                                    value="{{ $mval->id }}">



                                                                <tr>
                                                                    <td style="border: 1px solid #dee2e6"
                                                                        class="text-bold-500">{{ $mval->name }}</td>
                                                                    <td style="border: 1px solid #dee2e6"
                                                                        class="text-bold-500">
                                                                        <input
                                                                            class="chk_{{ $time->id }}_{{ $time->schedule_id }}"
                                                                            type="checkbox"
                                                                            name="at[{{ $time->id }}][at][{{ $mval->id }}]"
                                                                            @if ($mval->at) checked @endif>
                                                                    </td>

                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-bordered mb-0" style="border: 1px solid #dee2e6">
                                                    <thead>
                                                        <tr style="font-weight: bold;">
                                                            <th style="border: 1px solid #dee2e6">Delegate</th>
                                                            <th style="border: 1px solid #dee2e6">Attendance
                                                                <input type="checkbox" class="chk_all"
                                                                    data-cls="chk_{{ $time->id }}_{{ $time->schedule_id }}_1">
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($time->members as $mkey => $mval)
                                                            @if ($mval->role == 2)
                                                                <input type="hidden"
                                                                    name="at[{{ $time->id }}][user][]"
                                                                    value="{{ $mval->id }}">

                                                                <tr>
                                                                    <td style="border: 1px solid #dee2e6"
                                                                        class="text-bold-500">{{ $mval->cntry_name }}</td>
                                                                    <td style="border: 1px solid #dee2e6"
                                                                        class="text-bold-500">
                                                                        <input
                                                                            class="chk_{{ $time->id }}_{{ $time->schedule_id }}_1"
                                                                            type="checkbox"
                                                                            name="at[{{ $time->id }}][at][{{ $mval->id }}]"
                                                                            @if ($mval->at) checked @endif>
                                                                    </td>

                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif

                    <div class="col-12 d-flex justify-content-end mt-5">
                        <button class="btn btn-primary me-1 mb-1">Submit</button>
                    </div>
                </form>

            </div>


        </div>
    </div>
@endsection
@section('script')
    <script>
        $(".chk_all").change(function() {
            cls = $(this).attr("data-cls");
            if ($(this).is(":checked")) {
                $("." + cls).attr("checked", true);
            } else {
                $("." + cls).attr("checked", false);
            }
        });
    </script>
@stop
