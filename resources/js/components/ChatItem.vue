<template>
    <div class="message" :class="{'is-current-user': $root.currentUserLogin.id === message.user.id}">
        <span class="message-item user-name">{{message.user.username}}</span>
        <span class="message-item timestamp"> | {{message.created_at}}:</span>
        <span class="message-item text-message"> {{message.message}}</span>
    </div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>

<style lang="scss" scoped>
    .message {
        display: flex;
        color: white;
        .message-item:not(:last-child){
            margin-right: 5px;
        }
    }
    .message:not(:last-child){
        padding-bottom: 20px;
    }
    .is-current-user{
        color: #ffe70a;
    }
</style>