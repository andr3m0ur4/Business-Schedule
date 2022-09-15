import type IUser from "@/interfaces/IUser";
import type { State } from "@/store";
import { LOGIN } from "@/store/action-types";
import { LOGOUT, SET_USER } from "@/store/mutation-types";
import type { Module } from "vuex";
import http from "@/http";

export interface StateUser {
    user: IUser
}

export const user: Module<StateUser, State> = {
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
        [LOGOUT](state) {
            state.user.data = {};
            state.user.token = null;
            sessionStorage.removeItem('token');
            sessionStorage.removeItem('user');
        },
        [SET_USER](state, userData: Object) {
            state.user = userData.user;
            state.user.token = userData.token!.access_token;
            sessionStorage.setItem('user', JSON.stringify(userData.user));
            sessionStorage.setItem('token', userData.token!.access_token);
        }
    },
    actions: {
        [LOGIN]({ commit }, user: IUser) {
            return http.post('login', user)
                .then(response => commit(SET_USER, response.data));
        },
        [LOGOUT]({ commit }) {
            return http.post('v1/logout')
                .then(response => commit(LOGOUT));
        }
    }
}
