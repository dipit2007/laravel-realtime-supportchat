<template>

                    <ul class="list-group">
                        <li class="list-group-item" v-for="item in supportchatmessages">
                            {{ item.message.message }}  
                            <span class="pull-right">{{ item.message.created_at }}</span>
                            <br/>-- {{ item.fromuser.name }} 
                        </li>
                    </ul>
                
    
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
            //this.getFeed();
            this.listenForRealtimeActivity();
        },
        methods: {
            getFeed() {
                var self = this;
                return axios.get('/api/supportchatmessages?api_token=' + this.foruser.api_token, {})
                .then(function(response) {
                    self.supportchatmessages = response.message.message;
                });
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
