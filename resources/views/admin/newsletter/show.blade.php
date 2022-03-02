
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
                            <h2 class="font-medium text-base mr-auto">
                                View
                            </h2>
                            <div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                            <a href="{{ url('admin/newsletter_edit',$data->id) }}" class="btn btn-primary shadow-md mr-2">Edit</a>
                          
                            <a class="btn btn-danger shadow-md mr-2" id="smallButton" data-attr="{{ url('admin/newsletter_delete',$data->id) }}" title="Delete Project">
                             Delete
                            </a>
                            </div>
                        </div>



                                <!-- BEGIN: Chat Active -->
                                <div class="grid grid-cols-12 gap-4 gap-y-3 p-3">

                <div class="col-span-6">
                        <label for="input-filter-1" class="form-label text-xs">Title</label>
                        <input id="input-filter-1" type="text" name="title" value="{{ $data->title }}" class="form-control flex-1" placeholder="Title" disabled>
                        
                    </div>
                <div class="col-span-6"></div>

                <div class="col-span-6">
                        <label for="input-filter-2" class="form-label text-xs">Image</label>
                        <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4 @error('image') border-danger @enderror">
                            <div class="flex flex-wrap px-4">
                            <div class="w-24 h-24 relative image-fit  mb-5 mr-5 ">
                                 <img class="rounded-md img-preview" id="img-preview">
                            </div>
                            </div> 
                        </div>     
                </div>
                <div class="col-span-6">
                        <label for="input-filter-3" class="form-label text-xs">News File</label>
                    
                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4 @error('news_doc') border-danger @enderror">
                        <div class="flex flex-wrap px-4">
                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 ">
                                <label  class="rounded-md doc-preview" id="doc-preview"></label >
                                <img class="rounded-md" src="{{asset('adminAssets/images/file_demo.png')}}"> 
                        </div>
                        </div>
                        
                    </div>
                   
                </div>
                    
                <div class="col-span-12">
                        <label for="input-filter-5" class="form-label text-xs">Description</label>
                        <textarea type="text" name="description" class="form-control flex-1" disabled  placeholder="Description" style="height: 250px;">{{ $data->description }}</textarea>
                       
                </div>
                    
                <div class="col-span-12 flex items-center mt-3">
                        <a href="{{ url('admin/newsletter') }}" class="btn btn-secondary w-32 ml-auto">Back</a>
                        
                </div>

                </div>
                               
                                <!-- END: Chat Default -->
                           
                    </div>
                </div>
            </div>
                @endsection

