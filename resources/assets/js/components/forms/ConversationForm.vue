<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            New message
        </div>
        <div class="panel-body">
            <div class="form-group">
                <input type="text" id="users" placeholder="Start typing to find users" class="form-control">
            </div>
        </div>
    </div>
</template>


<script>
    import {userautocomplete} from '../../helpers/autocomplete'
    export default {
        mounted()
        {
            userautocomplete('#users')
        }
    }
</script>