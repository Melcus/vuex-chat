<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            All conversations
        </div>

        <div class="panel-body">
            <div v-if="loading" class="loader"></div>
            <div class="media" v-for="conversation in conversations" v-else-if="conversations.length">
                <div class="media-body">
                    <a href="#" @click.prevent="getConversation(conversation.id)"> {{ trunc(conversation.body, 50) }}</a>
                    <p class="text-muted">
                        You and {{ conversation.participant_count }} {{ pluralize('other', conversation.participant_count) }}
                    </p>
                    <ul class="list-inline">
                        <li>
                            <img :src="user.avatar" :title="user.name" alt="user.name + ' avatar'"
                                 v-for="user in conversation.users.data"/>
                        </li>
                        <li> Last reply {{ conversation.last_reply_human }}</li>
                    </ul>
                </div>
            </div>
            <div class="" v-else>
                No conversations
            </div>
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
