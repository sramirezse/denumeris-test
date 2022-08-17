
import axios from '../../plugins/axios';
// state
export const state = {
    stations: [],
    markers: [],
    loading: true,
    total: 0,

}

// getters
export const getters = {
    stations: state => state.stations,
}
// mutations
export const mutations = {
    SET_STATIONS(state, payload) {
        state.stations = payload.stations;
        state.total = payload.total;

    },
    SET_LOADING(state, payload) {
        state.loading = payload;
    },
    SET_MARKERS(state, payload) {
        console.log(payload);
        state.markers = payload;
    }
}

// actions
export const actions = {

    async getStations({ commit, dispatch }, payload) {
        await axios.get('stations', {
            params: payload
        }).then(response => {
            commit('SET_STATIONS', response.data);
            commit('SET_LOADING', false)
            dispatch('getMarkers', response.data.stations);
        });
    },
    getMarkers({ commit }, payload) {
        const markers = payload.map(station => {
            return {
                position: {
                    lat: Number(station.latitude),
                    lng: Number(station.longitude)
                }
            }
        });
        commit('SET_MARKERS', markers);

    }
}

export default {
    state,
    getters,
    mutations,
    actions,
}
