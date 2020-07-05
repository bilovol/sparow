import store from '../store'
import {switchAutomationGrid} from "../plugins/switchAutomationGrid";

export default async (to, from, next) => {
    await switchAutomationGrid(store.getters['automation/mode'])
    next()
}
