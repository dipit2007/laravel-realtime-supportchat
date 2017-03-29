
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('activity', require('./components/UserRealtimeActivity.vue'));
Vue.component('broadcastmessage-form', require('./components/BroadcastMessageForm.vue'));
Vue.component('supportchatmessages', require('./components/SupportChatMessages.vue'));

const app = new Vue({
    el: '#app',

    data: {
        messages: [],
        usersInRoom: []
    },

    created() {

        window.Echo.private('broadcastmessage')
            /*.here((users) => {
                this.usersInRoom = users;
            })
            .joining((user) => {
                this.usersInRoom.push(user);
            })
            .leaving((user) => {
                this.usersInRoom = this.usersInRoom.filter(u => u != user)
            })*/
            .listen('BroadcastMessageEvent', (e) => {
            	console.log(e);
                this.messages.push({
                    message: e.message.message,
                    //user: e.user
                });
            });
    },
    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addNewBroadcastMessage(message) {
            this.messages.push(message);

            axios.post('/broadcastmessage', message).then(response => {
              console.log(response.data);
            });
        },
        addNewSupportChatMessage(message) {
            //this.messages.push(message);

            axios.post('/supportchat', message).then(response => {
              console.log(response.data);
            });
        }
    }
});
