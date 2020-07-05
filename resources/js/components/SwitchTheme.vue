<template>
    <li class="nav-item ml-2">
        <button v-if="this.mode === 'theme_light'" class="btn btn-circle" @click="setMode('theme_dark')">
            <eva-icon name="moon-outline" animation="zoom"></eva-icon>
        </button>
        <button v-if="this.mode === 'theme_dark'" class="btn btn-circle" @click="setMode('theme_light')">
            <eva-icon name="sun-outline" animation="zoom"></eva-icon>
        </button>
    </li>
</template>

<script>
    import {mapGetters} from 'vuex'
    import {EvaIcon} from 'vue-eva-icons'
    import {switchTheme} from "../plugins/switchTheme";

    export default {
        components: {
            [EvaIcon.name]: EvaIcon
        },

        computed: mapGetters({
            mode: 'theme/mode',
        }),

        methods: {
            setMode(mode) {
                this.$store.dispatch('theme/setMode', {mode});
                switchTheme(mode);
            }
        }

    }
</script>
