import userApi from "../../api/userapi";
// state
export const state = {
    user: {},
    users: [],
    total: 0,

}

// getters
export const getters = {
    user: state => state.user,
    users: state => state.users,
    total: state => state.total,
}
// mutations
export const mutations = {

    FETCH_USERS(state, users) {
        state.users = users.data;
        state.total = users.total;

    },

    UPDATE_USER(state, { user }) {
        state.user = user
    }
}

// actions
export const actions = {


    async fetchUser({ commit }) {
        try {
            const res = await userApi.me();
            if (res.data.status === 200) {
                // console.log('fetchUser', res.data)
                commit('FETCH_USER_SUCCESS', { user: res.data.user });
            }
            return res;
        } catch (e) {
            commit('FETCH_USER_FAILURE');
            console.log('fetchuserfailure', e);
        }
    },
    async fetchUsers({ commit }, payload) {
        try {
            const { data } = await userApi.getUsers(payload);
            commit('FETCH_USERS', data);

            return data;
        } catch (e) {
            console.log('error', e);
        }
    },
    async saveUser({ commit }, payload) {
        try {
            const { data } = await userApi.saveUser(payload);
            commit('FETCH_USERS', data);
            return data;
        } catch (e) {
            console.log('error', e);
        }
    },
}

export default {
    state,
    getters,
    mutations,
    actions,
}
