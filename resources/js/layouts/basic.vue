<template>
    <div class="sp-bg">
        <child/>
    </div>
</template>

<script>
    export default {
        name: 'BasicLayout'
    }
</script>

<style lang="scss">
    .sp-bg {
        height: 100vh;
        margin: 0;
        padding: 0;
        font-family: 'Helvetica', sans-serif;
    }
</style>
