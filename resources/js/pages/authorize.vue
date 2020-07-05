<template>
    <div>
        loading
    </div>
</template>

<script>
    import axios from "axios";

    export default {

        metaInfo() {
            return {title: this.$t('authorize')}
        },

        created() {
            this.getToken();
        },
        methods: {
            getToken(url = null) {
                axios.post(url ?? 'api/authorize').then(response => {
                    console.log(response.data);
                }).catch(function (e) {
                    console.log(e.response);
                });
            },
        }
    }
</script>
