<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Realtime Activity Dashboard</div>

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="item in activities">
                            {{ item.message }}  
                            <span class="pull-right">{{ item.created_at }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                activities: []
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
                return axios.get('/api/activities?api_token=' + this.user.api_token, {})
                .then(function(response) {
                    self.activities = response.message.message;
                });
            },
            listenForRealtimeActivity() {
                Echo.private('activity.' + this.user.id)
                    .listen('RealtimeActivityEvent', (e) => {
                        console.log(e.message.message);
                        this.activities.push(e.message);
                    });
            }
        }
    }
</script>
