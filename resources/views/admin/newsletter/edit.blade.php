
@extends('admin.layout.main')
@section('content')
<div class="content">
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                            News Letter
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 lg:col-span-12">
                            <!-- BEGIN: Input -->
                            <div class="intro-y box">
                                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                                    <h3 class="font-medium text-base mr-auto">
                                        Update
                                    </h3>
                                    <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                                   <a href="" class="btn btn-primary w-32 ml-2">Show</a>
                                    </div>
                                </div>
                                

        <form method="post" action="{{ url('admin/newsletter_update',$data->id) }}"  enctype="multipart/form-data">
                    @csrf
                    
            <div class="grid grid-cols-12 gap-4 gap-y-3 p-3">

                <div class="col-span-6">
                        <label for="input-filter-1" class="form-label text-xs">Title</label>
                        <input type="text" name="title" value="{{ $data->title }}" class="form-control flex-1 @error('title') border-danger @enderror" placeholder="Title">
                        @error('title')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                    </div>
                <div class="col-span-6"></div>
                
                <div class="col-span-6">
                        <label for="input-filter-2" class="form-label text-xs">Image</label>

                        <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4 @error('image') border-danger @enderror">
                            <div class="flex flex-wrap px-4">
                            <div class="w-24 h-24 relative image-fit img-preview-div mb-5 mr-5 ">
                                    <img class="rounded-md img-preview" id="img-preview">
                                    <span id="img-preview-rmv">
                                    <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> </div>
                                    </span>
                                    </div>
                            </div>
                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image w-4 h-4 mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> <span class="text-primary mr-1">Upload a Image</span>
                                <input type="file" id="image" name="image" data-value="{{ $data->image }}" class="w-full h-full top-0 left-0 absolute opacity-0  @error('image') border-danger @enderror">
                            </div>
                        </div>
                        @error('image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                </div>
                <div class="col-span-6">
                        <label for="input-filter-3" class="form-label text-xs">News File</label>
                       
                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4 @error('news_doc') border-danger @enderror">
                        <div class="flex flex-wrap px-4">
                        <div class="w-24 h-24 relative image-fit doc-preview-div mb-5 mr-5 ">
                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image w-4 h-4 mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="13 2 13 9 20 9"></polyline></svg>
                                <label  class="rounded-md doc-preview" id="doc-preview"></label>
                                <span id="doc-preview-rmv">
                                    <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> </div>
                                </span>
                        </div>
                        </div>
                        <div class="px-4 pb-4 flex items-center cursor-pointer relative ">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image w-4 h-4 mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="13 2 13 9 20 9"></polyline></svg> <span class="text-primary mr-1"> Upload a PDF</span>
                            <input type="file" id="doc" name="news_doc" data-value="{{ $data->news_file }}" class="w-full h-full top-0 left-0 absolute opacity-0">
                        </div>
                    </div>
                    @error('news_doc')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                </div>
                    
                <div class="col-span-12">
                        <label for="input-filter-5" class="form-label text-xs">Description</label>
                        <textarea id="input-filter-5" type="text" name="description" class="form-control flex-1  @error('description') border-danger @enderror" placeholder="Description" style="height: 250px;">{{ $data->description }}</textarea>
                        @error('description')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                </div>
                    
                <div class="col-span-12 flex items-center mt-3">
                        <a href="{{ url('admin/newsletter') }}" class="btn btn-secondary w-32 ml-auto">Back</a>
                        <button class="btn btn-primary w-32 ml-2">Update</button>
                </div>

            </div>
            </form>




                            </div>
                            <!-- END: Input -->
                        
                        </div>
                    </div>
                </div>

                @endsection