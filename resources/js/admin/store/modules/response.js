
// state
export const state = {
    loading: true,

}

// getters
export const getters = {
    loading: state => state.loading,
}
// mutations
export const mutations = {
    SET_LOADING(state, payload) {
        state.loading = payload;
    }
}

// actions
export const actions = {

    setLoading({ commit }, payload) {
        commit('SET_LOADING', payload);
    }
}

export default {
    state,
    getters,
    mutations,
    actions,
}
