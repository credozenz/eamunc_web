@extends('admin.layout.main')
@section('content')

<div class="content">
 
                    <div class="intro-y flex items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                        President Messages
                        </h2>
                    </div>

                  

                            <div class="intro-y box mt-5">
          <form method="post" action="{{ url('admin/president_messages_update') }}"  enctype="multipart/form-data">
                    @csrf                
                            <div class="grid grid-cols-12 gap-4 gap-y-3 p-3">
                            <div class="col-span-6">
        <label for="input-filter-1" class="form-label text-xs">Name</label>
        <input id="input-filter-1" type="text" name="name" value="{{ $data->name }}" class="form-control flex-1" placeholder="Name">
        @error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror
    </div>

    <div class="col-span-6">
        <label for="input-filter-1" class="form-label text-xs">Post</label>
        <input id="input-filter-1" type="text" name="post" value="{{ $data->post }}" class="form-control flex-1" placeholder="Post">
        @error('post')<div class="text-danger mt-2">{{ $message }}</div>@enderror
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
<div class="col-span-6"></div>
<div class="col-span-6">
        <label for="input-filter-1" class="form-label text-xs">Title</label>
        <input id="input-filter-1" type="text" name="title" value="{{ $data->title }}" class="form-control flex-1" placeholder="Title">
        @error('title')<div class="text-danger mt-2">{{ $message }}</div>@enderror
    </div>

    
<div class="col-span-12">
        <label for="input-filter-5" class="form-label text-xs">Description</label>
        <textarea type="text" name="description" class="form-control flex-1" placeholder="Description" style="height: 250px;">{{ $data->description }}</textarea>
        @error('description')<div class="text-danger mt-2">{{ $message }}</div>@enderror
</div>
    
<div class="col-span-12 flex items-center mt-3  w-32 ml-auto">
                        
                        <button class="btn btn-primary w-32 ml-2">Update</button>
                </div>

</div>
               
</form>
                            </div>










                </div>

                @endsection