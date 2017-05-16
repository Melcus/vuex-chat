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

            // console.log('user' + Laravel.user.id);
            Echo.private('user' + Laravel.user.id)
                .listen('ConversationCreated', (e) => {
                    commit('prependToConversations', e.data)
                }).listen('ConversationReplyCreated', (e) => {
                commit('prependToConversations', e.data.parent.data)
                }).listen('UserAddedToConversation', (e) => {
                commit('updateConversationInList', e.data)
            });


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
    },

    updateConversationInList(state, conversation) {
        state.conversations = state.conversations.map((c) => {
            if (c.id === conversation.id) {
                return conversation
            }
            return c
        })
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