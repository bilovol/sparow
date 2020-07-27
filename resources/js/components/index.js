import Vue from 'vue'
import Child from './Child'

// Components that are registered global.
[
    Child
].forEach(Component => {
    Vue.component(Component.name, Component)
})
