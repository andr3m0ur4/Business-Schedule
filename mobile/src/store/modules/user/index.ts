import type IUser from "../../../interfaces/IUser";
import type { State } from "../../../store";
import { LOGIN } from "../../../store/action-types";
import { LOGOUT, SET_USER } from "../../../store/mutation-types";
import type { Module } from "vuex";
import { api } from 'src/boot/axios'

export interface StateUser {
  user: IUser;
}

export const user: Module<StateUser, State> = {
  state: {
    user: {
      email: "",
      password: "",
      remember: false,
      token: sessionStorage.getItem("token"),
    } as any,
  },
  mutations: {
    [SET_USER](state, userData: Object) {
      state.user = userData.user;
      state.user.token = userData.token!.access_token;
      sessionStorage.setItem("user", JSON.stringify(userData.user));
      sessionStorage.setItem("token", userData.token!.access_token);
    },
    [LOGOUT](state) {
      state.user.data = {};
      state.user.token = null;
      sessionStorage.removeItem("token");
      sessionStorage.removeItem("user");
    },
  },
  actions: {
    [LOGIN]({ commit }, user: IUser) {
      return api
        .post("login", user)
        .then((response) => commit(SET_USER, response.data));
    },
    [LOGOUT]({ commit }) {
      return api.post("v1/logout").then((response) => commit(LOGOUT));
    },
  },
  getters: {
    isSignedIn(state): boolean {
      return !!state.user.token;
    },
    getUser() {
      return JSON.parse(String(sessionStorage.getItem("user"))) ?? {};
    },
  },
};