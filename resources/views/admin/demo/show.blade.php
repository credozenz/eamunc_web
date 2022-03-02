
@extends('admin.layout.main')
@section('content')

                <div class="content">
                    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                        <h2 class="text-lg font-medium mr-auto">
                            View
                        </h2>
                        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                            <button class="btn btn-primary shadow-md mr-2">Edit</button>
                        </div>
                    </div>
                    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
                        <!-- BEGIN: Chat Side Menu -->
                        <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
                            
                            <div class="tab-content">
                                <div id="chats" class="tab-pane active" role="tabpanel" aria-labelledby="chats-tab">
                                    <div class="pr-1">
                                     <h2> Title</h2> 
                                    </div>
                                    <div class="chat__chat-list overflow-y-auto scrollbar-hidden pr-1 pt-1 mt-4">
                                          
                                        <div class="intro-x cursor-pointer box relative flex items-center p-5 mt-5">
                                        <img alt="Icewall Tailwind HTML Admin Template" class="rounded-full" src="http://127.0.0.1:8000/adminAssets/images/logo.svg">
                                        </div>
                                        <div class="intro-x cursor-pointer box relative flex items-center p-5 mt-5">
                                        <img alt="Icewall Tailwind HTML Admin Template" class="rounded-full" src="http://127.0.0.1:8000/adminAssets/images/logo.svg">
                                        </div>
                                        <div class="intro-x cursor-pointer box relative flex items-center p-5 mt-5">
                                        <img alt="Icewall Tailwind HTML Admin Template" class="rounded-full" src="http://127.0.0.1:8000/adminAssets/images/logo.svg">
                                        </div>
                                        <div class="intro-x cursor-pointer box relative flex items-center p-5 mt-5">
                                        <img alt="Icewall Tailwind HTML Admin Template" class="rounded-full" src="http://127.0.0.1:8000/adminAssets/images/logo.svg">
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Chat Side Menu -->


                        <div class="intro-y col-span-12 lg:col-span-8 2xl:col-span-9">
                            <div class="box">
                                <!-- BEGIN: Chat Active -->
                                
                                <div class="grid grid-cols-12 gap-4 gap-y-3 p-3">
                                    <div class="col-span-6">
                                        <label for="input-filter-1" class="form-label text-xs">From</label>
                                        <input id="input-filter-1" type="text" class="form-control flex-1" placeholder="example@gmail.com">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-2" class="form-label text-xs">To</label>
                                        <input id="input-filter-2" type="text" class="form-control flex-1" placeholder="example@gmail.com">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-3" class="form-label text-xs">Subject</label>
                                        <input id="input-filter-3" type="text" class="form-control flex-1" placeholder="Important Meeting">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-4" class="form-label text-xs">Has the Words</label>
                                        <input id="input-filter-4" type="text" class="form-control flex-1" placeholder="Job, Work, Documentation">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-5" class="form-label text-xs">Doesn't Have</label>
                                        <input id="input-filter-5" type="text" class="form-control flex-1" placeholder="Job, Work, Documentation">
                                    </div>
                                    <div class="col-span-6">
                                        <label for="input-filter-6" class="form-label text-xs">Size</label>
                                        <select id="input-filter-6" class="form-select flex-1">
                                            <option>10</option>
                                            <option>25</option>
                                            <option>35</option>
                                            <option>50</option>
                                        </select>
                                    </div>
                                   
                                </div>
                               
                                <!-- END: Chat Default -->
                            </div>
                        </div>


                        
                    </div>
                </div>
            </div>
                @endsection
