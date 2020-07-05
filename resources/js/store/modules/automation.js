import * as types from '../mutation-types'

// state
export const state = {
    mode: localStorage.getItem('automation.grid.mode') || 'list',
}

// getters
export const getters = {
    mode: state => state.mode,
}

// mutations
export const mutations = {
    [types.SET_AUTOMATION_GRID_MODE](state, {mode}) {
        state.mode = mode
    }
}

// actions
export const actions = {
    setGridMode({commit}, {mode}) {
        commit(types.SET_AUTOMATION_GRID_MODE, {mode})
        localStorage.setItem('automation.grid.mode', mode)
    }
}
