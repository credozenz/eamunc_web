@extends('app.vipuser.layouts.layout')
@section('content')
   

   
<div class="container-fluid dasboard">
        <!-- Breadcrumbs--> 
       
        <div class="row">

          <div class="col-md-6">
              @if(!empty($blocs_members))
                    @foreach($blocs_members as $key => $each)
                        @if(!empty($each->avatar)) 
                        <img src="{{ asset('uploads/'.$each->avatar) ?? '' }}" alt="{{ $each->name ?? '' }}" title="{{ ucfirst($each->name) ?? '' }}" class="avatar rounded-circle d-inline-block" style="width: 40px; height: 40px;">
                        @else
                        <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $each->name ?? '' }}" title="{{ ucfirst($each->name) ?? '' }}" class="avatar rounded-circle d-inline-block" style="width: 40px; height: 40px;">
                        @endif
                @endforeach
              @endif

             <small class="text-primary mb-3 d-inline-block ps-2 "> {{ ucfirst($committee_bloc->name) ?? '' }} </small>
          </div>

          <div class="col-md-3 "></div>

          <div class="col-md-3 ">
            <h5 class="text-primary mb-3 d-inline-block ps-2 " style="line-height: 40px;">{{ ucfirst($committee->name) ?? '' }}</h5>
          </div>
            
          <div class="col-md-12">
       
      
            <!-- Panel Chat -->
            <div class="chat-box" id="chat">
          
              <div class="panel-body">
             
                <div class="chats disable-scrollbars chatscreen" style="max-height: 500px;min-height: 800px;">

                  @if(!empty($blocs_chats))
                    @foreach($blocs_chats as $key => $chat)

                    @if($chat->user_id == $member->user_id)

                      <div class="chat">
                        <div class="chat-avatar">
                          <a class="avatar avatar-online" data-toggle="tooltip"  data-placement="right" title="" data-original-title="{{ $chat->user_name ?? '' }}">  
                              @if(!empty($chat->avatar)) 
                              <img src="{{ asset('uploads/'.$chat->avatar) ?? '' }}" alt="{{ $chat->user_name ?? '' }}" title="{{ $chat->user_name ?? '' }}">
                              @else
                              <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $chat->user_name ?? '' }}" title="{{ $chat->user_name ?? '' }}">
                              @endif
                              <i></i>
                          </a>
                        </div>
                        <div class="chat-body">
                          <div class="chat-content">
                            
                          @if($chat->type == 'text')
                            <p>{{ $chat->message ?? '' }}</p>
                          @elseif($chat->type == 'image')
                            <img class="rounded-md img-preview" src="{{ asset('uploads/'.$chat->message) }}" style="width: 250px;">
                            @elseif($chat->type == 'file')
                            <a href="{{ asset('uploads/'.$chat->message) }}" download>
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M14.8875071,11.8306874 L12.9310336,11.8306874 L12.9310336,9.82301606 C12.9310336,9.54687369 12.707176,9.32301606 12.4310336,9.32301606 L11.4077349,9.32301606 C11.1315925,9.32301606 10.9077349,9.54687369 10.9077349,9.82301606 L10.9077349,11.8306874 L8.9512614,11.8306874 C8.67511903,11.8306874 8.4512614,12.054545 8.4512614,12.3306874 C8.4512614,12.448999 8.49321518,12.5634776 8.56966458,12.6537723 L11.5377874,16.1594334 C11.7162223,16.3701835 12.0317191,16.3963802 12.2424692,16.2179453 C12.2635563,16.2000915 12.2831273,16.1805206 12.3009811,16.1594334 L15.2691039,12.6537723 C15.4475388,12.4430222 15.4213421,12.1275254 15.210592,11.9490905 C15.1202973,11.8726411 15.0058187,11.8306874 14.8875071,11.8306874 Z" fill="#000000"/>
                                </g>
                            </svg>
                            </span> <small> Download File</small>
                            </a><br>
                            @endif

                            <time class="chat-time" >{{ date("d-m-Y g:i a", strtotime($chat->created_at)) ?? '' }}</time>
                          
                          
                            
                          
                          
                          </div>
                         
                        </div>
                      </div>

                    @else
            
                      <div class="chat chat-left">
                        <div class="chat-avatar">
                          <a class="avatar avatar-online" data-toggle="tooltip"  data-placement="right" title="" data-original-title="{{ $chat->user_name ?? '' }}">  
                              @if(!empty($chat->avatar)) 
                              <img src="{{ asset('uploads/'.$chat->avatar) ?? '' }}" alt="{{ $chat->user_name ?? '' }}">
                              @else
                              <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $chat->user_name ?? '' }}">
                              @endif
                            <i></i>
                          </a>
                        </div>
                        <div class="chat-body">
                          <div class="chat-content">
                          @if($chat->type == 'text')
                            <p>{{ $chat->message ?? '' }}</p>
                          @elseif($chat->type == 'image')
                            <img class="rounded-md img-preview" src="{{ asset('uploads/'.$chat->message) }}" style="width: 250px;">
                            @elseif($chat->type == 'file')
                            <a href="{{ asset('uploads/'.$chat->message) }}" download>
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M14.8875071,11.8306874 L12.9310336,11.8306874 L12.9310336,9.82301606 C12.9310336,9.54687369 12.707176,9.32301606 12.4310336,9.32301606 L11.4077349,9.32301606 C11.1315925,9.32301606 10.9077349,9.54687369 10.9077349,9.82301606 L10.9077349,11.8306874 L8.9512614,11.8306874 C8.67511903,11.8306874 8.4512614,12.054545 8.4512614,12.3306874 C8.4512614,12.448999 8.49321518,12.5634776 8.56966458,12.6537723 L11.5377874,16.1594334 C11.7162223,16.3701835 12.0317191,16.3963802 12.2424692,16.2179453 C12.2635563,16.2000915 12.2831273,16.1805206 12.3009811,16.1594334 L15.2691039,12.6537723 C15.4475388,12.4430222 15.4213421,12.1275254 15.210592,11.9490905 C15.1202973,11.8726411 15.0058187,11.8306874 14.8875071,11.8306874 Z" fill="#000000"/>
                                </g>
                            </svg>
                            </span> <small> Download File</small>
                            </a><br>
                            @endif

                            <time class="chat-time" >{{ date("d-m-Y g:i a", strtotime($chat->created_at)) ?? '' }}</time>
                          
                          
                         
                          
                          </div>
                        </div>
                      </div>
                      
                    @endif

                    @endforeach
                  @endif
                 
                </div>
                @include('app.bureau.layouts.chat_pagination',['paginator' => $blocs_chats])
              </div>

              <div class="panel-footer">
               
              </div>

            </div>
            <!-- End Panel Chat -->
        
           
      
          </div>
     
      
        </div>

</div>
  
@endsection 
  
   

   
