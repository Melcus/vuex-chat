import api from '../api/all';

const state = {
    conversation: null,
    loadingConversation: false,
};

const getters = {
    currentConversation: state => {
        return state.conversation
    },
    loadingConversation: state => {
        return state.loadingConversation
    }
};

const actions = {
    getConversation({dispatch, commit}, id) {
        commit('setConversationLoading', true);

        //leave channel
        if (state.conversation) {
            Echo.leave('conversation' + state.conversation.id);
        }
        api.getConversation(id).then((response) => {
            commit('setConversation', response.data.data);
            commit('setConversationLoading', false);

            Echo.private('conversation' + id)
                .listen('ConversationReplyCreated', (e) => {
                    commit('appendToConversation', e.data)
                }).listen('UserAddedToConversation', (e) => {
                commit('UpdateUsersInConversation', e.data.users.data)
            });


            window.history.pushState(null, null, '/conversations/' + id)
        });


    },

    createConversationReply({dispatch, commit}, {id, body}) {
        return api.StoreConversationReply(id, {
            body: body
        }).then((response) => {
            commit('appendToConversation', response.data.data);
            commit('prependToConversations', response.data.data.parent.data);

        })
    },

    createConversation({dispatch, commit}, {body, recipientIds}) {
        return api.StoreConversation({
            body: body,
            recipientIds: recipientIds
        }).then((response) => {
            commit('setConversation', response.data.data);
            // OR     dispatch('getConversation', response.data.data.id);
            commit('prependToConversations', response.data.data);
            console.log(response);


            Echo.private('conversation' + response.data.data.id)
                .listen('ConversationReplyCreated', (e) => {
                    commit('appendToConversation', e.data)
                }).listen('UserAddedToConversation', (e) => {
                commit('UpdateUsersInConversation', e.data.users.data)
            });

        })
    },


    addConversationUsers({dispatch, commit}, {id, recipientIds}) {
        return api.StoreConversationUsers(id, {
            recipientIds: recipientIds

        }).then((response) => {
            commit('UpdateUsersInConversation', response.data.data.users.data);
            // commit addUsersToconversation
            // commit updateConversationInlist

            commit('updateConversationInList', response.data.data);

        })
    }
};

const mutations = {
    setConversation (state, conversation) {
        state.conversation = conversation
    },
    setConversationLoading (state, status) {
        state.loadingConversation = status;
    },
    appendToConversation (state, reply) {
        state.conversation.replies.data.unshift(reply);
    },
    UpdateUsersInConversation(state, users) {
        state.conversation.users.data = users
    }
};

export default {
    state,
    getters,
    mutations,
    actions
}