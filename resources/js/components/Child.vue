<template>
    <transition name="slide-fade" mode="out-in">
        <slot>
            <router-view/>
        </slot>
    </transition>
</template>

<script>
    export default {
        name: 'Child'
    }
</script>
<style>
    .slide-fade-enter-active {
        transition: opacity .3s;
    }

    .slide-fade-leave-active {
        transition: all .3s;
    }

    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active до версии 2.1.8 */
    {
        opacity: 0;
    }
</style>
