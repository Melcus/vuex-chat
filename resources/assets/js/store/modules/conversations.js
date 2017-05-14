import api from '../api/all';
import conversation from './conversation';


const state = {
    conversations: [],
    loadingConversations: false,
};

const getters = {
    allConversations: state => {
        return state.conversations
    },

    loadingConversations: state => {
        return state.loadingConversations
    }
};

const actions = {
    getConversations({dispatch, commit}, page) {

        commit('setConversationsLoading', true);
        api.getConversations(1).then((response) => {

            commit('setConversations', response.data.data);
            commit('setConversationsLoading', false);
        })

    }
};

const mutations = {
    setConversations (state, conversations) {
        state.conversations = conversations;
    },

    setConversationsLoading (state, status) {
        state.loadingConversations = status;
    },
    prependToConversations(state, conversation) {
        state.conversations = state.conversations.filter((c) => {
            return c.id !== conversation.id
        });

        state.conversations.unshift(conversation);
    }
};

const modules = {
    conversation: conversation
};

export default {
    state,
    getters,
    mutations,
    actions,
    modules
}