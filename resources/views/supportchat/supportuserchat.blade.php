@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Support Chat Messages 
                <span class="pull-right"> Connected USER : {{ $foruser->name }} </span>
                </div>

                <div class="panel-body" style="max-height: 300px;overflow: auto;">
                    <supportchatmessagesforuseradminonly :user="{{ Auth::user() }}" :foruser="{{ $foruser }}"></supportchatmessagesforuseradminonly>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Send Message</div>
                <div class="panel-body">
                    <supportchatmessageformadminonly
                        v-on:messagesent="addNewSupportChatMessageFromAdmin" :user="{{ Auth::user() }}" :foruser="{{ $foruser }}" ></supportchatmessageformadminonly>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
