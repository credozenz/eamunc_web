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
            
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h3 class="font-medium text-base mr-auto">
                    Create  
                    </h3>
                </div>

                <!-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>                          
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif -->


            <form method="post" action="{{ url('admin/newsletter_store') }}"  enctype="multipart/form-data">
                    @csrf
            <div class="grid grid-cols-12 gap-4 gap-y-3 p-3">

                <div class="col-span-6">
                        <label for="input-filter-1" class="form-label text-xs text-danger">Title</label>
                        <input id="input-filter-1" type="text" name="title" value="{{ old('title') }}" class="form-control flex-1 @error('title') border-danger @enderror" placeholder="Title">
                        @error('title')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                    </div>
                <div class="col-span-6"></div>
                
                <div class="col-span-6">
                        <label for="input-filter-2" class="form-label text-xs text-danger">Image</label>
           
                <input type="file" name="image" class="form-control @error('image') border-danger @enderror">
                          
                        @error('image')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                </div>
                <div class="col-span-6">
                        <label for="input-filter-3" class="form-label text-xs text-danger">News File</label>
                       
                    <input type="file" name="news_doc" class="form-control @error('news_doc') border-danger @enderror">
                      
                    @error('news_doc')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                </div>
                    
                <div class="col-span-12">
                        <label for="input-filter-5" class="form-label text-xs text-danger">Description</label>
                        <textarea id="input-filter-5" type="text" name="description" class="form-control flex-1  @error('description') border-danger @enderror" placeholder="Description" style="height: 250px;">{{ old('description') }}</textarea>
                        @error('description')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                </div>
                    
                <div class="col-span-12 flex items-center mt-3">
                <a href="{{ url('admin/newsletter') }}" class="btn btn-secondary w-32 ml-auto">Back</a>
                        <button class="btn btn-primary w-32 ml-2">Submit</button>
                </div>

            </div>
            </form>


            </div>
        </div>
    </div>
</div>

                @endsection