import Vue from 'vue'
import Card from './Card'
import Child from './Child'

// Components that are registered globaly.
[
    Card,
    Child
].forEach(Component => {
    Vue.component(Component.name, Component)
})
