@extends('layouts.app')

@section('pagecss')
<link href="{{ asset('css/chat.css') }}" rel="stylesheet">   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 ">
            <div class="panel panel-default supportchat-box supportchat-box-on chat-popup">
                <div class="panel-heading supportchat-head">

                    LIVE Channels

                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li>
                                <a href="#" id="chatroomrefresh">
                                    <i class="fa fa-refresh fa-fw"></i> Refresh
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

                <div class="panel-body supportchat-messages" style="max-height: 300px;overflow: auto;">
                    <supportchatchannels v-on:newsupportchatmessage="receivedNewSupportChatMessage" :user="{{ auth()->user() }}"></supportchatchannels>
                </div>
            </div>
        </div>
        <div class="col-md-8  col-sm-12">
            <div class="supportchat-box supportchat-box-on chat-popup" id="qnimate">
                
                <div class="supportchat-head">
                    <div class="supportchat-head-left pull-left"><img src="{{ asset('image/avatar.png') }}" alt="profile-img">
                        Connected USER : {{ $foruser->name }}
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
                

                    <supportchatmessagesforuseradminonly :user="{{ Auth::user() }}" :foruser="{{ $foruser }}"></supportchatmessagesforuseradminonly>


                <div class="supportchat-messages-footer">
                    <supportchatmessageformadminonly
                        v-on:messagesent="addNewSupportChatMessageFromAdmin" :user="{{ Auth::user() }}" :foruser="{{ $foruser }}" ></supportchatmessageformadminonly>
                    
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

