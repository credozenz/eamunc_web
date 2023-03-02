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
                    @foreach($blocs_chats as $key => $chat)

                    @if($chat->user_id == $member->user_id)

                      <div class="chat">
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
                            <p>
                            {{ $chat->message ?? '' }}
                            </p>
                            <time class="chat-time" datetime="2015-07-01T11:37">{{ date("d-m-Y g:i a", strtotime($chat->created_at)) ?? '' }}</time>
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
                            <h6>{{ $chat->user_name ?? '' }}</h6>
                            <p> {{ $chat->message ?? '' }}</p>
                            <time class="chat-time" datetime="2015-07-01T11:39">{{ date("d-m-Y g:i a", strtotime($chat->created_at)) ?? '' }}</time>
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
                <form method="post" action="{{ url('app/bureau_chat_store',$id) }}" class="col-md-12"  enctype="multipart/form-data">
                                  @csrf 
                    <div class="input-group">
                      <input type="text" name="message" class="form-control" placeholder="Say something">
                      <span class="input-group-btn">
                        <button class="btn btn-outline-primary" type="submit" style="border-radius:0px  ;"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                      </span>
                    </div>
                </form>
              </div>

            </div>
            <!-- End Panel Chat -->
        
           
      
          </div>
     
      
        </div>

</div>
  
@endsection 
  
   
