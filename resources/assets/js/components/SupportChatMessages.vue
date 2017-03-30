<template>

                    <ul class="list-group">
                        <li class="list-group-item" v-for="item in supportchatmessages">
                            {{ item.message }}  
                            <span class="pull-right">{{ item.created_at }}</span>
                        </li>
                    </ul>
                
    
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
            //this.getFeed();
            this.listenForRealtimeActivity();
        },
        methods: {
            getFeed() {
                var self = this;
                return axios.get('/api/supportchatmessages?api_token=' + this.user.api_token, {})
                .then(function(response) {
                    self.supportchatmessages = response.message.message;
                });
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
                        self.supportchatmessages.push({"message":"Support agent joined"});
                    })
                    .leaving(function (leavingMember, members) {
                        // runs when another member leaves
                        console.table(leavingMember);
                    })
                    .listen('SupportChatMessageEvent', (e) => {
                        console.log(e.message.message);
                        this.supportchatmessages.push(e.message);
                    })
                    .listenForWhisper('supportagentjoining', (e) => {
                        console.log(e.name);
                        this.supportchatmessages.push("Support agent joined : " + e.message);
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
