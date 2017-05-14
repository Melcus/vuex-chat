<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <conversation-form></conversation-form>
                <conversations></conversations>
            </div>
            <div class="col-sm-7">
                <conversation :id="id"></conversation>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : {
            'id' : {
                default: null
            }
        }
    }
</script>
