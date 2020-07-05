<template>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body text-center">
                <div class="avatar">
                    <img :src='user.photo_url' :alt="user.sp_user_info.email">
                </div>

                <h4>
                    <span class="badge badge-main">{{user.sp_user_info.name}}</span>
                </h4>
                <div>
                    <span class="badge">User ID: {{user.sp_user_info.id}}</span>
                    |
                    <span class="badge">EMAIL: {{user.sp_user_info.email}}</span>
                </div>

                <change-user></change-user>

                <hr>
                <div class="text-muted text-right">
                    <span class="badge">app ID: {{user.id}}</span><span class="badge"
                                                                        v-for="(value, key) in user.donor_info">d.{{key}}: {{value}}</span>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import ChangeUser from "../components/ChangeUser";

    export default {
        middleware: 'auth',
        components: {
            ChangeUser
        },

        computed: mapGetters({
            user: 'auth/user',
        }),
        metaInfo() {
            return {title: this.$t('settings')}
        },
    }
</script>
