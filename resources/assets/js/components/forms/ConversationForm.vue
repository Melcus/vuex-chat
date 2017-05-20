<template>
    <div class="">

        <div class="row ">
            <div class="col-md-12 text-center">
                <span class="btn btn-default text-center" style="width: 100%" v-if="!show_new_conversation_form"
                      @click="show_new_conversation_form = true"><i class="fa fa-plus-square"></i> New conversation
                </span>
                <span class="btn btn-default text-center" style="width: 100%" v-if="show_new_conversation_form"
                      @click="closeNewConversationForm()"><i class="fa fa-minus-square"></i> Cancel
                </span>
            </div>

        </div>
        <br>

        <transition-group name="conversation-toggle" tag="div">
            <div class="row" v-show="show_new_conversation_form" :key="1" style="margin-top: -20px;">
                <div class="col-md-12">

                    <form action="" @submit.prevent="send" class="new-conversation-form ">

                        <div class="form-group">
                            <input type="text" id="users" placeholder="Start typing to find users" class="form-control">
                        </div>

                        <ul v-if="recipients.length" class="list-inline">
                            <li><strong> To : </strong></li>
                            <li v-for="recipient in recipients"> {{ recipient.name }} [ <a href="#"
                                                                                           @click.prevent="removeRecipient(recipient)">x</a>
                                ]
                            </li>
                        </ul>
                        <div class="form-group" style="width: 100%">
                            <label for="message"> Message</label>
                            <textarea id="message" cols="30" rows="4" class="form-control new-conversation-textarea"
                                      v-model="body"></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Start conversation</button>

                        </div>


                    </form>

                </div>
            </div>
        </transition-group>
    </div>
</template>


<script>
    import {userautocomplete} from '../../helpers/autocomplete'
    import {mapActions, mapGetters} from 'vuex'

    export default {
        data()
        {
            return {
                body: null,
                recipients: [],
                show_new_conversation_form: false
            }
        },

        methods: {
            ...mapActions([
                'createConversation',
            ]),
            addRecipient (recipient) {
                let existing = this.recipients.find((r) => {
                    return r.id === recipient.id
                });
                if (typeof existing !== 'undefined') {
                    return
                }

                this.recipients.push(recipient)
            },
            removeRecipient (recipient) {
                this.recipients = this.recipients.filter((r) => {
                    return r.id !== recipient.id
                })
            },
            closeNewConversationForm () {
                this.show_new_conversation_form = false;
                this.recipients = [];
                this.body = null;
            },
            send() {
                this.createConversation({
                    recipientIds: this.recipients.map((r) => {
                        return r.id
                    }),
                    body: this.body
                }).then(() => {
                    this.recipients = [];
                    this.body = null;
                    this.show_new_conversation_form = false;
                })
            }
        },
        mounted()
        {
            let users = userautocomplete('#users').on('autocomplete:selected', (e, selection) => {
                this.addRecipient(selection);
                console.log(selection);
                users.autocomplete.setVal('');
            })
        }
    }
</script>

<style>



</style>