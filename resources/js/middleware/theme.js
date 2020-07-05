import store from '../store'
import {switchTheme} from "../plugins/switchTheme";

export default async (to, from, next) => {
    await switchTheme(store.getters['theme/mode'])
    next()
}
