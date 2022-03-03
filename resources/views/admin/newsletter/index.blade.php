@extends('admin.layout.main')
@section('content')

<div class="content">
 
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                           News Letter
                        </h2>
                    </div>

                    <div class="intro-y flex flex-col-reverse sm:flex-row items-center mt-5">
                        <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-slate-500"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg> 
                            <input type="text" class="form-control w-full sm:w-64 box px-10" placeholder="Search mail">
                        </div>

                                <div class="w-full sm:w-auto flex">
                                    <a href="{{ url('admin/newsletter_create') }}" class="btn btn-primary shadow-md mr-2">Add New</a>
                                    <div class="dropdown">
                                        <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                                            <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512"><line x1="32" y1="144" x2="480" y2="144" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="112" y1="256" x2="400" y2="256" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line x1="208" y1="368" x2="304" y2="368" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg> </span>
                                        </button>
                                        <div class="dropdown-menu w-40">
                                            <ul class="dropdown-content">
                                                <li>
                                                    <a href="" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512"><polyline points="176 249.38 256 170 336 249.38" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/><line x1="256" y1="181.03" x2="256" y2="342" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/><path d="M448,256c0-106-86-192-192-192S64,150,64,256s86,192,192,192S448,362,448,256Z" style="fill:none;stroke:currentColor;stroke-miterlimit:10;stroke-width:32px"/></svg>Ascending </a>
                                                </li>
                                                <li>
                                                    <a href="" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" fill="currentColor" viewBox="0 0 512 512"><polyline points="176 262.62 256 342 336 262.62" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/><line x1="256" y1="330.97" x2="256" y2="170" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/><path d="M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z" style="fill:none;stroke:currentColor;stroke-miterlimit:10;stroke-width:32px"/></svg> Descending </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="intro-y box mt-5">
                                
                                <div class="p-5" id="hoverable-table">
                                    <div class="preview">
                                        <div class="overflow-x-auto">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="whitespace-nowrap">#</th>
                                                        <th class="whitespace-nowrap">Title</th>
                                                        <th class="whitespace-nowrap">Image</th>
                                                        <th class="whitespace-nowrap">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @if (!empty($data) && $data->count())
                                                        @foreach ($data as $key => $value)
                                                            <tr>
                                                                <td>{{ $key+1 }}</td>
                                                                <td>{{ $value->title }}</td>
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






































                   




                </div>

                @endsection