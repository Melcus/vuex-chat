import api from '../api/all';

const state = {
    conversation : null,
    loadingConversation : false,
};

const getters = {
    currentConversation : state => {
        return state.conversation
    }
};

const actions = {
    getConversation({dispatch, commit}, id ) {

        api.getConversation(id).then((response) => {
            commit('setConversation', response.data.data)
        })

    }
};

const mutations = {
 setConversation (state, conversation) {
     state.conversation = conversation
 }
};

export default {
    state,
    getters,
    mutations,
    actions
}