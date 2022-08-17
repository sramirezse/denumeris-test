import userApi from "../../api/userapi";
import { useRouter } from "vue-router";
import Cookies from 'js-cookie'
const router = useRouter();
// state
export const state = {
    user: {},
    users: [],
    token: Cookies.get('token'),
    isLoggedIn: Cookies.get('isLoggedIn'),
    //   token_id: 0,

}

// getters
export const getters = {
    user: state => state.user,
    users: state => state.users,
    total: state => state.users.length,
    token: state => state.token,
    check: state => state.user !== null,
    isLoggedIn: state => state.isLoggedIn,
    authToken: state => state.token,
}
// mutations
export const mutations = {
    SAVE_TOKEN(state, { token }) {
        console.log('SAVE_TOKEN', token);
        Cookies.set('token', token, { sameSite: 'strict' })
        Cookies.set('isLoggedIn', 'true', { sameSite: 'strict' })
        state.token = token;
        state.isLoggedIn = 'true';
    },

    FETCH_USER_SUCCESS(state, { user }) {
        // console.log('FETCH_USER_SUCCESS', user)
        state.user = user;
        state.isLoggedIn = 'true';
        Cookies.set('isLoggedIn', 'true', { sameSite: 'strict' })

    },

    FETCH_USER_FAILURE(state) {
        state.token = '';
        state.isLoggedIn = 'false';
        Cookies.set('token', '', { sameSite: 'strict' });
        Cookies.set('isLoggedIn', 'false', { sameSite: 'strict' })


    },

    LOGOUT(state) {
        state.user = {};
        state.token = '';
        state.isLoggedIn = 'false';
        Cookies.set('isLoggedIn', 'false');
        Cookies.set('token', '');


    },

    FETCH_USERS(state, users) {
        state.users = users;
    },

    UPDATE_USER(state, { user }) {
        state.user = user
    }
}

// actions
export const actions = {

    async login({ commit, dispatch }, payload) {
        try {
            // const { data } = await userApi.signin(payload)
            const res = await userApi.signin(payload);
            console.log('this fortm', res)
            commit('SAVE_TOKEN', { token: res.data.user.token.plainTextToken });
            commit('FETCH_USER_SUCCESS', { user: res.data.user });
            return res;

        } catch (err) {
            console.log('error', err);
            commit('LOGOUT')
        }
    },

    async refresh({ commit }) {
        try {
            const { data } = await userApi.refresh()
            commit('SAVE_TOKEN', { token: data.access_token, remember: payload.checkbox_remember_me })
        } catch (e) {
            commit('FETCH_USER_FAILURE')
        }
    },

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
    updateUser({ commit }, payload) {
        commit('UPDATE_USER', payload)
    },

    async logout({ commit }) {
        try {
            const res = await userApi.logout();
            console.log(res);

            commit('LOGOUT')
            router.push('/login');
            return true
        } catch (e) {
            console.log(e)
        }
        commit('LOGOUT')
    }
}

export default {
    state,
    getters,
    mutations,
    actions,
}
