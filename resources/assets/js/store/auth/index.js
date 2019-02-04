import * as MutationTypes from './MutationTypes';
import Cookies from "js-cookie";
import axios from "axios";

const state = {
    user: {},
    error:'',
    success:'',
    token: Cookies.get('auth_token')
};

const mutations = {
    [MutationTypes.SAVE_USER](state, response) {
        Cookies.set('auth_token', response.data.data.token);
        state.token = response.data.data.token;
        state.user.name = response.data.data.user.name;
    },
    [MutationTypes.SHOW_ERROR](state, error) {
        state.error = error.response.data.meta.message;
    },
    [MutationTypes.SHOW_SUCCESS](state, data) {
        state.success = data.data.meta.message;
    },
    [MutationTypes.OFF_MESSAGE](state) {
        state.error = '';
        state.success = '';
    },
    [MutationTypes.LOGOUT](state) {
        state.token = undefined;
        state.user.name = '';
        Cookies.remove('auth_token')
    },
    [MutationTypes.FETCH_USER_SUCCESS](state, user) {
        state.user = user;

    },
    [MutationTypes.FETCH_USER_FAILURE](state) {
        state.user.name = '';
        state.token = '';
    },
    [MutationTypes.UPDATE_USER](state, user) {
        state.user = user;
    }
};
const actions = {
    [MutationTypes.SAVE_USER]({commit}, response) {
        commit(MutationTypes.SAVE_USER, response);
    },
    [MutationTypes.SHOW_ERROR]({commit}, error) {
        commit(MutationTypes.SHOW_ERROR, error);
    },
    [MutationTypes.SHOW_SUCCESS]({commit}, data) {
        commit(MutationTypes.SHOW_SUCCESS, data);
    },
    [MutationTypes.LOGOUT]({commit}) {
        commit(MutationTypes.LOGOUT);
    },
    [MutationTypes.OFF_MESSAGE]({commit}) {
        commit(MutationTypes.OFF_MESSAGE);
    },
    [MutationTypes.FETCH_USER_SUCCESS]({commit}, user) {
        commit(MutationTypes.FETCH_USER_SUCCESS, user);
    },
    [MutationTypes.FETCH_USER_FAILURE]({commit}) {
        commit(MutationTypes.FETCH_USER_FAILURE);
    },
    [MutationTypes.FETCH_USER]({commit}) {
        axios.get('/api/profile')
            .then((response) => {
                if (response.data.meta.status==='ok'){
                    commit(MutationTypes.FETCH_USER_SUCCESS, response.data.data.user);
                }else {
                    commit(MutationTypes.LOGOUT)
                }
            });
    }
};
const getters = {
    authUser: state => state.user,
    errorUser: state => state.error,
    successUser: state => state.success,
    authToken: state => state.token,
    isLoggedIn: state => state.token !== undefined
};

export default {
    state,
    mutations,
    actions,
    getters
}