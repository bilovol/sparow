<template>
    <div class="promo-container">
        <div class="promo-content">
            <h1>
                {{ title }}
                <eva-icon name="link"></eva-icon>
                SendPulse
            </h1>
        </div>
    </div>
</template>

<script>
    import {EvaIcon} from 'vue-eva-icons'

    export default {

        layout: 'basic',
        middleware: 'guest',

        components: {
            [EvaIcon.name]: EvaIcon
        },

        metaInfo() {
            // return {title: this.$t('welcome')}
            return {title: 'welcome'}
        },

        data: () => ({
            title: window.config.appName
        }),
    }
</script>

<style lang="scss">
    .promo-container {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .promo-content {
        width: 100%;
        max-width: 600px;
        padding: 20px 40px;
        box-sizing: border-box;
        text-align: center;

        h1 {
            font-size: 2.5rem;
            font-weight: bold !important;
        }

    }

</style>
