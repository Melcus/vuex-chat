import Vue from 'vue';
import Vuex from 'vuex';
import conversations from './modules/conversations';


Vue.use(Vuex);

export default new Vuex.Store({
    modules : {
        conversations
    }
})