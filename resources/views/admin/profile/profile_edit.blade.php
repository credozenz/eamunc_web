
@extends('admin.layout.main')
@section('content')
<div class="content">
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                           Profile
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 lg:col-span-12">
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
                        <label for="input-filter-1" class="form-label text-xs">Name</label>
                        <input type="text" name="name" value="{{ $data->name }}" class="form-control flex-1 @error('title') border-danger @enderror" placeholder="Title">
                        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                    </div>
                <div class="col-span-6">
                <label for="input-filter-1" class="form-label text-xs">Email</label>
                        <input type="text" name="email" value="{{ $data->email }}" class="form-control flex-1 @error('title') border-danger @enderror" placeholder="Title">
                        @error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-span-6">
                        <label for="input-filter-2" class="form-label text-xs">Image</label>
                        <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4 @error('image') border-danger @enderror">
                            <div class="flex flex-wrap px-4">
                            <div class="w-24 h-24 relative image-fit  mb-5 mr-5 ">
                                 <img class="rounded-md img-preview" id="img-preview" src="{{ asset('uploads/'.$data->image) }}">
                            </div>
                            </div> 
                          
                        <input type="file" name="image" class="form-control  @error('image') border-danger @enderror">
                           
                        @error('image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                        </div>   
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