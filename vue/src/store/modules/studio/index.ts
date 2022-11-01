import type IStudio from "../../../interfaces/IStudio";
import type { State } from "../../../store";
import { DELETE_STUDIO, GET_STUDIOS, INSERT_STUDIO, UPDATE_STUDIO } from "../../../store/action-types";
import type { Module } from "vuex";
import http from "../../../http";
import { ADD_STUDIO, CHANGE_STUDIO, DEFINE_STUDIOS, REMOVE_STUDIO } from "../../../store/mutation-types";

export interface StateStudio {
  studios: IStudio[]
}

export const studio : Module<StateStudio, State> = {
  mutations: {
    [DEFINE_STUDIOS](state, studios: IStudio[]) {
      state.studios = studios;
    },
    [ADD_STUDIO](state, studio: IStudio) {
      state.studios.push(studio);
    },
    [CHANGE_STUDIO](state, studio: IStudio) {
      const index = state.studios.findIndex(item => item.id == studio.id);
      state.studios[index] = studio;
    },
    [REMOVE_STUDIO](state, id: number) {
      state.studios = state.studios.filter(item => item.id != id);
    }
  },
  actions: {
    [GET_STUDIOS]({ commit }) {
      http.get('v1/studios')
        .then(response => commit(DEFINE_STUDIOS, response.data));
    },
    [INSERT_STUDIO]({ commit }, studio: IStudio) {
      return http.post('v1/studios', studio)
        .then(response => commit(ADD_STUDIO, response.data));
    },
    [UPDATE_STUDIO]({ commit }, studio: IStudio) {
      return http.put(`v1/studios/${studio.id}`, studio)
        .then(response => commit(CHANGE_STUDIO, response.data));
    },
    [DELETE_STUDIO]({ commit }, id: number) {
      return http.delete(`v1/studios/${id}`)
        .then(() => commit(REMOVE_STUDIO, id));
    }
  },
  getters: {
    getStudios(state) {
      return state.studios;
    }
  }
}
