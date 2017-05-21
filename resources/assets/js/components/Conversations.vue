<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            All conversations
        </div>


            <div v-if="loading" class="loader"></div>
            <transition-group name="list" tag="div" v-else-if="conversations.length">
            <div  :class="['conversation-thread', current_conversation && (current_conversation.id === conversation.id) ? 'in_focus' : '' ]"
                  v-for="conversation in conversations"
                  :key="conversation.id"
                  @click.prevent="getConversation(conversation.id)"
            >

                <div class="media-body" >
                    <span > {{ trunc(conversation.body, 40) }}</span>
                    <span class="pull-right">
                      You and {{ conversation.participant_count }} {{ pluralize('other', conversation.participant_count) }}
                    </span>
                    <ul class="list-inline">
                        <li>
                            <img :src="user.avatar" :title="user.name" alt="user.name + ' avatar'"
                                 v-for="user in conversation.users.data"/>
                        </li>
                        <li class="pull-right"> Last reply {{ conversation.last_reply_human }}</li>
                    </ul>
                </div>

            </div>
            </transition-group>

            <div class="text-center" v-else>
               <h4> No conversations</h4>
            </div>
        </div>


</template>

<script>
    import trunc from '../helpers/trunc'
    import pluralize from 'pluralize'
    import{mapActions, mapGetters} from 'vuex'

    export default {
        computed: mapGetters({
            conversations: 'allConversations',
            current_conversation : 'currentConversation',
            loading: 'loadingConversations'
        }),
        methods: {
            ...mapActions([
                'getConversations',
                'getConversation',
            ]),
            trunc : trunc,
            pluralize : pluralize
        },
        mounted() {
            this.getConversations(1);

        }
    }
</script>

<style>







</style>
