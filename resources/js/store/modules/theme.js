import * as types from '../mutation-types'

// state
export const state = {
    mode: localStorage.getItem('theme.mode') || 'theme_light',
}

// getters
export const getters = {
    mode: state => state.mode,
}

// mutations
export const mutations = {
    [types.SET_THEME](state, {mode}) {
        state.mode = mode
    }
}

// actions
export const actions = {
    setMode({commit}, {mode}) {
        commit(types.SET_THEME, {mode})
        localStorage.setItem('theme.mode', mode)
    }
}
