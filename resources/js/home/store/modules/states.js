
import axios from '../../plugins/axios';
// state
export const state = {
    states: [],
    cities: [],
    loading: true,
    total: 0,

}

// getters
export const getters = {
    states: state => state.states,
    cities: state => state.cities,
}
// mutations
export const mutations = {
    SET_STATES(state, payload) {
        state.states = payload.states;
        state.total = payload.total;

    },
    SET_CITIES(state, payload) {
        state.cities = payload.cities;
    },
    SET_LOADING(state, payload) {
        state.loading = payload;
    }
}

// actions
export const actions = {

    async getStates({ commit }, payload) {
        commit('SET_LOADING',true)
        await axios.get('states', {
            params: payload
        }).then(response => {
            commit('SET_STATES', response.data);
        });
    },
    async getCities({ commit }, payload) {
        commit('SET_LOADING',true)
        await axios.get('cities', {
            params: payload
        }).then(response => {
            commit('SET_CITIES', response.data);
        });
    }
}

export default {
    state,
    getters,
    mutations,
    actions,
}
