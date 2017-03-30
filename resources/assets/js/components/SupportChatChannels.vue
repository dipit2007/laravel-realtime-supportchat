<template>

                    <ul class="list-group">
                        <li class="list-group-item" v-for="item in supportchatchannels">
                            {{ item.channels }}  
                            <span class="pull-right">{{ item.created_at }}</span>
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
            getFeed() {
                console.log("getFeed");
                var self = this;
                return axios.get('/supportchat/create', {})
                .then(function(response) {
                    console.log(response);
                    self.supportchatchannels = response.channels;
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
