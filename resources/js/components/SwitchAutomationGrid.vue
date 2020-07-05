<template>
    <div class="text-right">

        <button @click="setGridMode('list')" class="btn btn-edit" :class="{ active : this.mode === 'list' }">
            <eva-icon name="list-outline"></eva-icon>
        </button>
        <button @click="setGridMode('grid')" class="btn btn-edit" :class="{active : this.mode === 'grid'}">
            <eva-icon name="grid-outline"></eva-icon>
        </button>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import {EvaIcon} from 'vue-eva-icons'
    import {switchAutomationGrid} from "../plugins/switchAutomationGrid"

    export default {
        components: {
            [EvaIcon.name]: EvaIcon
        },

        computed: mapGetters({
            mode: 'automation/mode',
        }),

        mounted() {
            switchAutomationGrid(this.mode);
        },

        methods: {
            setGridMode(mode) {
                this.$store.dispatch('automation/setGridMode', {mode});
                switchAutomationGrid(mode);
            }
        }

    }
</script>
