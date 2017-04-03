@extends('layouts.app')

@section('pagecss')
<link href="{{ asset('css/chat.css') }}" rel="stylesheet">           
@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-12">
            <div class="supportchat-box supportchat-box-on chat-popup" id="qnimate">
                
                <div class="supportchat-head">
                    <div class="supportchat-head-left pull-left"><img src="{{ asset('image/avatar.png') }}" alt="profile-img">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="supportchat-head-right pull-right">
                        <div class="btn-group">
                            <button class="chat-header-button" data-toggle="dropdown" type="button" aria-expanded="false">
                                <i class="glyphicon glyphicon-cog"></i> 
                            </button>
                            <ul role="menu" class="dropdown-menu pull-right">
                                <li><a href="#">Media</a></li>
                                <li><a href="#">Block</a></li>
                                <li><a href="#">Clear Chat</a></li>
                                <li><a href="#">Email Chat</a></li>
                            </ul>
                        </div>
                        <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button">
                            <i class="glyphicon glyphicon-off"></i>
                        </button>
                    </div>
                </div>
                

                    <supportchatmessages :user="{{ auth()->user() }}"></supportchatmessages>


                <div class="supportchat-messages-footer">
                    <supportchatmessageform v-on:messagesent="addNewSupportChatMessageFromUser" :user="{{ Auth::user() }}">
                        
                    </supportchatmessageform>
                    
                    @if(0)
                    <textarea id="status_message" placeholder="Type a message..." rows="10" cols="40" name="message"></textarea>
                    @endif
                    <div class="btn-footer">
                        <button class="bg_none"><i class="glyphicon glyphicon-film"></i> </button>
                        <button class="bg_none"><i class="glyphicon glyphicon-camera"></i> </button>
                        <button class="bg_none"><i class="glyphicon glyphicon-paperclip"></i> </button>
                        <button class="bg_none pull-right"><i class="glyphicon glyphicon-thumbs-up"></i> </button>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

@endsection
