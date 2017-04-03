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
        props: ['user', 'foruser'],
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
                return axios.get('/supportchat/history/' + this.foruser.id , {})
                .then(function(response) {
                    self.supportchatmessages = response.data;//message.message;
                });
            },
            handleScroll: function(e) {
                
            },
            listenForRealtimeActivity() {
                Echo.join('support.' + this.foruser.id)
                    .here(function (members) {
                        // runs when you join
                        console.table(members);
                    })
                    .joining(function (joiningMember, members) {
                        // runs when another member joins
                        console.table(joiningMember);
                    })
                    .leaving(function (leavingMember, members) {
                        // runs when another member leaves
                        console.table(leavingMember);
                    })
                    .listen('SupportChatMessageEvent', (e) => {
                        console.log(e.message.message);
                        this.supportchatmessages.push(e);
                    })
                    .whisper('supportagentjoining', {
                        name: this.user.name
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
