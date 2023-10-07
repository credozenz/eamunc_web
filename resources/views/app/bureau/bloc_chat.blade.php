@extends('app.bureau.layouts.layout')
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
             
                <div class="chats disable-scrollbars chatscreen" style="max-height: 500px;">

                  @if(!empty($blocs_chats))
                  @php  $timeDifference=0; @endphp
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
                          
                          
                            <form method="post" action="{{ url('app/bureau_chat_dlt',$chat->id) }}" class="col-md-12 mt-4"  enctype="multipart/form-data">
                                  @csrf 
                                  <hr>
                              <span class="input-group-btn">
                              <button class="btn btn-sm btn-outline-secondary" title="Delete" type="submit" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </span>
                    
                            </form>
                          
                          
                          </div>
                         
                        </div>
                      </div>

                      @php   
                      
                      $messageTimestamp = strtotime($chat->created_at);
                      $currentTimestamp = time();
                      $timeDifference = $currentTimestamp - $messageTimestamp;
                      @endphp

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
                          
                          
                            <form method="post" action="{{ url('app/bureau_chat_dlt',$chat->id) }}" class="col-md-12 mt-4"  enctype="multipart/form-data">
                                  @csrf 
                                  <hr>
                              <span class="input-group-btn">
                              <button class="btn btn-sm btn-outline-secondary" title="Delete" type="submit" style="font-size: 10px;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                              </span>
                    
                            </form>
                          
                          </div>
                        </div>
                      </div>
                      
                    @endif

                    @endforeach
                  @endif
                 
                </div>
                @include('app.bureau.layouts.chat_pagination',['paginator' => $blocs_chats])
              </div>
              @if($timeDifference >= 30)
              <div class="panel-footer">
                <form method="post" action="{{ url('app/bureau_chat_store',$id) }}" class="col-md-12"  enctype="multipart/form-data">
                                  @csrf 
                    <div class="input-group">
                      <label for="file-upload" class="btn btn-outline-primary mr-2"> 
                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <rect x="0" y="0" width="24" height="24"/>
                                  <path d="M14,16 L12,16 L12,12.5 C12,11.6715729 11.3284271,11 10.5,11 C9.67157288,11 9,11.6715729 9,12.5 L9,17.5 C9,19.4329966 10.5670034,21 12.5,21 C14.4329966,21 16,19.4329966 16,17.5 L16,7.5 C16,5.56700338 14.4329966,4 12.5,4 L12,4 C10.3431458,4 9,5.34314575 9,7 L7,7 C7,4.23857625 9.23857625,2 12,2 L12.5,2 C15.5375661,2 18,4.46243388 18,7.5 L18,17.5 C18,20.5375661 15.5375661,23 12.5,23 C9.46243388,23 7,20.5375661 7,17.5 L7,12.5 C7,10.5670034 8.56700338,9 10.5,9 C12.4329966,9 14,10.5670034 14,12.5 L14,16 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.500000, 12.500000) rotate(-315.000000) translate(-12.500000, -12.500000) "/>
                              </g>
                          </svg>
                        </span> 
                      </label>
                      <input type="text" id="msg" name="message" class="form-control" placeholder="Say something">
                      <label  id="crs" style="display:none; padding-left: 58px;color: red;position: absolute;">x</label>
                      <input id="file-upload" name='file' type="file" style="display:none;">
                      <span class="input-group-btn">
                        <button class="btn btn-outline-primary" type="submit" style="border-radius:0px  ;"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                      </span>
                    </div>
                </form>
              </div>
              @else
              <div class="text-center">
              <p class="btn btn-primary get-sendfield">  You have to wait 30 seconds before sending another message. </p>
              </div>
              
              @endif
            </div>
            <!-- End Panel Chat -->
        
           
      
          </div>
     
      
        </div>

</div>
  
@endsection 
  
   
