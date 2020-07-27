<template>
    <div class="text-center pt-3">
        <button class="btn btn-change-user" @click="login">{{$t('Connect SendPulse user')}}</button>
        <p class="small pt-1">
            * {{$t('When changing user, some of the automation may stop working.')}}
        </p>
    </div>
</template>

<script>
    import Swal from "sweetalert2";
    import i18n from "../plugins/i18n";

    export default {
        name: 'ChangeUser',

        computed: {
            url: () => '/api/oauth/sendpulse'
        },

        mounted() {
            window.addEventListener('message', this.onMessage, false)
        },

        beforeDestroy() {
            window.removeEventListener('message', this.onMessage)
        },

        methods: {
            async login() {
                const newWindow = openWindow('', this.$t('login'))

                const url = await this.$store.dispatch('auth/fetchOauthUrl', {
                    provider: 'sendpulse'
                })

                newWindow.location.href = url
            },

            /**
             * @param {MessageEvent} e
             */
            onMessage(e) {
                if (e.origin !== window.origin || !e.data.token) {
                    return
                }

                this.$store.dispatch('auth/saveToken', {
                    token: e.data.token
                })

                this.$store.dispatch('auth/fetchUser')

                Swal.fire({
                    icon: 'success',
                    title: i18n.t('user_update'),
                    text: i18n.t('check_your_automation'),
                    reverseButtons: true,
                    confirmButtonText: i18n.t('ok'),
                })
            }
        }

    }

    /**
     * @param  {Object} options
     * @return {Window}
     */
    function openWindow(url, title, options = {}) {
        if (typeof url === 'object') {
            options = url
            url = ''
        }

        options = {url, title, width: 600, height: 720, ...options}

        const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screen.left
        const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screen.top
        const width = window.innerWidth || document.documentElement.clientWidth || window.screen.width
        const height = window.innerHeight || document.documentElement.clientHeight || window.screen.height

        options.left = ((width / 2) - (options.width / 2)) + dualScreenLeft
        options.top = ((height / 2) - (options.height / 2)) + dualScreenTop

        const optionsStr = Object.keys(options).reduce((acc, key) => {
            acc.push(`${key}=${options[key]}`)
            return acc
        }, []).join(',')

        const newWindow = window.open(url, title, optionsStr)

        if (window.focus) {
            newWindow.focus()
        }

        return newWindow
    }
</script>
