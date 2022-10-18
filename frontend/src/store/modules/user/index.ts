import { api } from 'src/boot/axios';
import type IUser from 'src/interfaces/IUser';
import type { StateInterface } from 'src/store';
import { LOGIN } from 'src/store/action-types';
import { LOGOUT, SET_USER } from 'src/store/mutation-types';
import type { Module } from 'vuex';

export interface StateUser {
    user: IUser
}

export const user: Module<StateUser, StateInterface> = {
    state: {
        user: {
            data: JSON.parse(sessionStorage.getItem('user')) ?? {},
            email: '',
            password: '',
            remember: false,
            token: sessionStorage.getItem('token')
        } as IUser
    },
    mutations: {
        [SET_USER](state, userData: unknown) {
            state.user = userData.user;
            state.user.token = userData.token!.access_token;
            sessionStorage.setItem('user', JSON.stringify(userData.user));
            sessionStorage.setItem('token', userData.token!.access_token);
        },
        [LOGOUT](state) {
            state.user.data = {};
            state.user.token = null;
            sessionStorage.removeItem('token');
            sessionStorage.removeItem('user');
        }
    },
    actions: {
        [LOGIN]({ commit }, user: IUser) {
            return api.post('login', user)
                .then(response => commit(SET_USER, response.data));
        },
        [LOGOUT]({ commit }) {
            return api.post('v1/logout')
                .then(response => commit(LOGOUT));
        }
    }
}
