import type ITvshow from "../../../interfaces/ITvshow";
import type { State } from "../../../store";
import { DELETE_TVSHOW, GET_TVSHOWS, INSERT_TVSHOW, UPDATE_TVSHOW } from "../../../store/action-types";
import type { Module } from "vuex";
import http from "../../../http";
import { ADD_TVSHOW, CHANGE_TVSHOW, DEFINE_TVSHOWS, REMOVE_TVSHOW } from "../../../store/mutation-types";

export interface StateTvshow {
  tvshows: ITvshow[]
}

export const tvshow : Module<StateTvshow, State> = {
  mutations: {
    [DEFINE_TVSHOWS](state, tvshows: ITvshow[]) {
      state.tvshows = tvshows;
    },
    [ADD_TVSHOW](state, tvshow: ITvshow) {
      state.tvshows.push(tvshow);
    },
    [CHANGE_TVSHOW](state, tvshow: ITvshow) {
      const index = state.tvshows.findIndex(item => item.id == tvshow.id);
      state.tvshows[index] = tvshow;
    },
    [REMOVE_TVSHOW](state, id: number) {
      state.tvshows = state.tvshows.filter(item => item.id != id);
    }
  },
  actions: {
    [GET_TVSHOWS]({ commit }) {
      http.get('v1/tv-shows')
        .then(response => commit(DEFINE_TVSHOWS, response.data));
    },
    [INSERT_TVSHOW]({ commit }, tvshow: ITvshow) {
      return http.post('v1/tv-shows', tvshow)
        .then(response => commit(ADD_TVSHOW, response.data));
    },
    [UPDATE_TVSHOW]({ commit }, tvshow: ITvshow) {
      return http.put(`v1/tv-shows/${tvshow.id}`, tvshow)
        .then(response => commit(CHANGE_TVSHOW, response.data));
    },
    [DELETE_TVSHOW]({ commit }, id: number) {
      return http.delete(`v1/tv-shows/${id}`)
        .then(() => commit(REMOVE_TVSHOW, id));
    }
  },
  getters: {
    getTvShows(state) {
      return state.tvshows;
    }
  }
}
