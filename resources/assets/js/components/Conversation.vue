<template>
    <div v-if="loading">
        <div class="loader">
        </div>
    </div>

    <div v-else-if="conversation">

        <ul class="list-inline" v-if="conversation.users.data.length">
            <li><strong>In conversation : </strong></li>
            <li v-for="user in conversation.users.data"> {{ user.name}} </li>
        </ul>

        <conversation-add-user-form></conversation-add-user-form>
        <hr>
        <conversation-reply-form></conversation-reply-form>
        <hr>
        <div class="media" v-for="reply in conversation.replies.data">
            <div class="media-left">
                <img :src="reply.user.data.avatar" alt="reply.user.data.name + 'avatar'"/>
            </div>
            <div class="media-body">
                <p> {{ reply.user.data.name}} &bull; {{ reply.created_at_human }} </p>
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{ reply.body }}
                    </div>
                </div>
            </div>
        </div>


        <div class="media">
            <div class="media-left">
                <img :src="conversation.user.data.avatar" alt="conversation.user.data.name + 'avatar'"/>
            </div>
            <div class="media-body">
                <p> {{ conversation.user.data.name}} &bull; {{ conversation.created_at_human }} </p>
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{ conversation.body }}
                    </div>
                </div>
            </div>
        </div>


    </div>



    <div v-else class="text-center">Select a conversation</div>

</template>

<script>
    import{mapActions, mapGetters} from 'vuex'

    export default {
        props: [
            'id'
        ],
        computed: mapGetters({
            conversation: 'currentConversation',
            loading: 'loadingConversation'
        }),
        methods: {
            ...mapActions([
                'getConversation',
            ]),
        },

        mounted()
        {
            if (this.id !== null) {
                this.getConversation(this.id)
//              OR  this.$store.dispatch('getConversation', this.id);
            }
        }
    }
</script>