@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Support Channels</div>

                <div class="panel-body" style="max-height: 300px;overflow: auto;">
                    <supportchatchannels v-on:newsupportchatmessage="receivedNewSupportChatMessage" :user="{{ auth()->user() }}"></supportchatchannels>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
