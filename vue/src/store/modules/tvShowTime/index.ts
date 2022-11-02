import { State } from "../../../store";
import { Module } from "vuex";
import ITvShowTime from "../../../interfaces/ITvShowTime";
import { ADD_OR_CHANGE_TV_SHOW_TIME, ADD_TV_SHOW_TIME, CHANGE_TV_SHOW_TIME, DEFINE_TV_SHOW_TIMES, REMOVE_TV_SHOW_TIME } from "@/store/mutation-types";
import { DELETE_TV_SHOW_TIME, GET_TV_SHOW_TIMES, INSERT_TV_SHOW_TIME, UPDATE_TV_SHOW_TIME } from "@/store/action-types";
import http from "../../../http";

export interface StateTvShowTime {
  tvShowTimes: ITvShowTime[];
}

export const tvShowTime: Module<StateTvShowTime, State> = {
  mutations: {
    [DEFINE_TV_SHOW_TIMES](state, tvShowTimes: ITvShowTime[]) {
      state.tvShowTimes = tvShowTimes;
    },
    [ADD_TV_SHOW_TIME](state, tvShowTime: ITvShowTime) {
      if (state.tvShowTimes) {
        state.tvShowTimes.push(tvShowTime);
        return;
      }
      state.tvShowTimes = [];
      state.tvShowTimes.push(tvShowTime);
    },
    [CHANGE_TV_SHOW_TIME](state, tvShowTime: ITvShowTime) {
      const index = state.tvShowTimes.findIndex((item) => item.id == tvShowTime.id);
      state.tvShowTimes[index] = tvShowTime;
    },
    [ADD_OR_CHANGE_TV_SHOW_TIME](state, tvShowTime: ITvShowTime) {
      const index = state.tvShowTimes.findIndex((item) => item.id == tvShowTime.id);
      if (index >= 0) {
        state.tvShowTimes[index] = tvShowTime;
        return;
      }
      state.tvShowTimes.push(tvShowTime);
    },
    [REMOVE_TV_SHOW_TIME](state, id: string) {
      state.tvShowTimes = state.tvShowTimes.filter((item) => item.id != id);
    }
  },
  actions: {
    [GET_TV_SHOW_TIMES]({ commit }) {
      http
        .get('v1/tv-show-times')
        .then((response) => commit(DEFINE_TV_SHOW_TIMES, response.data));
    },
    [INSERT_TV_SHOW_TIME]({ commit }, tvShowTime: ITvShowTime) {
      return http
        .post('v1/tv-show-times', tvShowTime)
        .then((response) => commit(ADD_TV_SHOW_TIME, response.data))
    },
    [UPDATE_TV_SHOW_TIME]({ commit }, tvShowTime: ITvShowTime) {
      return http
        .put(`v1/tv-show-times/save`, tvShowTime)
        .then((response) => commit(ADD_OR_CHANGE_TV_SHOW_TIME, response.data));
    },
    [DELETE_TV_SHOW_TIME]({ commit }, id: string) {
      return http.delete(`v1/tv-show-times/${id}`).then(() => commit(REMOVE_TV_SHOW_TIME, id));
    }
  },
  getters: {
    getTvShowTimes(state) {
      return state.tvShowTimes;
    }
  }
}
