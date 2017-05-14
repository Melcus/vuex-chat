<template>

    <div v-if="conversation">

        <uL class="list-inline" v-if="conversation.users.data.length">
            <li><strong>In conversation : </strong></li>
            <li v-for="user in conversation.users.data"> {{ user.name}} </li>
        </uL>

        <div class="media"  v-for="reply in conversation.replies.data">
            <div class="media-left">
                <img :src="reply.user.data.avatar" alt="reply.user.data.name + 'avatar'" />
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
                <img :src="conversation.user.data.avatar" alt="conversation.user.data.name + 'avatar'" />
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

</template>

<script>
    import{mapActions, mapGetters} from 'vuex'

    export default {
        computed: mapGetters({
            conversation: 'currentConversation',
        }),
    }
</script>