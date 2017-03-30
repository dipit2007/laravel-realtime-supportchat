<template>

                    <ul class="list-group">
                        <li class="list-group-item" v-for="(channel,key) in supportchatchannels">
                            <button class="btn btn-primary btn-sm" id="btn-chat" @click="joinChatChannel(key)">
                                Connect
                            </button>
                            {{ key }} --> {{ channel }}  
                            <span class="pull-right">{{ channel.created_at }}</span>
                        </li>
                    </ul>
                
    
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                supportchatchannels: []
            }
        },
        mounted() {
            console.log('Component mounted.')
            
        },
        created() {
            this.getFeed();
            //this.listenForRealtimeActivity();
        },
        methods: {
            joinChatChannel(channel){
                console.log("joinChatChannel");
                Echo.join(channel)
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
                        this.supportchatchannels.push(e.message);
                    });
            },
            getFeed() {
                console.log("getFeed");
                var self = this;
                return axios.get('/supportchat/create', {})
                .then(function(response) {
                    console.log(response.data);
                    self.supportchatchannels = response.data.channels;
                });
            },
            listenForRealtimeActivity() {
                Echo.join('support.' + this.user.id)
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
                        this.supportchatchannels.push(e.message);
                    });
            }
        }
    }
</script>
