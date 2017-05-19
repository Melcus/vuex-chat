<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            New message
        </div>
        <div class="panel-body">

            <form action="" @submit.prevent="send">


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
                <div class="form-group">
                    <label for="message"> Message</label>
                    <textarea id="message" cols="30" rows="4" class="form-control" v-model="body"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default">Send</button>
                </div>
            </form>
        </div>
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
                recipients: []
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
            send() {
                this.createConversation({
                    recipientIds: this.recipients.map((r) => {
                        return r.id
                    }),
                    body: this.body
                }).then(() => {
                    this.recipients = [];
                    this.body = null;
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