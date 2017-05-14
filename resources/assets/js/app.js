
require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex';

Vue.use(Vuex);

Vue.component('conversations-dashboard', require('./components/ConversationsDashboard.vue'));
Vue.component('conversations', require('./components/Conversations.vue'));
Vue.component('conversation', require('./components/Conversation.vue'));
Vue.component('conversation-reply-form', require('./components/forms/ConversationReplyForm.vue'));
Vue.component('conversation-form', require('./components/forms/ConversationForm.vue'));


import store from './store/index.js'

const app = new Vue({
    el: '#app',
    store
});
