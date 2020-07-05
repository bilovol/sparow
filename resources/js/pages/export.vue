<template>
    <div>
        export
    </div>
</template>

<script>
    export default {
        middleware: 'auth',

        metaInfo() {
            return {title: this.$t('export')}
        }
    }
</script>
