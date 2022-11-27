import type IUser from "@/interfaces/IUser";
import type IJob from "@/interfaces/IJob";
import type { State } from "@/store";
import { LOGIN, GET_USER, GET_JOBS } from "@/store/action-types";
import { LOGOUT, SET_USER, GET_USER_JOB } from "../../../store/mutation-types";
import type { Module } from "vuex";
import http from "@/http";

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
    [SET_USER](state, userData: any) {
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
    [GET_USER_JOB](state, userData){
      state.user.data = userData;
    },
  },
  actions: {
    [LOGIN]({ commit }, user: IUser) {
      return http
        .post("login", user)
        .then(response => commit(SET_USER, response.data))
    },
    [LOGOUT]({ commit }) {
      return http.post("v1/logout").then(response => commit(LOGOUT));
    },
    [GET_USER]({ commit }, id: number) {
      http
        .get(`v1/user-job/${id}`)
        .then((response) => commit(GET_USER_JOB, response.data));
    },
  },
  getters: {
    isSignedIn(state): boolean {
      return !!state.user.token;
    },
    getUser() {
      return JSON.parse(String(sessionStorage.getItem("user"))) ?? {};
    },
    getUserJob(state) {
      return state.user.data;
    }
  },
};
