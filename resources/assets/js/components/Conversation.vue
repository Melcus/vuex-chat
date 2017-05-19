<template>
    <div v-if="loading">
        <div class="loader">
        </div>
    </div>

    <div v-else-if="conversation" class="chat">

        <ul class="list-inline" v-if="conversation.users.data.length">
            <li><strong>In conversation : </strong></li>
            <li v-for="user in conversation.users.data"> {{ user.name}} </li>
        </ul>
        <conversation-add-user-form></conversation-add-user-form>
        <hr>
        <conversation-reply-form></conversation-reply-form>
        <hr>

        <transition-group name="slide-fade" tag="div">
        <div :class="['message flex-end flex', user_id === reply.user.data.id ? ' ' : 'row-reverse' ]"
             v-for="reply in conversation.replies.data"  :key="reply.id">
            <div :class="['bubble flex-grow', user_id === reply.user.data.id ? 'you' : 'me' ]">
                <span class="pull-left" style="padding-right: 10px"><small>{{ reply.user.data.name }}</small></span> <span class="pull-right"><small>{{  reply.created_at_formatted }}</small></span>
                <br>
               <p>{{ reply.body }}</p>
            </div>
            <img :src="reply.user.data.avatar" class="chat-image" data-toggle="tooltip"
                 :title=" reply.created_at_human" data-placement="bottom">
        </div>
        </transition-group>

        <div :class="['message flex-end flex', user_id === conversation.user.data.id ? ' ' : 'row-reverse' ]"
           >
            <div :class="['bubble flex-grow', user_id === conversation.user.data.id ? 'you' : 'me' ]">
                <span class="pull-left" style="padding-right: 10px"><small>{{ conversation.user.data.name }}</small></span> <span class="pull-right"><small>{{  conversation.created_at_formatted }}</small></span>
                <br>
                {{ conversation.body }}
            </div>
            <img :src="conversation.user.data.avatar" class="chat-image"   data-toggle="tooltip" :title=" conversation.created_at_human" data-placement="top">
        </div>


    </div>


    <div v-else class="text-center">Select a conversation</div>

</template>

<script>
    $(document).ready(function() {
        $("body").tooltip({ selector: '[data-toggle=tooltip]', html: true });
    });

    import{mapActions, mapGetters} from 'vuex'

    export default {
        props: [
            'id'
        ],
        data()
        {
            return {
                user_id: null
            }
        },
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
            this.user_id = Laravel.user.id;
//            console.log(Laravel.user.id);
            if (this.id !== null) {
                this.getConversation(this.id)
//              OR  this.$store.dispatch('getConversation', this.id);
            }
        }
    }
</script>

<style>




</style>
