<template>

                    <div class="supportchat-messages"   @scroll="handleScroll">
                    <div class="direct-chat-messages">

                        <div v-for="item in supportchatmessages">

                        <div class="chat-box-single-line">
                            <abbr class="timestamp">{{ item.created_at }}</abbr>
                        </div>

                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg doted-border">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">{{ item.fromuser.name }}</span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <img alt="message user image" src="/image/avatar.png" class="direct-chat-img"><!-- /.direct-chat-img -->
                            
                            <div class="direct-chat-text">
                                {{ item.message }}
                            </div>
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-timestamp pull-right">{{ item.created_at }}</span>
                            </div>
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-img-reply-small pull-left">

                                </span>
                                <span class="direct-chat-reply-name">{{ item.fromuser.name }}</span>
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->


                        </div>

                    </div> <!-- .direct-chat-messages -->
                
                </div>
                
    
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                supportchatmessages: []
            }
        },
        mounted() {
            console.log('Component mounted.')
            
        },
        created() {
            this.getFeed();
            this.listenForRealtimeActivity();
        },
        methods: {
            getFeed() {
                var self = this;
                return axios.get('/supportchat/history/' + this.user.id, {})
                .then(function(response) {
                    console.log(response);
                    self.supportchatmessages = response.data; //message.message;
                });
            },
            handleScroll: function(e) {
                
            },
            listenForRealtimeActivity() {
                var self = this;
                Echo.join('support.' + this.user.id)
                    .here(function (members) {
                        // runs when you join
                        console.table(members);
                    })
                    .joining(function (joiningMember, members) {
                        // runs when another member joins
                        console.table(joiningMember);
                        //self.supportchatmessages.push({"message":"Support agent joined"});
                    })
                    .leaving(function (leavingMember, members) {
                        // runs when another member leaves
                        console.table(leavingMember);
                        //self.supportchatmessages.push({"message":"Support agent left"});
                    })
                    .listen('SupportChatMessageEvent', (e) => {
                        console.log(e);
                        this.supportchatmessages.push(e);
                    })
                    .listenForWhisper('supportagentjoining', (e) => {
                        console.log(e.name);
                        //this.supportchatmessages.push("Support agent joined : " + e.message);
                    });
            }
        },
        events: {
            'newsupportchatmessage' : function(data){
                // Your code. 
                this.supportchatmessages.push(data);
            },
        },
    }
</script>
