<template>
    <nav class="navbar navbar-expand">
        <div class="d-flex w-50 order-0 logo">
            <svg width="30" height="27" viewBox="0 0 30 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M25.6663 12.5241C24.3651 12.5241 23.2265 13.2398 22.6735 14.3133H18.8675L17.1759 0H13.6626L8.7506 18.9976L7.48193 13.6627H0V16.9157H4.55422L6.92891 27H10.312L14.7036 10.312L15.647 17.0133L15.7446 17.5663H22.6735C23.259 18.6398 24.3651 19.3554 25.6663 19.3554C27.553 19.3554 29.0819 17.8265 29.0819 15.9398C29.0819 14.053 27.553 12.5241 25.6663 12.5241Z"
                />
            </svg>
        </div>

        <div class="navbar-collapse justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item mr-2">
                    <router-link :to="{ name: 'automation' }" class="nav-link" active-class="active">
                        {{ $t('Automation') }}
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'export' }" class="nav-link" active-class="active">
                        {{ $t('Export') }}
                    </router-link>
                </li>
            </ul>
        </div>
        <div class="w-50">
            <ul class="navbar-nav ml-md-auto float-right">
                <li class="nav-item d-none d-lg-inline-block mr-2">
                <span v-if="user.sp_user_info" class="user-email" style="line-height: 40px;">
                      {{user.sp_user_info.email}}
                </span>
                </li>
                <li class="nav-item">
                    <router-link tag="button" :to="{ name: 'settings' }" class="btn btn-circle" active-class="active">
                        <eva-icon name="settings-2-outline" animation="zoom"></eva-icon>
                    </router-link>
                </li>
                <switch-theme></switch-theme>
            </ul>
        </div>
    </nav>
</template>

<script>
    import {mapGetters} from 'vuex'
    import {EvaIcon} from 'vue-eva-icons'
    import SwitchTheme from "./SwitchTheme";

    export default {

        components: {
            SwitchTheme,
            [EvaIcon.name]: EvaIcon
        },

        computed: mapGetters({
            user: 'auth/user',
        })
    }
</script>
